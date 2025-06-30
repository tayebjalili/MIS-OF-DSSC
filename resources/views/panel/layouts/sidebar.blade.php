<style>
  .sidebar {
    width: 180px;
    height: calc(100vh -60px);
    position: fixed;
    top: 60px;
    left: 0;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    z-index: 999;
    overflow-y: auto;
  }

  html[dir="rtl"] .sidebar {
    left: auto;
    right: 0;
  }

  .sidebar.hidden {
    transform: translateX(-100%);
  }

  html[dir="rtl"] .sidebar.hidden {
    transform: translateX(100%);
  }

  .main-content {
    transition: all 0.3s;
    min-height: calc(100vh - 60px);
    margin-top: 60px;
    padding: 20px;
  }

  .sidebar-expanded .main-content {
    margin-left: 220px;
  }

  html[dir="rtl"] .sidebar-expanded .main-content {
    margin-left: 0;
    margin-right: 220px;
  }

  .sidebar-collapsed .main-content {
    margin-left: 0;
  }

  html[dir="rtl"] .sidebar-collapsed .main-content {
    margin-right: 0;
  }
</style>

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    @php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Request;

    $roleId = Auth::user()->role_id;
    $managementSegments = ['GeneralExecutiveManagement', 'GeneralDatabaseManagement', 'GeneralManagementofCounselingServices', 'ManagementofRelationswithSectoralAgencies', 'ManagementofPracticalWorkinNaturalSciencesandScience'];
    $directorateSegments = ['DirectorateofGraduateCoordinationandInterSectorRelations', 'DirectorateofCulturalSocialandSportsServices'];
    $specialistSegments = ['SpecialistofCoordinationandUniversityRelations', 'SpecialistofGraduateRelations', 'SpecialistofPracticalWorkinSocialSciencesandLaw', 'EmploymentSpecialist', 'MentalHealthSpecialist', 'AcademicMentorforMedicalSciencesandPracticalProjects', 'SpecialistofAffairsandSports', 'SpecialistofCulturalServices', 'SpecialistofSkillDevelopment'];
    @endphp

    {{-- Dashboard --}}
    @hasPermission('View Dashboard')
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) != 'dashboard') collapsed @endif" href="{{ url('panel/dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>{{ __('messages.dashboard') }}</span>
      </a>
    </li>
    @endhasPermission

    {{-- Users --}}
    @hasPermission('View Users')
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) != 'user') collapsed @endif" href="{{ url('panel/user') }}">
        <i class="bi bi-person"></i>
        <span>{{ __('messages.user') }}</span>
      </a>
    </li>
    @endhasPermission

    {{-- Roles --}}
    @hasPermission('View Roles')
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) != 'roles') collapsed @endif" href="{{ url('panel/roles') }}">
        <i class="bi bi-person"></i>
        <span>{{ __('messages.role') }}</span>
      </a>
    </li>
    @endhasPermission



    {{-- Management Group --}}
    <li class="nav-item">
      <a class="nav-link @if(!in_array(Request::segment(2), $managementSegments)) collapsed @endif" href="#" data-bs-toggle="collapse" data-bs-target="#management-nav" aria-expanded="{{ in_array(Request::segment(2), $managementSegments) ? 'true' : 'false' }}">
        <i class="bi bi-briefcase"></i>
        <span>{{ __('messages.management') }}</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="management-nav" class="nav-content collapse @if(in_array(Request::segment(2), $managementSegments)) show @endif" data-bs-parent="#sidebar-nav">
        @hasPermission('View General Executive Management')
        <li><a href="{{ route('executive.list') }}" class="@if(Request::segment(2) == 'GeneralExecutiveManagement') active @endif">{{ __('messages.executive_management') }}</a></li>
        @endhasPermission
        @hasPermission("View General Database Management")
        <li><a href="{{ route('database.list') }}" class="@if(Request::segment(2) == 'GeneralDatabaseManagement') active @endif">{{ __('messages.database_management') }}</a></li>
        @endhasPermission
        @hasPermission('View General Management of Counseling Services')
        <li><a href="{{ route('counseling.list') }}" class="@if(Request::segment(2) == 'GeneralManagementofCounselingServices') active @endif">{{ __('messages.counseling_services') }}</a></li>
        @endhasPermission
        @hasPermission('View Management of Relations with Sectoral Agencies')
        <li><a href="{{ route('sectoral.list') }}" class="@if(Request::segment(2) == 'ManagementofRelationswithSectoralAgencies') active @endif">{{ __('messages.sectoral_relations') }}</a></li>
        @endhasPermission
        @hasPermission('View Management of Practical Work in Natural Sciences and Science')
        <li><a href="{{ route('science.list') }}" class="@if(Request::segment(2) == 'ManagementofPracticalWorkinNaturalSciencesandScience') active @endif">{{ __('messages.practical_science') }}</a></li>
        @endhasPermission
      </ul>
    </li>

    {{-- Directorate Group --}}
    <li class="nav-item">
      <a class="nav-link @if(!in_array(Request::segment(2), $directorateSegments)) collapsed @endif" href="#" data-bs-toggle="collapse" data-bs-target="#directorate-nav" aria-expanded="{{ in_array(Request::segment(2), $directorateSegments) ? 'true' : 'false' }}">
        <i class="bi bi-building"></i>
        <span>{{ __('messages.directorates') }}</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="directorate-nav" class="nav-content collapse @if(in_array(Request::segment(2), $directorateSegments)) show @endif" data-bs-parent="#sidebar-nav">
        @hasPermission('View Directorate of Graduate Coordination and Inter-Sector Relations')
        <li><a href="{{ route('graduate.list') }}" class="@if(Request::segment(2) == 'DirectorateofGraduateCoordinationandInterSectorRelations') active @endif">{{ __('messages.graduate_affairs') }}</a></li>
        @endhasPermission
        @hasPermission('View Directorate of Cultural Social and Sports Services')
        <li><a href="{{ route('cultural.list') }}" class="@if(Request::segment(2) == 'DirectorateofCulturalSocialandSportsServices') active @endif">{{ __('messages.cultural_sports') }}</a></li>
        @endhasPermission
      </ul>
    </li>

    {{-- Specialists Group --}}
    <li class="nav-item">
      <a class="nav-link @if(!in_array(Request::segment(2), $specialistSegments)) collapsed @endif" href="#" data-bs-toggle="collapse" data-bs-target="#specialist-nav" aria-expanded="{{ in_array(Request::segment(2), $specialistSegments) ? 'true' : 'false' }}">
        <i class="bi bi-people"></i>
        <span>{{ __('messages.specialists') }}</span>
        <i class="bi bi-chevron-down ms-auto toggle-icon"></i>
      </a>
      <ul id="specialist-nav" class="nav-content collapse @if(in_array(Request::segment(2), $specialistSegments)) show @endif" data-bs-parent="#sidebar-nav">
        @hasPermission('View Specialist of Coordination and University Relations')
        <li><a href="{{ route('specialist.list') }}" class="@if(Request::segment(2) == 'SpecialistofCoordinationandUniversityRelations') active @endif">{{ __('messages.university_relations') }}</a></li>
        @endhasPermission
        @hasPermission('View Specialist of Graduate Relations')
        <li><a href="{{ route('relations.list') }}" class="@if(Request::segment(2) == 'SpecialistofGraduateRelations') active @endif">{{ __('messages.graduaterelations') }}</a></li>
        @endhasPermission
        @hasPermission('View Specialist of Practical Work in Social Sciences and Law')
        <li><a href="{{ route('practical.list') }}" class="@if(Request::segment(2) == 'SpecialistofPracticalWorkinSocialSciencesandLaw') active @endif">{{ __('messages.practical_social_law') }}</a></li>
        @endhasPermission
        @hasPermission('View Employment Specialist')
        <li><a href="{{ route('employment.list') }}" class="@if(Request::segment(2) == 'EmploymentSpecialist') active @endif">{{ __('messages.employment') }}</a></li>
        @endhasPermission
        @hasPermission('View Mental Health Specialist')
        <li><a href="{{ route('health.list') }}" class="@if(Request::segment(2) == 'MentalHealthSpecialist') active @endif">{{ __('messages.mental_health') }}</a></li>
        @endhasPermission
        @hasPermission('View Academic Mentor for Medical Sciences and Practical Projects')
        <li><a href="{{ route('academic.list') }}" class="@if(Request::segment(2) == 'AcademicMentorforMedicalSciencesandPracticalProjects') active @endif">{{ __('messages.medicalpracticeadvisor') }}</a></li>
        @endhasPermission
        @hasPermission('View Specialist of Affairs and Sports')
        <li><a href="{{ route('sports.list') }}" class="@if(Request::segment(2) == 'SpecialistofAffairsandSports') active @endif">{{ __('messages.sportsaffairs') }}</a></li>
        @endhasPermission
        @hasPermission('View Specialist of Cultural Services')
        <li><a href="{{ route('services.list') }}" class="@if(Request::segment(2) == 'SpecialistofCulturalServices') active @endif">{{ __('messages.culturalservices') }}</a></li>
        @endhasPermission
        @hasPermission('View Specialist of Skill Development')
        <li><a href="{{ route('skill.list') }}" class="@if(Request::segment(2) == 'SpecialistofSkillDevelopment') active @endif">{{ __('messages.skilldevelopment') }}</a></li>
        @endhasPermission
        @hasPermission('View Directorate of Coordination and Student Affairs')
        <li>
          <a href="{{ route('coordination.index') }}" class="@if(Request::segment(2) == 'DirectorateOfCoordinationAndStudentAffairs') active @endif">
            {{ __('messages.job_placement') }}
          </a>
        </li>
        @endhasPermission

      </ul>
    </li>
  </ul>
</aside>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('main.main');
    const body = document.body;

    // Check localStorage for sidebar state
    const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    if (sidebarCollapsed) {
      sidebar.classList.add('hidden');
      body.classList.add('sidebar-collapsed');
      body.classList.remove('sidebar-expanded');
    } else {
      sidebar.classList.remove('hidden');
      body.classList.add('sidebar-expanded');
      body.classList.remove('sidebar-collapsed');
    }

    toggleButton.addEventListener('click', function() {
      sidebar.classList.toggle('hidden');

      if (sidebar.classList.contains('hidden')) {
        body.classList.add('sidebar-collapsed');
        body.classList.remove('sidebar-expanded');
        localStorage.setItem('sidebarCollapsed', 'true');
      } else {
        body.classList.add('sidebar-expanded');
        body.classList.remove('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', 'false');
      }
    });
  });
</script>
