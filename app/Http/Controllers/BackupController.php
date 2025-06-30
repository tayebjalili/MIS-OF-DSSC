<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    // Change this path to your backup directory
    private $backupPath = "D:\projecttt"; // ← Your backup folder path

    /**
     * Backup a specific table as SQL file.
     *
     * @param string $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function backupPage($page)
    {
        $tableMap = [
            'specialist' => 'specialistof_coordinationand_university_relations',
            'coordination' => 'directorateof_coordination_and_student_affairs',
            'executive' => 'general_executive_management',
            'database' => 'general_database_management',
            'graduate' => 'directorateof_graduate_coordinationand_inter_sector_relations',
            'relations' => 'specialistof_graduate_relations',
            'sectoral' => 'managementof_relationswith_sectoral_agencies',
            'counseling' => 'general_managementof_counseling_services',
            'practical' => 'specialistof_practical_workin_social_sciencesand_laws',
            'science' => 'managementof_practical_workin_natural_sciencesand_sciences',
            'employment' => 'employment_specialists',
            'health' => 'mental_health_specialists',
            'academic' => 'academic_mentorfor_medical_sciencesand_practical_projects',
            'cultural' => 'directorateof_cultural_socialand_sports_services',
            'sports' => 'specialistof_affairsand_sports',
            'services' => 'specialistof_cultural_services',
            'skill' => 'specialistof_skill_developments',
        ];

        if (!array_key_exists($page, $tableMap)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid page specified.'], 400);
        }

        $table = $tableMap[$page];

        // Get DB credentials from .env
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '3306');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $filename = $this->backupPath . "/backup_{$page}_" . date('Ymd_His') . ".sql";

        // Prepare the mysqldump command
        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s %s %s > %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            escapeshellarg($table),
            escapeshellarg($filename)
        );

        // Execute the command
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Backup failed. Please check server permissions and mysqldump availability.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'file' => $filename
        ]);
    }

    /**
     * Backup the full database as SQL file.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function backupAll()
    {
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '3306');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $filename = $this->backupPath . "/backup_full_" . date('Ymd_His') . ".sql";

        // Command to dump full database
        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s %s > %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbPort),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            escapeshellarg($filename)
        );

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Backup failed. Please check server permissions and mysqldump availability.'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'file' => $filename
        ]);
    }
}
