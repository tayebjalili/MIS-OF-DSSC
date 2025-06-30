<?php

return [
    'specialistof_skill_developments' => [
        'default' => ['field' => 'created_at', 'direction' => 'desc'],
        'columns' => [
            'student_name' => 'Student Name',
            'father_name' => 'Father Name',
            'university' => 'University',
            'faculty' => 'Faculty',
            'national_id' => 'National ID',
            'invention_type' => 'Invention Type',
            'invention_place' => 'Invention Place',
            'expense' => 'Expense',
            'completion_status' => 'Completion Status',
            'created_at' => 'Created Date'
        ]
    ],

    'specialistof_affairsand_sports' => [
        'default' => ['field' => 'start_date', 'direction' => 'desc'],
        'columns' => [
            'activity_title' => 'Activity Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'sports_teams' => 'Sports Teams',
            'sport_type' => 'Sport Type',
            'baget' => 'Baget',
            'created_at' => 'Created Date'
        ]
    ],

    'specialistof_cultural_services' => [
        'default' => ['field' => 'start_date', 'direction' => 'desc'],
        'columns' => [
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'report_type' => 'Report Type',
            'created_at' => 'Created Date'
        ]
    ],

    'directorateof_cultural_socialand_sports_services' => [
        'default' => ['field' => 'job_title', 'direction' => 'asc'],
        'columns' => [
            'job_title' => 'Job Title',
            'location' => 'Location',
            'reports_to' => 'Reports To',
            'created_at' => 'Created Date'
        ]
    ],

    'academic_mentorfor_medical_sciencesand_practical_projects' => [
        'default' => ['field' => 'start_date', 'direction' => 'desc'],
        'columns' => [
            'job_type' => 'Job Type',
            'student_name' => 'Student Name',
            'university_name' => 'University',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'job_time' => 'Job Time',
            'report_type' => 'Report Type',
            'created_at' => 'Created Date'
        ]
    ],

    'mental_health_specialists' => [
        'default' => ['field' => 'department', 'direction' => 'asc'],
        'columns' => [
            'job_title' => 'Job Title',
            'department' => 'Department',
            'location' => 'Location',
            'problem' => 'Problem',
            'created_at' => 'Created Date'
        ]
    ],

    'employment_specialists' => [
        'default' => ['field' => 'name', 'direction' => 'asc'],
        'columns' => [
            'name' => 'Name',
            'id_canqor' => 'ID Canqor',
            'university' => 'University',
            'graduated_year' => 'Graduation Year',
            'percentage' => 'Percentage',
            'created_at' => 'Created Date'
        ]
    ],

    'managementof_practical_workin_natural_sciencesand_sciences' => [
        'default' => ['field' => 'full_name', 'direction' => 'asc'],
        'columns' => [
            'full_name' => 'Full Name',
            'university' => 'University',
            'internship_organization' => 'Organization',
            'internship_duration' => 'Duration',
            'graduation_year' => 'Graduation Year',
            'created_at' => 'Created Date'
        ]
    ],

    'specialistof_practical_workin_social_sciencesand_laws' => [
        'default' => ['field' => 'start_date', 'direction' => 'desc'],
        'columns' => [
            'job_type' => 'Job Type',
            'student_name' => 'Student Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'job_time' => 'Job Time',
            'report_type' => 'Report Type',
            'created_at' => 'Created Date'
        ]
    ],

    'managementof_relationswith_sectoral_agencies' => [
        'default' => ['field' => 'date_signed', 'direction' => 'desc'],
        'columns' => [
            'sector_name' => 'Sector Name',
            'title' => 'Title',
            'partner_institution' => 'Partner',
            'date_signed' => 'Date Signed',
            'report_type' => 'Report Type',
            'created_at' => 'Created Date'
        ]
    ],

    'general_managementof_counseling_services' => [
        'default' => ['field' => 'start_date', 'direction' => 'desc'],
        'columns' => [
            'job_type' => 'Job Type',
            'student_name' => 'Student Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'job_time' => 'Job Time',
            'report_type' => 'Report Type',
            'created_at' => 'Created Date'
        ]
    ],

    'specialistof_graduate_relations' => [
        'default' => ['field' => 'name', 'direction' => 'asc'],
        'columns' => [
            'name' => 'Name',
            'university' => 'University',
            'department' => 'Department',
            'id_conqor' => 'ID Conqor',
            'percentage' => 'Percentage',
            'graduated_year' => 'Graduation Year',
            'created_at' => 'Created Date'
        ]
    ],

    'specialistof_coordinationand_university_relations' => [
        'default' => ['field' => 'activity_date', 'direction' => 'desc'],
        'columns' => [
            'activity_name' => 'Activity Name',
            'activity_date' => 'Activity Date',
            'report_type' => 'Report Type',
            'department' => 'Department',
            'created_at' => 'Created Date'
        ]
    ],

    'directorateof_graduate_coordinationand_inter_sector_relations' => [
        'default' => ['field' => 'date', 'direction' => 'desc'],
        'columns' => [
            'category' => 'Category',
            'title' => 'Title',
            'date' => 'Date',
            'report_frequency' => 'Report Frequency',
            'created_at' => 'Created Date'
        ]
    ],

    'general_database_management' => [
        'default' => ['field' => 'meeting_date', 'direction' => 'desc'],
        'columns' => [
            'meeting_type' => 'Meeting Type',
            'meeting_number' => 'Meeting Number',
            'meeting_date' => 'Meeting Date',
            'created_at' => 'Created Date'
        ]
    ],

    'general_executive_management' => [
        'default' => ['field' => 'created_at', 'direction' => 'desc'],
        'columns' => [
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]
    ],

    'directorateof_coordination_and_student_affairs' => [
        'default' => ['field' => 'job_title', 'direction' => 'asc'],
        'columns' => [
            'job_title' => 'Job Title',
            'created_at' => 'Created Date'
        ]
    ],

    'users' => [
        'default' => ['field' => 'name', 'direction' => 'asc'],
        'columns' => [
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created Date'
        ]
    ]
];
