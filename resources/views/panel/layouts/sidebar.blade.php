<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    @php
    $PermissionUser = App\Models\PermissionRoleModel::getPermission('User', Auth::user()->role_id);
    $PermissionRole = App\Models\PermissionRoleModel::getPermission('Role', Auth::user()->role_id);

    @endphp

    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='dashboard') collapsed  @endif " href="{{url('panel/dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link  @if(Request::segment(2) !='user') collapsed  @endif" href="{{url('panel/user')}}">
        <i class="bi bi-person"></i>
        <span>user</span>
      </a>
    </li>



    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='roles') collapsed  @endif" href="{{url('panel/roles')}}">
        <i class="bi bi-person"></i>
        <span>Role</span>
      </a>
    </li>


    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='DirectorateOfCoordinationAndStudentAffairs') collapsed  @endif" href="{{ route('coordination.index') }}">
        <i class="bi bi-person"></i>
        <span> ریاست انسجام خدمات امور محصلان </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='GeneralExecutiveManagement') collapsed  @endif" href="{{ route('executive.list') }}">
        <i class="bi bi-person"></i>
        <span> مدیریت عمومی اجرایه</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='GeneralDatabaseManagement') collapsed  @endif" href="{{ route('database.list') }}">
        <i class="bi bi-person"></i>
        <span> مدیریت عمومی دیتابیس </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='DirectorateofGraduateCoordinationandInterSectorRelations') collapsed  @endif" href="{{ route('graduate.list') }}">
        <i class="bi bi-person"></i>
        <span> آمریت هماهنګی فارغان و روابط بین سکتورها </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofCoordinationandUniversityRelations') collapsed  @endif" href="{{ route('specialist.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس هماهنګی و روابط بین پوهنتونها</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofGraduateRelations') collapsed  @endif" href="{{ route('relations.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس روابط بین فارغان </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='ManagementofRelationswithSectoralAgencies') collapsed  @endif" href="{{ route('sectoral.list') }}">
        <i class="bi bi-person"></i>
        <span> مدیریت روابط با ادارات سکتوری </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='GeneralManagementofCounselingServices') collapsed  @endif" href="{{ route('counseling.list') }}">
        <i class="bi bi-person"></i>
        <span> مدیریت عمومی خدمات مشاوره </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofPracticalWorkinSocialSciencesandLaw') collapsed  @endif" href="{{ route('practical.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس کارهای عملی علوم اجتماعی و حقوقی</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='ManagementofPracticalWorkinNaturalSciencesandScience') collapsed  @endif" href="{{ route('science.list') }}">
        <i class="bi bi-person"></i>
        <span>مدیریت کارهای عملی علوم طبیعی و ساینس </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='EmploymentSpecialist') collapsed  @endif" href="{{ route('employment.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس کاریابی شغلی </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='MentalHealthSpecialist') collapsed  @endif" href="{{ route('health.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس صحت روانی </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='AcademicMentorforMedicalSciencesandPracticalProjects') collapsed  @endif" href="{{ route('academic.list') }}">
        <i class="bi bi-person"></i>
        <span> مدیریت تحصیلی علوم طبی و پروژه عملی</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='DirectorateofCulturalSocialandSportsServices') collapsed  @endif" href="{{ route('cultural.list') }}">
        <i class="bi bi-person"></i>
        <span> آمریت خدمات فرهنګی اجتماعی و ورزشی </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofAffairsandSports') collapsed  @endif" href="{{ route('sports.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس امور و رزشی </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofCulturalServices') collapsed  @endif" href="{{ route('services.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس خدمات فرهنګی </span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link @if(Request::segment(2) !='SpecialistofSkillDevelopment') collapsed  @endif" href="{{ route('skill.list') }}">
        <i class="bi bi-person"></i>
        <span> کارشناس انکشاف مهارت ها </span>
      </a>
    </li>

    <!-- End of added records -->



  </ul>

</aside>
<style>
  /* Default Sidebar Styles */
  .sidebar {
    width: 220px;
    /* Smaller default width */
    transition: all 0.3s ease;
    /* Smooth transition for resizing */
    padding-top: 1rem;
    /* Space at the top */
  }

  /* Shrink the sidebar on medium screens */
  @media (max-width: 1199px) {

    /* Medium and smaller screens */
    .sidebar {
      width: 180px;
      /* Even smaller width */
    }

    .sidebar-nav .nav-item {
      padding-left: 8px;
      /* Reduce padding for nav items */
      padding-right: 8px;
    }

    .sidebar-nav .nav-link {
      padding: 6px 10px;
      /* Reduce padding for nav links */
    }

    .sidebar-nav .nav-link i {
      font-size: 1.15rem;
      /* Slightly smaller icons */
    }

    /* Hide labels for medium and smaller screens */
    .sidebar .nav-link span {
      display: none;
    }
  }

  /* Make the sidebar even smaller on mobile screens */
  @media (max-width: 767px) {

    /* Small screens (mobile) */
    .sidebar {
      width: 50px;
      /* Shrink sidebar to 50px */
    }

    .sidebar-nav .nav-item {
      padding-left: 4px;
      padding-right: 4px;
      /* Further reduce padding for mobile */
    }

    .sidebar-nav .nav-link {
      padding: 6px 8px;
    }

    .sidebar-nav .nav-link i {
      font-size: 1.2rem;
      /* Keep icons small but legible */
    }

    /* Hide all labels completely on mobile */
    .sidebar .nav-link span {
      display: none;
    }

    /* Center icons within nav links */
    .sidebar .nav-link {
      text-align: center;
    }
  }

  /* For large screens (desktop) */
  @media (min-width: 1200px) {
    .sidebar {
      width: 220px;
      /* Default width on large screens */
    }

    .sidebar .nav-link {
      padding: 8px 12px;
      /* Standard padding for nav items */
    }

    .sidebar-nav .nav-link i {
      font-size: 1.3rem;
      /* Slightly smaller icons on desktop */
    }

    .sidebar .nav-link span {
      display: inline;
      /* Keep labels visible on desktop */
    }
  }

  /* Active and hover states */
  .sidebar .nav-link:hover,
  .sidebar .nav-link.active {
    background-color: #f8f9fa;
    /* Highlight on hover or active state */
    border-radius: 5px;
  }
</style>