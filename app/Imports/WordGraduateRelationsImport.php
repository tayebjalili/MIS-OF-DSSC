<?php

namespace App\Imports;

use App\Models\SpecialistofGraduateRelations;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
class WordGraduateRelationsImport
{
    private $importedCount = 0;
    private $skippedCount = 0;
    private $importErrors = [];

    public function importFromWord($filePath)
    {
        try {
            // Load the Word document
            $phpWord = IOFactory::load($filePath);

            // Get all sections
            $sections = $phpWord->getSections();

            foreach ($sections as $section) {
                $elements = $section->getElements();

                foreach ($elements as $element) {
                    if ($element instanceof Table) {
                        $this->processTable($element);
                    }
                }
            }

        } catch (\Exception $e) {
            $this->importErrors[] = "Failed to read Word document: " . $e->getMessage();
        }
    }

    private function processTable(Table $table)
    {
        $rows = $table->getRows();
        $headers = [];
        $isFirstRow = true;

        foreach ($rows as $row) {
            $cells = $row->getCells();
            $rowData = [];

            foreach ($cells as $cell) {
                $cellText = $this->extractTextFromCell($cell);
                $rowData[] = $cellText;
            }

            if ($isFirstRow) {
                // Assume first row contains headers
                $headers = $this->normalizeHeaders($rowData);
                $isFirstRow = false;
                continue;
            }

            // Process data row
            if (count($rowData) > 0 && !empty(trim($rowData[0]))) {
                $this->processDataRow($headers, $rowData);
            }
        }
    }

   private function extractTextFromCell($cell)
{
    $text = '';
    $elements = $cell->getElements();

    foreach ($elements as $element) {
        if ($element instanceof Text) {
            $text .= $element->getText();
        } elseif ($element instanceof TextRun) {
            foreach ($element->getElements() as $textElement) {
                if ($textElement instanceof Text) {
                    $text .= $textElement->getText();
                }
            }
        } elseif (method_exists($element, 'getText')) {
            $text .= $element->getText();
        }
    }

    return trim($text);
}


    private function normalizeHeaders($headers)
    {
        $normalized = [];
        $mapping = [
            'name' => ['name', 'نام', 'نوم', 'student name', 'full name'],
            'father_name' => ['father name', 'father_name', 'د پلار نوم', 'پلار نوم', 'father'],
            'university' => ['university', 'پوهنتون', 'پوهنتون نوم', 'uni', 'institution'],
            'faculty' => ['faculty', 'پوهنځي', 'پوهنځی', 'department', 'school'],
            'department' => ['department', 'څانګه', 'څانگه', 'branch', 'major'],
            'id_conqor' => ['id_conqor', 'conqor', 'کانکور', 'کانکور نمبر', 'id', 'student id'],
            'percentage' => ['percentage', 'فیصدي', 'فیصده', 'grade', 'marks', '%'],
            'start_year' => ['start year', 'start_year', 'د پیل کال', 'پیل کال', 'admission year'],
            'graduated_year' => ['graduated year', 'graduation year', 'د فراغت کال', 'فراغت کال', 'completion year'],
            'phone_number' => ['phone', 'phone number', 'تلیفون', 'تلیفون نمبر', 'mobile', 'contact'],
            'email' => ['email', 'ایمیل', 'e-mail', 'mail', 'email address'],
            'observations' => ['observations', 'ملاحظات', 'notes', 'remarks', 'comments'],
            'looks' => ['looks', 'بڼه', 'appearance', 'description']
        ];

        foreach ($headers as $header) {
            $header = strtolower(trim($header));
            $matched = false;

            foreach ($mapping as $key => $variations) {
                foreach ($variations as $variation) {
                    if (strpos($header, $variation) !== false || strpos($variation, $header) !== false) {
                        $normalized[] = $key;
                        $matched = true;
                        break 2;
                    }
                }
            }

            if (!$matched) {
                $normalized[] = $header;
            }
        }

        return $normalized;
    }

    private function processDataRow($headers, $rowData)
    {
        try {
            $data = [];

            for ($i = 0; $i < count($headers) && $i < count($rowData); $i++) {
                $data[$headers[$i]] = $this->cleanString($rowData[$i]);
            }

            // Validate required fields
            if (empty($data['name']) || empty($data['university']) || empty($data['faculty'])) {
                $this->skippedCount++;
                $this->importErrors[] = "Row skipped: Missing required fields (name, university, or faculty)";
                return;
            }

            // Clean and validate data
            $cleanData = [
                'name' => $data['name'],
                'father_name' => $data['father_name'] ?? '',
                'university' => $data['university'],
                'faculty' => $data['faculty'],
                'department' => $data['department'] ?? '',
                'id_conqor' => $data['id_conqor'] ?? '',
                'percentage' => $this->cleanNumber($data['percentage'] ?? ''),
                'start_year' => $this->cleanYear($data['start_year'] ?? ''),
                'graduated_year' => $this->cleanYear($data['graduated_year'] ?? ''),
                'phone_number' => $data['phone_number'] ?? '',
                'email' => $this->cleanEmail($data['email'] ?? ''),
                'observations' => $data['observations'] ?? '',
                'looks' => $data['looks'] ?? '',
            ];

            // Create the record
            SpecialistofGraduateRelations::create($cleanData);
            $this->importedCount++;

        } catch (\Exception $e) {
            $this->skippedCount++;
            $this->importErrors[] = "Row processing error: " . $e->getMessage();
        }
    }

    private function cleanString($value)
    {
        if (is_null($value)) {
            return '';
        }

        $cleaned = trim((string) $value);
        $cleaned = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $cleaned);

        return $cleaned;
    }

    private function cleanNumber($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        $cleaned = trim((string) $value);
        $cleaned = preg_replace('/[^0-9.]/', '', $cleaned);

        return is_numeric($cleaned) ? (float) $cleaned : null;
    }

    private function cleanYear($value)
    {
        if (is_null($value) || $value === '') {
            return '';
        }

        $cleaned = trim((string) $value);
        $cleaned = preg_replace('/[^0-9]/', '', $cleaned);

        // Validate year format (should be 4 digits)
        if (strlen($cleaned) === 4 && is_numeric($cleaned)) {
            return $cleaned;
        }

        return '';
    }

    private function cleanEmail($value)
    {
        if (is_null($value) || trim($value) === '') {
            return '';
        }

        $cleaned = $this->cleanString($value);

        return filter_var($cleaned, FILTER_VALIDATE_EMAIL) ? $cleaned : '';
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getSkippedCount(): int
    {
        return $this->skippedCount;
    }

    public function getErrors(): array
    {
        return $this->importErrors;
    }
}
