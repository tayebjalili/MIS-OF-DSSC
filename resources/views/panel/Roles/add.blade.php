@extends('panel.layouts.app')
@section('content')

<div class="pagetitle">
  <h1> Add New Role</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-9">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add New Role</h5>

          <form action="" method="post">
            {{ csrf_field()}}
            <div class="row mb-3">
              <label for="inputText" class="col-sm-12 col-form-label">Name</label>
              <div class="col-sm-12">
                <input type="text" name="name" required class="form-control">
              </div>
            </div>

            <div class="row mb-3">
              <label style="display: block; margin-bottom: 20px;" for="inputText" class="col-sm-12 col-form-label"><b>Permission</b></label>

              @php
              $permissions = [
              'dashboard' => [
              ['id' => 1, 'name' => 'View Dashboard'],
              ],
              'user' => [
              ['id' => 2, 'name' => 'Add User'],
              ['id' => 3, 'name' => 'Edit User'],
              ['id' => 4, 'name' => 'Delete User'],
              ['id' => 5, 'name' => 'View Users'],
              ],
              'role' => [
              ['id' => 6, 'name' => 'Add Role'],
              ['id' => 7, 'name' => 'Edit Role'],
              ['id' => 8, 'name' => 'Delete Role'],
              ['id' => 9, 'name' => 'View Roles'],
              ],


              'directorate_of_coordination' => [
              ['id' => 1, 'name' => 'View Directorate of Coordination and Student Affairs'],
              ['id' => 2, 'name' => 'Add Directorate of Coordination and Student Affairs'],
              ['id' => 3, 'name' => 'Edit Directorate of Coordination and Student Affairs'],
              ['id' => 4, 'name' => 'Delete Directorate of Coordination and Student Affairs'],
              ],
              'general_executive_management' => [
              ['id' => 5, 'name' => 'View General Executive Management'],
              ['id' => 6, 'name' => 'Add General Executive Management'],
              ['id' => 7, 'name' => 'Edit General Executive Management'],
              ['id' => 8, 'name' => 'Delete General Executive Management'],
              ],
              'general_database_management' => [
              ['id' => 9, 'name' => 'View General Database Management'],
              ['id' => 10, 'name' => 'Add General Database Management'],
              ['id' => 11, 'name' => 'Edit General Database Management'],
              ['id' => 12, 'name' => 'Delete General Database Management'],
              ],
              'graduate_coordination' => [
              ['id' => 13, 'name' => 'View Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 14, 'name' => 'Add Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 15, 'name' => 'Edit Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 16, 'name' => 'Delete Directorate of Graduate Coordination and Inter-Sector Relations'],
              ],
              'coordination_and_university_relations' => [
              ['id' => 17, 'name' => 'View Specialist of Coordination and University Relations'],
              ['id' => 18, 'name' => 'Add Specialist of Coordination and University Relations'],
              ['id' => 19, 'name' => 'Edit Specialist of Coordination and University Relations'],
              ['id' => 20, 'name' => 'Delete Specialist of Coordination and University Relations'],
              ],
              'graduate_relations' => [
              ['id' => 21, 'name' => 'View Specialist of Graduate Relations'],
              ['id' => 22, 'name' => 'Add Specialist of Graduate Relations'],
              ['id' => 23, 'name' => 'Edit Specialist of Graduate Relations'],
              ['id' => 24, 'name' => 'Delete Specialist of Graduate Relations'],
              ],
              'relations_with_sectoral_agencies' => [
              ['id' => 25, 'name' => 'View Management of Relations with Sectoral Agencies'],
              ['id' => 26, 'name' => 'Add Management of Relations with Sectoral Agencies'],
              ['id' => 27, 'name' => 'Edit Management of Relations with Sectoral Agencies'],
              ['id' => 28, 'name' => 'Delete Management of Relations with Sectoral Agencies'],
              ],
              'counseling_services' => [
              ['id' => 29, 'name' => 'View General Management of Counseling Services'],
              ['id' => 30, 'name' => 'Add General Management of Counseling Services'],
              ['id' => 31, 'name' => 'Edit General Management of Counseling Services'],
              ['id' => 32, 'name' => 'Delete General Management of Counseling Services'],
              ],
              'practical_work_social_sciences' => [
              ['id' => 33, 'name' => 'View Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 34, 'name' => 'Add Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 35, 'name' => 'Edit Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 36, 'name' => 'Delete Specialist of Practical Work in Social Sciences and Law'],
              ],
              'practical_work_natural_sciences' => [
              ['id' => 37, 'name' => 'View Management of Practical Work in Natural Sciences and Science'],
              ['id' => 38, 'name' => 'Add Management of Practical Work in Natural Sciences and Science'],
              ['id' => 39, 'name' => 'Edit Management of Practical Work in Natural Sciences and Science'],
              ['id' => 40, 'name' => 'Delete Management of Practical Work in Natural Sciences and Science'],
              ],
              'employment_specialist' => [
              ['id' => 41, 'name' => 'View Employment Specialist'],
              ['id' => 42, 'name' => 'Add Employment Specialist'],
              ['id' => 43, 'name' => 'Edit Employment Specialist'],
              ['id' => 44, 'name' => 'Delete Employment Specialist'],
              ],
              'mental_health_specialist' => [
              ['id' => 45, 'name' => 'View Mental Health Specialist'],
              ['id' => 46, 'name' => 'Add Mental Health Specialist'],
              ['id' => 47, 'name' => 'Edit Mental Health Specialist'],
              ['id' => 48, 'name' => 'Delete Mental Health Specialist'],
              ],
              'academic_mentor' => [
              ['id' => 49, 'name' => 'View Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 50, 'name' => 'Add Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 51, 'name' => 'Edit Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 52, 'name' => 'Delete Academic Mentor for Medical Sciences and Practical Projects'],
              ],
              'cultural_social_services' => [
              ['id' => 53, 'name' => 'View Directorate of Cultural, Social, and Sports Services'],
              ['id' => 54, 'name' => 'Add Directorate of Cultural, Social, and Sports Services'],
              ['id' => 55, 'name' => 'Edit Directorate of Cultural, Social, and Sports Services'],
              ['id' => 56, 'name' => 'Delete Directorate of Cultural, Social, and Sports Services'],
              ],
              'affairs_and_sports' => [
              ['id' => 57, 'name' => 'View Specialist of Affairs and Sports'],
              ['id' => 58, 'name' => 'Add Specialist of Affairs and Sports'],
              ['id' => 59, 'name' => 'Edit Specialist of Affairs and Sports'],
              ['id' => 60, 'name' => 'Delete Specialist of Affairs and Sports'],
              ],
              'cultural_services' => [
              ['id' => 61, 'name' => 'View Specialist of Cultural Services'],
              ['id' => 62, 'name' => 'Add Specialist of Cultural Services'],
              ['id' => 63, 'name' => 'Edit Specialist of Cultural Services'],
              ['id' => 64, 'name' => 'Delete Specialist of Cultural Services'],
              ],
              'skill_development' => [
              ['id' => 65, 'name' => 'View Specialist of Skill Development'],
              ['id' => 66, 'name' => 'Add Specialist of Skill Development'],
              ['id' => 67, 'name' => 'Edit Specialist of Skill Development'],
              ['id' => 68, 'name' => 'Delete Specialist of Skill Development'],
              ],
              ];
              @endphp

              @foreach($permissions as $slug => $permissionGroup)
              <div class="mb-2">
                <strong>{{ ucfirst($slug) }}</strong>
                <div class="form-check">
                  @foreach($permissionGroup as $permission)
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="{{ $permission['id'] }}" name="permission_id[]"> {{ $permission['name'] }}
                  </label><br>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>


            <div class="row mb-3">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>

          </form>

        </div>
      </div>

    </div>


</section>
@endsection