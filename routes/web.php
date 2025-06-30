<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;


// the other project code

use App\Http\Controllers\DirectorateOfCoordinationAndStudentAffairsController;
use App\Http\Controllers\GeneralExecutiveManagementController;
use App\Http\Controllers\GeneralDatabaseManagementController;
use App\Http\Controllers\DirectorateofGraduateCoordinationandInterSectorRelationsController;
use App\Http\Controllers\SpecialistofCoordinationandUniversityRelationsController;
use App\Http\Controllers\SpecialistofGraduateRelationsController;
use App\Http\Controllers\ManagementofRelationswithSectoralAgenciesController;
use App\Http\Controllers\GeneralManagementofCounselingServicesController;
use App\Http\Controllers\SpecialistofPracticalWorkinSocialSciencesandLawController;
use App\Http\Controllers\ManagementofPracticalWorkinNaturalSciencesandScienceController;
use App\Http\Controllers\EmploymentSpecialistController;
use App\Http\Controllers\MentalHealthSpecialistController;
use App\Http\Controllers\AcademicMentorforMedicalSciencesandPracticalProjectsController;
use App\Http\Controllers\DirectorateofCulturalSocialandSportsServicesController;
use App\Http\Controllers\SpecialistofAffairsandSportsController;
use App\Http\Controllers\SpecialistofCulturalServicesController;
use App\Http\Controllers\SpecialistofSkillDevelopmentController;

//backup
use App\Http\Controllers\BackupController;




Route::get('/', [AuthContoller::class, 'login']);
Route::post('/', [AuthContoller::class, 'auth_login']);
Route::get('logout', [AuthContoller::class, 'logout']);

