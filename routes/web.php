<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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



Route::get('/', [AuthContoller::class, 'login']);
Route::post('/', [AuthContoller::class, 'auth_login']);
Route::get('logout', [AuthContoller::class, 'logout']);

Route::group(['middleware' => 'useradmin'], function () {
   Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);

   Route::get('panel/roles', [RoleController::class, 'list']);
   Route::get('panel/roles/add', [RoleController::class, 'add']);
   Route::post('panel/roles/add', [RoleController::class, 'insert']);
   Route::get('panel/roles/edit/{id}', [RoleController::class, 'edit']);
   Route::post('panel/roles/edit/{id}', [RoleController::class, 'update'])->name('roles.update');
   Route::get('panel/roles/delete/{id}', [RoleController::class, 'delete']);


   Route::get('panel/user', [UserController::class, 'list']);
   Route::get('panel/user/add', [UserController::class, 'add']);
   Route::post('panel/user/add', [UserController::class, 'insert']);
   Route::get('panel/user/edit/{id}', [UserController::class, 'edit']);
   Route::post('panel/user/edit/{id}', [UserController::class, 'update']);
   Route::get('panel/user/delete/{id}', [UserController::class, 'delete']);

   // DirectorateOfCoordinationAndStudentAffairs

   Route::get('panel/coordination', [DirectorateOfCoordinationAndStudentAffairsController::class, 'index'])->name('coordination.index');
   Route::get('panel/coordination/create', [DirectorateOfCoordinationAndStudentAffairsController::class, 'create'])->name('coordination.create');
   Route::post('panel/coordination/create', [DirectorateOfCoordinationAndStudentAffairsController::class, 'insert']);
   Route::get('panel/coordination/edit/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'edit']);
   Route::post('panel/coordination/edit/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'update'])->name('coordination.update');
   Route::get('panel/coordination/delete/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'delete']);
   Route::get('panel/coordination/show/{id}', [DirectorateOfCoordinationAndStudentAffairsController::class, 'show']);




   // GeneralExecutiveManagement

   Route::get('panel/executive', [GeneralExecutiveManagementController::class, 'list'])->name('executive.list');
   Route::get('panel/executive/add', [GeneralExecutiveManagementController::class, 'add'])->name('executive.add');
   Route::post('panel/executive/add', [GeneralExecutiveManagementController::class, 'insert']);
   Route::get('panel/executive/edit/{id}', [GeneralExecutiveManagementController::class, 'edit']);
   Route::post('panel/executive/edit/{id}', [GeneralExecutiveManagementController::class, 'update'])->name('executive.update');
   Route::get('panel/executive/delete/{id}', [GeneralExecutiveManagementController::class, 'delete']);
   Route::get('panel/executive/show/{id}', [GeneralExecutiveManagementController::class, 'show']);

   // GeneralDatabaseManagement
   Route::get('panel/database', [GeneralDatabaseManagementController::class, 'list'])->name('database.list');
   Route::get('panel/database/add', [GeneralDatabaseManagementController::class, 'add'])->name('database.add');
   Route::post('panel/database/add', [GeneralDatabaseManagementController::class, 'insert']);
   Route::get('panel/database/edit/{id}', [GeneralDatabaseManagementController::class, 'edit']);
   Route::post('panel/database/edit/{id}', [GeneralDatabaseManagementController::class, 'update'])->name('database.update');
   Route::get('panel/database/delete/{id}', [GeneralDatabaseManagementController::class, 'delete']);
   Route::get('panel/database/show/{id}', [GeneralDatabaseManagementController::class, 'show']);
   // DirectorateofGraduateCoordinationandInterSectorRelations
   Route::get('panel/graduate', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'list'])->name('graduate.list');
   Route::get('panel/graduate/add', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'add'])->name('graduate.add');
   Route::post('panel/graduate/add', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'insert'])->name('graduate.insert');
   Route::get('panel/graduate/edit/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'edit']);
   Route::post('panel/graduate/edit/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'update'])->name('graduate.update');
   Route::get('panel/graduate/delete/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'delete']);
   Route::get('panel/graduate/show/{id}', [DirectorateofGraduateCoordinationandInterSectorRelationsController::class, 'show']);
   // SpecialistofCoordinationandUniversityRelations
   Route::get('panel/specialist', [SpecialistofCoordinationandUniversityRelationsController::class, 'list'])->name('specialist.list');
   Route::get('panel/specialist/add', [SpecialistofCoordinationandUniversityRelationsController::class, 'add'])->name('specialist.add');
   Route::post('panel/specialist/add', [SpecialistofCoordinationandUniversityRelationsController::class, 'insert'])->name('specialist.insert');
   Route::get('panel/specialist/edit/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'edit']);
   Route::post('panel/specialist/edit/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'update'])->name('specialist.update');
   Route::get('panel/specialist/delete/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'delete']);
   Route::get('panel/specialist/show/{id}', [SpecialistofCoordinationandUniversityRelationsController::class, 'show']);
   // SpecialistofGraduateRelations
   Route::get('panel/relations', [SpecialistofGraduateRelationsController::class, 'list'])->name('relations.list');
   Route::get('panel/relations/add', [SpecialistofGraduateRelationsController::class, 'add'])->name('relations.add');
   Route::post('panel/relations/add', [SpecialistofGraduateRelationsController::class, 'insert'])->name('relations.insert');
   Route::get('panel/relations/edit/{id}', [SpecialistofGraduateRelationsController::class, 'edit']);
   Route::post('panel/relations/edit/{id}', [SpecialistofGraduateRelationsController::class, 'update'])->name('relations.update');
   Route::get('panel/relations/delete/{id}', [SpecialistofGraduateRelationsController::class, 'delete']);
   Route::get('panel/relations/show/{id}', [SpecialistofGraduateRelationsController::class, 'show']);
   // ManagementofRelationswithSectoralAgencies
   Route::get('panel/sectoral', [ManagementofRelationswithSectoralAgenciesController::class, 'list'])->name('sectoral.list');
   Route::get('panel/sectoral/add', [ManagementofRelationswithSectoralAgenciesController::class, 'add'])->name('sectoral.add');
   Route::post('panel/sectoral/add', [ManagementofRelationswithSectoralAgenciesController::class, 'insert'])->name('sectoral.insert');
   Route::get('panel/sectoral/edit/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'edit']);
   Route::post('panel/sectoral/edit/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'update'])->name('sectoral.update');
   Route::get('panel/sectoral/delete/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'delete']);
   Route::get('panel/sectoral/show/{id}', [ManagementofRelationswithSectoralAgenciesController::class, 'show']);
   // GeneralManagementofCounselingServices
   Route::get('panel/counseling', [GeneralManagementofCounselingServicesController::class, 'list'])->name('counseling.list');
   Route::get('panel/counseling/add', [GeneralManagementofCounselingServicesController::class, 'add'])->name('counseling.add');
   Route::post('panel/counseling/add', [GeneralManagementofCounselingServicesController::class, 'insert'])->name('counseling.insert');
   Route::get('panel/counseling/edit/{id}', [GeneralManagementofCounselingServicesController::class, 'edit']);
   Route::post('panel/counseling/edit/{id}', [GeneralManagementofCounselingServicesController::class, 'update'])->name('counseling.update');
   Route::get('panel/counseling/delete/{id}', [GeneralManagementofCounselingServicesController::class, 'delete']);
   Route::get('panel/counseling/show/{id}', [GeneralManagementofCounselingServicesController::class, 'show']);
   // SpecialistofPracticalWorkinSocialSciencesandLaw
   Route::get('panel/practical', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'list'])->name('practical.list');
   Route::get('panel/practical/add', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'add'])->name('practical.add');
   Route::post('panel/practical/add', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'insert'])->name('practical.insert');
   Route::get('panel/practical/edit/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'edit']);
   Route::post('panel/practical/edit/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'update'])->name('practical.update');
   Route::get('panel/practical/delete/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'delete']);
   Route::get('panel/practical/show/{id}', [SpecialistofPracticalWorkinSocialSciencesandLawController::class, 'show']);
   // ManagementofPracticalWorkinNaturalSciencesandScience
   Route::get('panel/science', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'list'])->name('science.list');
   Route::get('panel/science/add', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'add'])->name('science.add');
   Route::post('panel/science/add', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'insert']);
   Route::get('panel/science/edit/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'edit']);
   Route::post('panel/science/edit/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'update'])->name('science.update');
   Route::get('panel/science/delete/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'delete']);
   Route::get('panel/science/show/{id}', [ManagementofPracticalWorkinNaturalSciencesandScienceController::class, 'show']);
   //EmploymentSpecialist
   Route::get('panel/employment', [EmploymentSpecialistController::class, 'list'])->name('employment.list');
   Route::get('panel/employment/add', [EmploymentSpecialistController::class, 'add'])->name('employment.add');
   Route::post('panel/employment/add', [EmploymentSpecialistController::class, 'insert'])->name('employment.insert');
   Route::get('panel/employment/edit/{id}', [EmploymentSpecialistController::class, 'edit']);
   Route::post('panel/employment/edit/{id}', [EmploymentSpecialistController::class, 'update'])->name('employment.update');
   Route::get('panel/employment/delete/{id}', [EmploymentSpecialistController::class, 'delete']);
   Route::get('panel/employment/show/{id}', [EmploymentSpecialistController::class, 'show']);
   // MentalHealthSpecialist
   Route::get('panel/health', [MentalHealthSpecialistController::class, 'list'])->name('health.list');
   Route::get('panel/health/add', [MentalHealthSpecialistController::class, 'add'])->name('health.add');
   Route::post('panel/health/add', [MentalHealthSpecialistController::class, 'insert'])->name('health.insert');
   Route::get('panel/health/edit/{id}', [MentalHealthSpecialistController::class, 'edit']);
   Route::post('panel/health/edit/{id}', [MentalHealthSpecialistController::class, 'update'])->name('health.update');
   Route::get('panel/health/delete/{id}', [MentalHealthSpecialistController::class, 'delete']);
   Route::get('panel/health/show/{id}', [MentalHealthSpecialistController::class, 'show']);
   // AcademicMentorforMedicalSciencesandPracticalProjects
   Route::get('panel/academic', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'list'])->name('academic.list');
   Route::get('panel/academic/add', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'add'])->name('academic.add');
   Route::post('panel/academic/add', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'insert']);
   Route::get('panel/academic/edit/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'edit']);
   Route::post('panel/academic/edit/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'update'])->name('academic.update');
   Route::get('panel/academic/delete/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'delete']);
   Route::get('panel/academic/show/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'show']);
   Route::get('panel/academic/show/{id}', [AcademicMentorforMedicalSciencesandPracticalProjectsController::class, 'show']);
   // DirectorateofCulturalSocialandSportsServices
   Route::get('panel/cultural', [DirectorateofCulturalSocialandSportsServicesController::class, 'list'])->name('cultural.list');
   Route::get('panel/cultural/add', [DirectorateofCulturalSocialandSportsServicesController::class, 'add'])->name('cultural.add');
   Route::post('panel/cultural/add', [DirectorateofCulturalSocialandSportsServicesController::class, 'insert']);
   Route::get('panel/cultural/edit/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'edit']);
   Route::post('panel/cultural/edit/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'update'])->name('cultural.update');
   Route::get('panel/cultural/delete/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'delete']);
   Route::get('panel/cultural/show/{id}', [DirectorateofCulturalSocialandSportsServicesController::class, 'show']);
   // SpecialistofAffairsandSports
   Route::get('panel/sports', [SpecialistofAffairsandSportsController::class, 'list'])->name('sports.list');
   Route::get('panel/sports/add', [SpecialistofAffairsandSportsController::class, 'add'])->name('sports.add');
   Route::post('panel/sports/add', [SpecialistofAffairsandSportsController::class, 'insert'])->name('sports.insert');
   Route::get('panel/sports/edit/{id}', [SpecialistofAffairsandSportsController::class, 'edit']);
   Route::post('panel/sports/edit/{id}', [SpecialistofAffairsandSportsController::class, 'update'])->name('sports.update');
   Route::get('panel/sports/delete/{id}', [SpecialistofAffairsandSportsController::class, 'delete']);
   Route::get('panel/sports/show/{id}', [SpecialistofAffairsandSportsController::class, 'show']);
   // SpecialistofCulturalServices
   Route::get('panel/services', [SpecialistofCulturalServicesController::class, 'list'])->name('services.list');
   Route::get('panel/services/add', [SpecialistofCulturalServicesController::class, 'add'])->name('services.add');
   Route::post('panel/services/add', [SpecialistofCulturalServicesController::class, 'insert'])->name('services.insert');
   Route::get('panel/services/edit/{id}', [SpecialistofCulturalServicesController::class, 'edit']);
   Route::post('panel/services/edit/{id}', [SpecialistofCulturalServicesController::class, 'update'])->name('services.update');
   Route::get('panel/services/delete/{id}', [SpecialistofCulturalServicesController::class, 'delete']);
   Route::get('panel/services/show/{id}', [SpecialistofCulturalServicesController::class, 'show']);
   // SpecialistofSkillDevelopment
   Route::get('panel/skill', [SpecialistofSkillDevelopmentController::class, 'list'])->name('skill.list');
   Route::get('panel/skill/add', [SpecialistofSkillDevelopmentController::class, 'add'])->name('skill.add');
   Route::post('panel/skill/add', [SpecialistofSkillDevelopmentController::class, 'insert'])->name('skill.insert');
   Route::get('panel/skill/edit/{id}', [SpecialistofSkillDevelopmentController::class, 'edit']);
   Route::post('panel/skill/edit/{id}', [SpecialistofSkillDevelopmentController::class, 'update'])->name('skill.update');
   Route::get('panel/skill/delete/{id}', [SpecialistofSkillDevelopmentController::class, 'delete']);
   Route::get('panel/skill/show/{id}', [SpecialistofSkillDevelopmentController::class, 'show']);
});


//Route::get('/', function () {
   // return view('welcome');
//});
