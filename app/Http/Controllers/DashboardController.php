<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
//use Illuminate\Support\Facades\Auth;

// Import all models
use App\Models\ManagementofRelationswithSectoralAgencies;
use App\Models\MentalHealthSpecialist;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use App\Models\RoleModel;
use App\Models\SpecialistofAffairsandSports;
use App\Models\SpecialistofCoordinationandUniversityRelations;
use App\Models\SpecialistofCulturalServices;
use App\Models\SpecialistofGraduateRelations;
use App\Models\SpecialistofPracticalWorkinSocialSciencesandLaw;
use App\Models\SpecialistofSkillDevelopment;
use App\Models\User;
use App\Models\AcademicMentorforMedicalSciencesandPracticalProjects;
use App\Models\DirectorateofCoordinationandStudentAffairs;
use App\Models\DirectorateofCulturalSocialandSportsServices;
use App\Models\DirectorateofGraduateCoordinationandInterSectorRelations;
use App\Models\EmploymentSpecialist;
use App\Models\GeneralDatabaseManagement;
use App\Models\GeneralExecutiveManagement;
use App\Models\GeneralManagementofCounselingServices;
use App\Models\ManagementofPracticalWorkinNaturalSciencesandScience;

class DashboardController extends BaseController
{
    public function dashboard()
    {

        // General user & permission statistics
        $totalUsers = User::count();
        $totalRoles = RoleModel::count();
        $totalPermissions = PermissionModel::count();
        $permissionRoleRelations = PermissionRoleModel::count();

        // Directorate counts
        $directorates = [
            'CoordinationAndStudentAffairs' => DirectorateofCoordinationandStudentAffairs::count(),
            'CulturalSocialAndSportsServices' => DirectorateofCulturalSocialandSportsServices::count(),
            'GraduateCoordinationAndInterSectorRelations' => DirectorateofGraduateCoordinationandInterSectorRelations::count(),
        ];

        // Specialist counts
        $specialists = [
            'AffairsAndSports' => SpecialistofAffairsandSports::count(),
            'CoordinationUniversityRelations' => SpecialistofCoordinationandUniversityRelations::count(),
            'CulturalServices' => SpecialistofCulturalServices::count(),
            'GraduateRelations' => SpecialistofGraduateRelations::count(),
            'PracticalWorkSocialSciences' => SpecialistofPracticalWorkinSocialSciencesandLaw::count(),
            'SkillDevelopment' => SpecialistofSkillDevelopment::count(),
            'MentalHealth' => MentalHealthSpecialist::count(),
            'Employment' => EmploymentSpecialist::count(),
        ];

        // General management roles
        $generalManagement = [
            'DatabaseManagement' => GeneralDatabaseManagement::count(),
            'ExecutiveManagement' => GeneralExecutiveManagement::count(),
            'CounselingServices' => GeneralManagementofCounselingServices::count(),
        ];

        // Others
        $academicMentors = AcademicMentorforMedicalSciencesandPracticalProjects::count();
        $sectoralRelations = ManagementofRelationswithSectoralAgencies::count();
        $practicalWorkNaturalSciences = ManagementofPracticalWorkinNaturalSciencesandScience::count();

        // Return view with all statistics
        return view('panel.dashboard', [
            'totalUsers' => $totalUsers,
            'totalRoles' => $totalRoles,
            'totalPermissions' => $totalPermissions,
            'permissionRoleRelations' => $permissionRoleRelations,

            'directorates' => $directorates,
            'specialists' => $specialists,
            'generalManagement' => $generalManagement,

            'academicMentors' => $academicMentors,
            'sectoralRelations' => $sectoralRelations,
            'practicalWorkNaturalSciences' => $practicalWorkNaturalSciences,
        ]);
    }

    public function setLanguage($lang)
    {
        $availableLanguages = ['en', 'ps', 'fa'];

        if (in_array($lang, $availableLanguages)) {
            session()->put('locale', $lang);
            App::setLocale($lang);
        } else {
            session()->put('locale', 'en');
            App::setLocale('en');
        }

        return redirect()->back();
    }
}
