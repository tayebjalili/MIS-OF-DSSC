@extends('panel.layouts.app')
@section('content')

<div class="pagetitle">
  <h1>Add Role</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-9">

          <h5 class="card-title">Add Role</h5>

          <form action="" method="post">
            {{ csrf_field() }}

            <div class="row mb-3">
              <label for="inputText" class="col-sm-12 col-form-label">Name</label>
              <div class="col-sm-12">
                <input type="text" name="name" required class="form-control">
              </div>
            </div>

            <!-- Global Select All -->
            <div class="row mb-3">
              <label class="col-sm-12 col-form-label">
                <input type="checkbox" id="select-all-global"> <strong>Select All Permissions</strong>
              </label>
            </div>

            <!-- Permissions List -->
            <div class="row mb-3">
              <label style="display: block; margin-bottom: 20px;" class="col-sm-12 col-form-label"><b>Permission</b></label>

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
              ['id' => 10, 'name' => 'View Directorate of Coordination and Student Affairs'],
              ['id' => 11, 'name' => 'Add Directorate of Coordination and Student Affairs'],
              ['id' => 12, 'name' => 'Edit Directorate of Coordination and Student Affairs'],
              ['id' => 13, 'name' => 'Delete Directorate of Coordination and Student Affairs'],
              ],
              'general_executive_management' => [
              ['id' => 14, 'name' => 'View General Executive Management'],
              ['id' => 15, 'name' => 'Add General Executive Management'],
              ['id' => 16, 'name' => 'Edit General Executive Management'],
              ['id' => 17, 'name' => 'Delete General Executive Management'],
              ],
              'general_database_management' => [
              ['id' => 18, 'name' => 'View General Database Management'],
              ['id' => 19, 'name' => 'Add General Database Management'],
              ['id' => 20, 'name' => 'Edit General Database Management'],
              ['id' => 21, 'name' => 'Delete General Database Management'],
              ],
              'graduate_coordination' => [
              ['id' => 22, 'name' => 'View Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 23, 'name' => 'Add Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 24, 'name' => 'Edit Directorate of Graduate Coordination and Inter-Sector Relations'],
              ['id' => 25, 'name' => 'Delete Directorate of Graduate Coordination and Inter-Sector Relations'],
              ],
              'coordination_and_university_relations' => [
              ['id' => 26, 'name' => 'View Specialist of Coordination and University Relations'],
              ['id' => 27, 'name' => 'Add Specialist of Coordination and University Relations'],
              ['id' => 28, 'name' => 'Edit Specialist of Coordination and University Relations'],
              ['id' => 29, 'name' => 'Delete Specialist of Coordination and University Relations'],
              ],
              'graduate_relations' => [
              ['id' => 30, 'name' => 'View Specialist of Graduate Relations'],
              ['id' => 31, 'name' => 'Add Specialist of Graduate Relations'],
              ['id' => 32, 'name' => 'Edit Specialist of Graduate Relations'],
              ['id' => 33, 'name' => 'Delete Specialist of Graduate Relations'],
              ],
              'relations_with_sectoral_agencies' => [
              ['id' => 34, 'name' => 'View Management of Relations with Sectoral Agencies'],
              ['id' => 35, 'name' => 'Add Management of Relations with Sectoral Agencies'],
              ['id' => 36, 'name' => 'Edit Management of Relations with Sectoral Agencies'],
              ['id' => 37, 'name' => 'Delete Management of Relations with Sectoral Agencies'],
              ],
              'counseling_services' => [
              ['id' => 38, 'name' => 'View General Management of Counseling Services'],
              ['id' => 39, 'name' => 'Add General Management of Counseling Services'],
              ['id' => 40, 'name' => 'Edit General Management of Counseling Services'],
              ['id' => 41, 'name' => 'Delete General Management of Counseling Services'],
              ],
              'practical_work_social_sciences' => [
              ['id' => 42, 'name' => 'View Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 43, 'name' => 'Add Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 44, 'name' => 'Edit Specialist of Practical Work in Social Sciences and Law'],
              ['id' => 45, 'name' => 'Delete Specialist of Practical Work in Social Sciences and Law'],
              ],
              'practical_work_natural_sciences' => [
              ['id' => 46, 'name' => 'View Management of Practical Work in Natural Sciences and Science'],
              ['id' => 47, 'name' => 'Add Management of Practical Work in Natural Sciences and Science'],
              ['id' => 48, 'name' => 'Edit Management of Practical Work in Natural Sciences and Science'],
              ['id' => 49, 'name' => 'Delete Management of Practical Work in Natural Sciences and Science'],
              ],
              'employment_specialist' => [
              ['id' => 50, 'name' => 'View Employment Specialist'],
              ['id' => 51, 'name' => 'Add Employment Specialist'],
              ['id' => 52, 'name' => 'Edit Employment Specialist'],
              ['id' => 53, 'name' => 'Delete Employment Specialist'],
              ],
              'mental_health_specialist' => [
              ['id' => 54, 'name' => 'View Mental Health Specialist'],
              ['id' => 55, 'name' => 'Add Mental Health Specialist'],
              ['id' => 56, 'name' => 'Edit Mental Health Specialist'],
              ['id' => 57, 'name' => 'Delete Mental Health Specialist'],
              ],
              'academic_mentor' => [
              ['id' => 58, 'name' => 'View Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 59, 'name' => 'Add Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 60, 'name' => 'Edit Academic Mentor for Medical Sciences and Practical Projects'],
              ['id' => 61, 'name' => 'Delete Academic Mentor for Medical Sciences and Practical Projects'],
              ],
              'cultural_social_services' => [
              ['id' => 62, 'name' => 'View Directorate of Cultural Social and Sports Services'],
              ['id' => 63, 'name' => 'Add Directorate of Cultural Social and Sports Services'],
              ['id' => 64, 'name' => 'Edit Directorate of Cultural Social and Sports Services'],
              ['id' => 65, 'name' => 'Delete Directorate of Cultural Social and Sports Services'],
              ],
              'affairs_and_sports' => [
              ['id' => 66, 'name' => 'View Specialist of Affairs and Sports'],
              ['id' => 67, 'name' => 'Add Specialist of Affairs and Sports'],
              ['id' => 68, 'name' => 'Edit Specialist of Affairs and Sports'],
              ['id' => 69, 'name' => 'Delete Specialist of Affairs and Sports'],
              ],
              'cultural_services' => [
              ['id' => 70, 'name' => 'View Specialist of Cultural Services'],
              ['id' => 71, 'name' => 'Add Specialist of Cultural Services'],
              ['id' => 72, 'name' => 'Edit Specialist of Cultural Services'],
              ['id' => 73, 'name' => 'Delete Specialist of Cultural Services'],
              ],
              'skill_development' => [
              ['id' => 74, 'name' => 'View Specialist of Skill Development'],
              ['id' => 75, 'name' => 'Add Specialist of Skill Development'],
              ['id' => 76, 'name' => 'Edit Specialist of Skill Development'],
              ['id' => 77, 'name' => 'Delete Specialist of Skill Development'],
              ],
              ];
              @endphp

              @foreach($permissions as $slug => $permissionGroup)
              <div class="mb-2">
                <strong>
                  {{ ucfirst(str_replace('_', ' ', $slug)) }}
                  <input type="checkbox" class="select-all-group" data-group="{{ $slug }}"> Select All
                </strong>
                <div class="form-check">
                  @foreach($permissionGroup as $permission)
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input permission-checkbox group-{{ $slug }}" value="{{ $permission['id'] }}" name="permission_id[]"> {{ $permission['name'] }}
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
</section>

@push('scripts')
<script>
  document.getElementById('select-all-global').addEventListener('change', function() {
    let isChecked = this.checked;
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
      checkbox.checked = isChecked;
    });
    document.querySelectorAll('.select-all-group').forEach(groupCheckbox => {
      groupCheckbox.checked = isChecked;
    });
  });

  document.querySelectorAll('.select-all-group').forEach(groupCheckbox => {
    groupCheckbox.addEventListener('change', function() {
      let group = this.getAttribute('data-group');
      let isChecked = this.checked;
      document.querySelectorAll('.group-' + group).forEach(checkbox => {
        checkbox.checked = isChecked;
      });
    });
  });
</script>
@endpush

@endsection