Route::group(['middleware' => 'useradmin'], function () {
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
    //    Route::get('/lang/{locale}', function ($locale) {
    //     if (!in_array($locale, ['en', 'fa', 'ps'])) {
    //         abort(400); // Invalid locale
    //     }
    //     session(['locale' => $locale]);
    //     app()->setLocale($locale);
    //     return back();
    // })->name('lang.switch');
    Route::get('/lang/{locale}', function ($locale) {
        if (!in_array($locale, ['en', 'ps', 'fa'])) {
            abort(400);
        }

        Session::put('locale', $locale);
        return Redirect::back();
    })->name('lang.switch');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['permission:View Dashboard']);
    Route::get('/lang/{lang}', [DashboardController::class, 'setLanguage'])->name('setLanguage');




    Route::get('panel/roles', [RoleController::class, 'list'])->middleware(['permission:View Roles']);
    Route::get('panel/roles/add', [RoleController::class, 'add'])->middleware(['permission:Add Role']);
    Route::post('panel/roles/add', [RoleController::class, 'insert'])->middleware(['permission:Add Role']);
    Route::get('panel/roles/edit/{id}', [RoleController::class, 'edit'])->middleware(['permission:Edit Role']);
    Route::post('panel/roles/edit/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware(['permission:Edit Role']);
    Route::get('panel/roles/delete/{id}', [RoleController::class, 'delete'])->middleware(['permission:Delete Role']);



    Route::get('panel/user', [UserController::class, 'list'])->middleware(['permission:View Users']);
    Route::get('panel/user/add', [UserController::class, 'add'])->middleware(['permission:add User']);
    Route::post('panel/user/add', [UserController::class, 'insert'])->middleware(['permission:add User']);
    Route::get('panel/user/edit/{id}', [UserController::class, 'edit'])->middleware(['permission:edit User']);
    Route::post('panel/user/edit/{id}', [UserController::class, 'update'])->middleware(['permission:edit User']);
    Route::get('panel/user/delete/{id}', [UserController::class, 'delete'])->middleware(['permission:delete User']);

    // DirectorateOfCoordinationAndStudentAffairs

    Route::get('panel/coordination', [DirectorateOfCoordinationAndStudentAffairsController::class, 'index'])->name('coordination.index')->middleware(['permission:View Directorate of Coordination and Student Affairs']);
    Route::get('panel/coordination/create', [DirectorateOfCoordinationAndStudentAffairsController::class, 'create'])->name('coordination.create')->middleware(['permission:Add Directorate of Coordination and Student Affairs']);
    Route::post('panel/coordination/create', [DirectorateOfCoordinationAndStudentAffairsController::class, 'insert'])->middleware(['permission:Add Directorate of Coordination and Student Affairs']);
    Route::get('panel/coordination/edit/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'edit'])->middleware(['permission:edit Directorate of Coordination and Student Affairs']);
    Route::post('panel/coordination/edit/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'update'])->name('coordination.update')->middleware(['permission:edit Directorate of Coordination and Student Affairs']);
    Route::get('panel/coordination/delete/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'delete'])->middleware(['permission:delete Directorate of Coordination and Student Affairs']);
    Route::get('panel/coordination/show/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'show']);




    // GeneralExecutiveManagement

    Route::get('panel/executive', [GeneralExecutiveManagementController::class, 'list'])->name('executive.list')->middleware(['permission:View General Executive Management']);
    Route::get('panel/executive/add', [GeneralExecutiveManagementController::class, 'add'])->name('executive.add')->middleware(['permission:add General Executive Management']);
    Route::post('panel/executive/add', [GeneralExecutiveManagementController::class, 'insert'])->middleware(['permission:add General Executive Management']);
    Route::get('panel/executive/edit/{id}', [GeneralExecutiveManagementController::class, 'edit'])->middleware(['permission:edit General Executive Management']);
    Route::post('panel/executive/edit/{id}', [GeneralExecutiveManagementController::class, 'update'])->name('executive.update')->middleware(['permission:edit General Executive Management']);
    Route::get('panel/executive/delete/{id}', [GeneralExecutiveManagementController::class, 'delete'])->middleware(['permission:delete General Executive Management']);
    Route::get('panel/executive/show/{id}', [GeneralExecutiveManagementController::class, 'show']);

    Route::get('panel/database', [GeneralDatabaseManagementController::class, 'list'])->name('database.list')->middleware(['permission:View General Database Management']);
    Route::get('panel/database/add', [GeneralDatabaseManagementController::class, 'add'])->name('database.add')->middleware(['permission:add General Database Management']);
    Route::post('panel/database/add', [GeneralDatabaseManagementController::class, 'insert'])->middleware(['permission:add General Database Management']);
    Route::get('panel/database/edit/{id}', [GeneralDatabaseManagementController::class, 'edit'])->middleware(['permission:edit General Database Management'])->name('database.edit');
    Route::post('panel/database/edit/{id}', [GeneralDatabaseManagementController::class, 'update'])->name('database.update')->middleware(['permission:edit General Database Management']);
    Route::get('panel/database/delete/{id}', [GeneralDatabaseManagementController::class, 'delete'])->middleware(['permission:delete General Database Management']);
    Route::get('panel/database/show/{id}', [GeneralDatabaseManagementController::class, 'show'])->name('database.show');
    Route::get('/database/{id}', [GeneralDatabaseManagementController::class, 'show'])->name('database.show');
    Route::get('/database/{id}/file', [GeneralDatabaseManagementController::class, 'showFile'])->name('database.showFile');
    Route::delete('/database/{id}', [GeneralDatabaseManagementController::class, 'destroy'])->name('database.destroy');

    Route::prefix('panel/graduate')->group(function () {
        Route::get('/', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'list'])->name('graduate.list')->middleware(['permission:View Directorate of Graduate Coordination and Inter-Sector Relations']);
        Route::get('/add', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'add'])->name('graduate.add')->middleware(['permission:Add Directorate of Graduate Coordination and Inter-Sector Relations']);
        Route::post('/add', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'insert'])->name('graduate.insert')->middleware(['permission:Add Directorate of Graduate Coordination and Inter-Sector Relations']);
        Route::get('/edit/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'edit'])->name('graduate.edit')->middleware(['permission:Edit Directorate of Graduate Coordination and Inter-Sector Relations']);
        Route::post('/update/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'update'])->name('graduate.update')->middleware(['permission:Edit Directorate of Graduate Coordination and Inter-Sector Relations']);
        Route::delete('panel/graduate/delete/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'delete'])->name('graduate.delete')->middleware(['permission:Delete Directorate of Graduate Coordination and Inter-Sector Relations']);

        // Route::get('/delete/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'delete'])->name('graduate.delete');
        Route::get('/show/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'show'])->name('graduate.show');
        Route::get('/print/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'print'])->name('graduate.print');
    });

    // SpecialistofCoordinationandUniversityRelations
    Route::get('panel/specialist', [SpecialistofCoordinationandUniversityRelationsController::class, 'list'])->name('specialist.list')->middleware(['permission:View Specialist of Coordination and University Relations']);
    Route::get('panel/specialist/add', [SpecialistofCoordinationandUniversityRelationsController::class, 'add'])->name('specialist.add')->middleware(['permission:add Specialist of Coordination and University Relations']);
    Route::post('panel/specialist/add', [SpecialistofCoordinationandUniversityRelationsController::class, 'insert'])->name('specialist.insert')->middleware(['permission:add Specialist of Coordination and University Relations']);
    Route::get('panel/specialist/edit/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'edit'])->middleware(['permission:edit Specialist of Coordination and University Relations']);
    Route::post('panel/specialist/edit/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'update'])->name('specialist.update')->middleware(['permission:edit Specialist of Coordination and University Relations']);
    Route::get('panel/specialist/delete/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'delete'])->middleware(['permission:delete Specialist of Coordination and University Relations']);
    Route::get('panel/specialist/show/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'show']);
    // SpecialistofGraduateRelations
    // List and CRUD routes
    Route::get('panel/relations', [SpecialistofGraduateRelationsController::class, 'list'])
        ->name('relations.list')
        ->middleware(['permission:View Specialist of Graduate Relations']);

    Route::get('panel/relations/add', [SpecialistofGraduateRelationsController::class, 'add'])
        ->name('relations.add')
        ->middleware(['permission:Add Specialist of Graduate Relations']);

    Route::post('panel/relations/add', [SpecialistofGraduateRelationsController::class, 'insert'])
        ->name('relations.insert')
        ->middleware(['permission:Add Specialist of Graduate Relations']);

    Route::get('panel/relations/edit/{id}', [SpecialistofGraduateRelationsController::class, 'edit'])
        ->middleware(['permission:Edit Specialist of Graduate Relations']);

    Route::post('panel/relations/edit/{id}', [SpecialistofGraduateRelationsController::class, 'update'])
        ->name('relations.update')
        ->middleware(['permission:Edit Specialist of Graduate Relations']);

    Route::get('panel/relations/delete/{id}', [SpecialistofGraduateRelationsController::class, 'delete'])
        ->middleware(['permission:Delete Specialist of Graduate Relations']);

    Route::get('panel/relations/show/{id}', [SpecialistofGraduateRelationsController::class, 'show']);

    // Import routes
    Route::get('panel/relations/import', [SpecialistofGraduateRelationsController::class, 'importForm'])
        ->name('relations.import.form')
        ->middleware(['permission:Add Specialist of Graduate Relations']);

    Route::post('panel/relations/import', [SpecialistofGraduateRelationsController::class, 'import'])
        ->name('relations.import')
        ->middleware(['permission:Add Specialist of Graduate Relations']);

    Route::get('panel/relations/download-template', [SpecialistofGraduateRelationsController::class, 'downloadTemplate'])
        ->name('relations.download-template');

    // ManagementofRelationswithSectoralAgencies
    Route::get('panel/sectoral', [ManagementofRelationswithSectoralAgenciesController::class, 'list'])->name('sectoral.list')->middleware(['permission:View Management of Relations with Sectoral Agencies']);
    Route::get('panel/sectoral/add', [ManagementofRelationswithSectoralAgenciesController::class, 'add'])->name('sectoral.add')->middleware(['permission:add Management of Relations with Sectoral Agencies']);
    Route::post('panel/sectoral/add', [ManagementofRelationswithSectoralAgenciesController::class, 'insert'])->name('sectoral.insert')->middleware(['permission:add Management of Relations with Sectoral Agencies']);
    Route::get('panel/sectoral/edit/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'edit'])->middleware(['permission:edit Management of Relations with Sectoral Agencies']);
    Route::post('panel/sectoral/edit/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'update'])->name('sectoral.update')->middleware(['permission:edit Management of Relations with Sectoral Agencies']);
    Route::get('panel/sectoral/delete/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'delete'])->middleware(['permission:delete Management of Relations with Sectoral Agencies']);
    Route::get('panel/sectoral/show/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'show']);

    // GeneralManagementofCounselingServices
    Route::get('panel/counseling', [GeneralManagementofCounselingServicesController::class, 'list'])->name('counseling.list')->middleware(['permission:View General Management of Counseling Services']);
    Route::get('panel/counseling/add', [GeneralManagementofCounselingServicesController::class, 'add'])->name('counseling.add')->middleware(['permission:add General Management of Counseling Services']);
    Route::post('panel/counseling/add', [GeneralManagementofCounselingServicesController::class, 'insert'])->name('counseling.insert')->middleware(['permission:add General Management of Counseling Services']);
    Route::get('panel/counseling/edit/{id}', [GeneralManagementofCounselingServicesController::class, 'edit'])->middleware(['permission:edit General Management of Counseling Services']);
    Route::post('panel/counseling/edit/{id}', [GeneralManagementofCounselingServicesController::class, 'update'])->name('counseling.update')->middleware(['permission:edit General Management of Counseling Services']);
    Route::get('panel/counseling/delete/{id}', [GeneralManagementofCounselingServicesController::class, 'delete'])->middleware(['permission:delete General Management of Counseling Services']);
    Route::get('panel/counseling/show/{id}', [GeneralManagementofCounselingServicesController::class, 'show']);
    // SpecialistofPracticalWorkinSocialSciencesandLaw
    Route::get('panel/practical', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'list'])->name('practical.list')->middleware(['permission:View Specialist of Practical Work in Social Sciences and Law']);
    Route::get('panel/practical/add', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'add'])->name('practical.add')->middleware(['permission:add Specialist of Practical Work in Social Sciences and Law']);
    Route::post('panel/practical/add', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'insert'])->name('practical.insert')->middleware(['permission:add Specialist of Practical Work in Social Sciences and Law']);
    Route::get('panel/practical/edit/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'edit'])->middleware(['permission:edit Specialist of Practical Work in Social Sciences and Law']);
    Route::post('panel/practical/edit/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'update'])->name('practical.update')->middleware(['permission:edit Specialist of Practical Work in Social Sciences and Law']);
    Route::get('panel/practical/delete/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'delete'])->middleware(['permission:delete Specialist of Practical Work in Social Sciences and Law']);
    Route::get('panel/practical/show/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'show']);
    // ManagementofPracticalWorkinNaturalSciencesandScience
    Route::get('panel/science', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'list'])->name('science.list')->middleware(['permission:View Management of Practical Work in Natural Sciences and Science']);
    Route::get('panel/science/add', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'add'])->name('science.add')->middleware(['permission:add Management of Practical Work in Natural Sciences and Science']);
    Route::post('panel/science/add', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'insert'])->middleware(['permission:add Management of Practical Work in Natural Sciences and Science']);
    Route::get('panel/science/edit/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'edit'])->middleware(['permission:edit Management of Practical Work in Natural Sciences and Science']);
    Route::post('panel/science/edit/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'update'])->name('science.update')->middleware(['permission:edit Management of Practical Work in Natural Sciences and Science']);
    Route::get('panel/science/delete/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'delete'])->middleware(['permission:delete Management of Practical Work in Natural Sciences and Science']);
    Route::get('panel/science/show/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'show']);
    //EmploymentSpecialist
    Route::get('panel/employment', [EmploymentSpecialistController::class, 'list'])->name('employment.list')->middleware(['permission:View Employment Specialist']);
    Route::get('panel/employment/add', [EmploymentSpecialistController::class, 'add'])->name('employment.add')->middleware(['permission:add Employment Specialist']);
    Route::post('panel/employment/add', [EmploymentSpecialistController::class, 'insert'])->name('employment.insert')->middleware(['permission:add Employment Specialist']);
    Route::get('panel/employment/edit/{id}', [EmploymentSpecialistController::class, 'edit'])->middleware(['permission:edit Employment Specialist']);
    Route::post('panel/employment/edit/{id}', [EmploymentSpecialistController::class, 'update'])->name('employment.update')->middleware(['permission:edit Employment Specialist']);
    Route::get('panel/employment/delete/{id}', [EmploymentSpecialistController::class, 'delete'])->middleware(['permission:delete Employment Specialist']);
    Route::get('panel/employment/show/{id}', [EmploymentSpecialistController::class, 'show']);
    // MentalHealthSpecialist
    Route::get('panel/health', [MentalHealthSpecialistController::class, 'list'])->name('health.list')->middleware(['permission:View Mental Health Specialist']);
    Route::get('panel/health/add', [MentalHealthSpecialistController::class, 'add'])->name('health.add')->middleware(['permission:Add Mental Health Specialist']);
    Route::post('panel/health/add', [MentalHealthSpecialistController::class, 'insert'])->name('health.insert')->middleware(['permission:Add Mental Health Specialist']);
    Route::get('panel/health/edit/{id}', [MentalHealthSpecialistController::class, 'edit'])->middleware(['permission:Edit Mental Health Specialist']);
    Route::post('panel/health/edit/{id}', [MentalHealthSpecialistController::class, 'update'])->name('health.update')->middleware(['permission:Edit Mental Health Specialist']);
    Route::get('panel/health/delete/{id}', [MentalHealthSpecialistController::class, 'delete'])->middleware(['permission:Delete Mental Health Specialist']);
    Route::get('panel/health/show/{id}', [MentalHealthSpecialistController::class, 'show']);

    // AcademicMentorforMedicalSciencesandPracticalProjects
    Route::get('panel/academic', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'list'])->name('academic.list')->middleware(['permission:View Academic Mentor for Medical Sciences and Practical Projects']);
    Route::get('panel/academic/add', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'add'])->name('academic.add')->middleware(['permission:add Academic Mentor for Medical Sciences and Practical Projects']);
    Route::post('panel/academic/add', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'insert'])->middleware(['permission:add Academic Mentor for Medical Sciences and Practical Projects']);
    Route::get('panel/academic/edit/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'edit'])->middleware(['permission:edit Academic Mentor for Medical Sciences and Practical Projects']);
    Route::post('panel/academic/edit/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'update'])->name('academic.update')->middleware(['permission:edit Academic Mentor for Medical Sciences and Practical Projects']);
    Route::get('panel/academic/delete/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'delete'])->middleware(['permission:delete Academic Mentor for Medical Sciences and Practical Projects']);
    Route::get('panel/academic/show/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'show']);


    // Directorate of Cultural, Social, and Sports Services Routes
    Route::get('panel/cultural', [DirectorateofCulturalSocialandSportsServicesController::class, 'list'])->name('cultural.list')->middleware(['permission:View Directorate of Cultural Social and Sports Services']);
    Route::get('panel/cultural/add', [DirectorateofCulturalSocialandSportsServicesController::class, 'add'])->name('cultural.add')->middleware(['permission:Add Directorate of Cultural Social and Sports Services']);
    Route::post('panel/cultural/add', [DirectorateofCulturalSocialandSportsServicesController::class, 'insert'])->name('cultural.insert')->middleware(['permission:Add Directorate of Cultural Social and Sports Services']);
    Route::get('panel/cultural/edit/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'edit'])->middleware(['permission:Edit Directorate of Cultural Social and Sports Services']);
    Route::post('panel/cultural/edit/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'update'])->name('cultural.update')->middleware(['permission:Edit Directorate of Cultural Social and Sports Services']);
    Route::get('panel/cultural/delete/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'delete'])->middleware(['permission:Delete Directorate of Cultural Social and Sports Services']);
    Route::get('panel/cultural/show/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'show']);

    // SpecialistofAffairsandSports
    Route::get('panel/sports', [SpecialistofAffairsandSportsController::class, 'list'])->name('sports.list')->middleware(['permission:View Specialist of Affairs and Sports']);
    Route::get('panel/sports/add', [SpecialistofAffairsandSportsController::class, 'add'])->name('sports.add')->middleware(['permission:add Specialist of Affairs and Sports']);
    Route::post('panel/sports/add', [SpecialistofAffairsandSportsController::class, 'insert'])->name('sports.insert')->middleware(['permission:add Specialist of Affairs and Sports']);
    Route::get('panel/sports/edit/{id}', [SpecialistofAffairsandSportsController::class, 'edit'])->middleware(['permission:edit Specialist of Affairs and Sports']);
    Route::post('panel/sports/edit/{id}', [SpecialistofAffairsandSportsController::class, 'update'])->name('sports.update')->middleware(['permission:edit Specialist of Affairs and Sports']);
    Route::get('panel/sports/delete/{id}', [SpecialistofAffairsandSportsController::class, 'delete'])->middleware(['permission:delete Specialist of Affairs and Sports']);
    Route::get('panel/sports/show/{id}', [SpecialistofAffairsandSportsController::class, 'show']);
    // SpecialistofCulturalServices
    Route::get('panel/services', [SpecialistofCulturalServicesController::class, 'list'])->name('services.list')->middleware(['permission:View Specialist of Cultural Services']);
    Route::get('panel/services/add', [SpecialistofCulturalServicesController::class, 'add'])->name('services.add')->middleware(['permission:add Specialist of Cultural Services']);
    Route::post('panel/services/add', [SpecialistofCulturalServicesController::class, 'insert'])->name('services.insert')->middleware(['permission:edit Specialist of Cultural Services']);
    Route::get('panel/services/edit/{id}', [SpecialistofCulturalServicesController::class, 'edit'])->middleware(['permission:edit Specialist of Cultural Services']);
    Route::post('panel/services/edit/{id}', [SpecialistofCulturalServicesController::class, 'update'])->name('services.update')->middleware(['permission:edit Specialist of Cultural Services']);
    Route::get('panel/services/delete/{id}', [SpecialistofCulturalServicesController::class, 'delete'])->middleware(['permission:delete Specialist of Cultural Services']);
    Route::get('panel/services/show/{id}', [SpecialistofCulturalServicesController::class, 'show']);
    // SpecialistofSkillDevelopment
    Route::get('panel/skill', [SpecialistofSkillDevelopmentController::class, 'list'])->name('skill.list')->middleware(['permission:View Specialist of Skill Development']);
    Route::get('panel/skill/add', [SpecialistofSkillDevelopmentController::class, 'add'])->name('skill.add')->middleware(['permission:add Specialist of Skill Development']);
    Route::post('panel/skill/add', [SpecialistofSkillDevelopmentController::class, 'insert'])->name('skill.insert')->middleware(['permission:add Specialist of Skill Development']);
    Route::get('panel/skill/edit/{id}', [SpecialistofSkillDevelopmentController::class, 'edit'])->middleware(['permission:edit Specialist of Skill Development']);
    Route::post('panel/skill/edit/{id}', [SpecialistofSkillDevelopmentController::class, 'update'])->name('skill.update')->middleware(['permission:edit Specialist of Skill Development']);
    Route::get('panel/skill/delete/{id}', [SpecialistofSkillDevelopmentController::class, 'delete'])->middleware(['permission:delete Specialist of Skill Development']);
    Route::get('panel/skill/show/{id}', [SpecialistofSkillDevelopmentController::class, 'show']);

    //backup routes
    Route::get('backup/page/{page}', [BackupController::class, 'backupPage'])->name('backup.page');
    Route::get('backup/all', [BackupController::class, 'backupAll'])->name('backup.all');
});


//Route::get('/', function () {
   // return view('welcome');
//});
