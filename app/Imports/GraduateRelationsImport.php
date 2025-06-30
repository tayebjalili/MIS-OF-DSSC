<?php

namespace App\Imports;

use App\Models\SpecialistofGraduateRelations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Illuminate\Support\Facades\Log; // <-- Add this line

class GraduateRelationsImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnError,
    SkipsEmptyRows,
    WithChunkReading,
    WithBatchInserts
{
    use Importable;

    private $importedCount = 0;
    private $skippedCount = 0;
    private $importErrors = []; // Renamed from $errors to avoid conflict

    public function model(array $row)
    {
        try {
            // Debug: Log the incoming row data
            Log::info('Import row data:', $row);

            // Handle both array keys and direct access
            $data = [
                'name' => $this->cleanString($this->getRowValue($row, 'name')),
                'father_name' => $this->cleanString($this->getRowValue($row, 'father_name')),
                'university' => $this->cleanString($this->getRowValue($row, 'university')),
                'faculty' => $this->cleanString($this->getRowValue($row, 'faculty')),
                'department' => $this->cleanString($this->getRowValue($row, 'department')),
                'id_conqor' => $this->cleanString($this->getRowValue($row, 'id_conqor')),
                'percentage' => $this->cleanNumber($this->getRowValue($row, 'percentage')),
                'start_year' => $this->cleanString($this->getRowValue($row, 'start_year')),
                'graduated_year' => $this->cleanString($this->getRowValue($row, 'graduated_year')),
                'phone_number' => $this->cleanString($this->getRowValue($row, 'phone_number')),
                'email' => $this->cleanEmail($this->getRowValue($row, 'email')),
                'observations' => $this->cleanString($this->getRowValue($row, 'observations')),
                'looks' => $this->cleanString($this->getRowValue($row, 'looks')),
            ];

            // Debug: Log the processed data
            Log::info('Processed data:', $data);

            // Skip if required fields are empty
            if (empty($data['name']) || empty($data['university']) || empty($data['faculty']) || empty($data['department'])) {
                $this->skippedCount++;
                $this->importErrors[] = "Row skipped: Missing required fields (name: '{$data['name']}', university: '{$data['university']}', faculty: '{$data['faculty']}', department: '{$data['department']}')";
                return null;
            }

            $this->importedCount++;
            return new SpecialistofGraduateRelations($data);

        } catch (\Exception $e) {
            $this->skippedCount++;
            $this->importErrors[] = "Row error: " . $e->getMessage() . " | Row data: " . json_encode($row);
            return null;
        }
    }

    private function getRowValue($row, $key)
    {
        // Try direct key access first
        if (isset($row[$key])) {
            return $row[$key];
        }

        // Try case-insensitive search
        foreach ($row as $k => $v) {
            if (strtolower($k) === strtolower($key)) {
                return $v;
            }
        }

        // Try with underscores replaced by spaces
        $keyWithSpaces = str_replace('_', ' ', $key);
        foreach ($row as $k => $v) {
            if (strtolower($k) === strtolower($keyWithSpaces)) {
                return $v;
            }
        }

        return '';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'percentage' => 'nullable|numeric|between:0,100',
            'start_year' => 'nullable|digits:4',
            'graduated_year' => 'nullable|digits:4',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'university.required' => 'University is required',
            'faculty.required' => 'Faculty is required',
            'department.required' => 'Department is required',
            'id_conqor.required' => 'ID Conqor is required',
            'percentage.numeric' => 'Percentage must be a number',
            'percentage.between' => 'Percentage must be between 0 and 100',
            'email.email' => 'Email must be a valid email address',
        ];
    }

    public function onError(Throwable $e)
    {
        $this->skippedCount++;
        $this->importErrors[] = "Import error: " . $e->getMessage();
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
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

    private function cleanString($value): string
    {
        if (is_null($value)) {
            return '';
        }

        // Convert to string and trim whitespace
        $cleaned = trim((string) $value);

        // Remove any unwanted characters but preserve Unicode
        $cleaned = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $cleaned);

        return $cleaned;
    }

    private function cleanNumber($value): ?float
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        // Convert to string first, then clean
        $cleaned = trim((string) $value);

        // Remove any non-numeric characters except decimal point
        $cleaned = preg_replace('/[^0-9.]/', '', $cleaned);

        return is_numeric($cleaned) ? (float) $cleaned : null;
    }

    private function cleanEmail($value): ?string
    {
        if (is_null($value) || trim($value) === '') {
            return null;
        }

        $cleaned = $this->cleanString($value);

        // Basic email validation
        return filter_var($cleaned, FILTER_VALIDATE_EMAIL) ? $cleaned : null;
    }

       public function headingRow(): int
    {
        return 1;
    }
}
