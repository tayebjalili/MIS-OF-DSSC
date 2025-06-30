<!-- Add Bootstrap's JS for Dropdown Functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
  /* Reduced Header Styling */
  #header.header {
    background: linear-gradient(90deg, #0d6efd, #5b9df9);
    color: #fff;
    padding: 3px 15px;
    /* Reduced vertical padding */
    height: 50px;
    /* Reduced height */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
  }



  #header .logo img {
    height: 24px;
    /* Adjusted image size to match reduced header */
    width: auto;
  }

  #header .nav-profile img {
    height: 28px;
    /* Adjusted profile image */
    width: 28px;
  }

  #header .dropdown-toggle {
    padding: 2px 10px !important;
    /* Reduced padding */
    font-size: 13px;
    /* Slightly smaller font */
  }

  /* Header styling */
  #header.header {
    background: linear-gradient(90deg, #0d6efd, #5b9df9);
    color: #fff;
    padding: 5px 20px;
    height: 40px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
  }

  #header .logo img {
    height: 30px;
    width: auto;
  }

  #header .logo span {
    font-size: 16px;
    color: #fff;
  }

  .toggle-sidebar-btn {
    font-size: 20px;
    margin-left: 5px;
    margin-right: 10px;
    color: #fff;
    cursor: pointer;
  }

  #header .nav-profile img {
    height: 32px;
    width: 32px;
  }

  #header .dropdown-toggle {
    padding: 4px 12px !important;
    font-size: 14px;
  }

  .dropdown-menu a.dropdown-item {
    font-size: 14px;
    padding: 6px 12px;
  }

  #languageDropdown {
    border-radius: 50px !important;
    padding: 6px 16px !important;
    font-size: 14px;
    background-color: #ffffff;
    color: #0d6efd;
    border: none;
  }

  .d-flex.justify-content-end.mb-4 {
    margin-top: 10px !important;
    margin-bottom: 0 !important;
  }

  body {
    padding-top: 50px;
    /* Match the header height, adjust if needed */
  }
  .profile-avatar-wrapper {
  position: relative;
}

.profile-avatar {
  border: 3px solid #ffffff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  object-fit: cover;
}

.nav-profile:hover .profile-avatar {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Online Indicator */
.online-indicator {
  position: absolute;
  bottom: 2px;
  right: 2px;
  width: 12px;
  height: 12px;
  background: linear-gradient(135deg, #00d4aa, #00b894);
  border: 2px solid #ffffff;
  border-radius: 50%;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}



/* Chevron Icon */
.profile-chevron {
  color: #7f8c8d;
  font-size: 0.8rem;
  transition: transform 0.3s ease, color 0.3s ease;
}

.nav-profile:hover .profile-chevron {
  color: #3498db;
}

.nav-profile[aria-expanded="true"] .profile-chevron {
  transform: rotate(180deg);
}

/* Dropdown Menu */
.profile-dropdown {
  border: 0;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
  border-radius: 12px;
  padding: 0;
  margin-top: 8px;
  min-width: 280px;
  overflow: hidden;
  background: #ffffff;
}

.profile-dropdown::before {
  content: '';
  position: absolute;
  top: -8px;
  right: 20px;
  width: 16px;
  height: 16px;
  background: #ffffff;
  transform: rotate(45deg);
  box-shadow: -2px -2px 5px rgba(0, 0, 0, 0.1);
}

/* Profile Info Section */
.profile-info {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  margin: 0;
}

.profile-info img {
  border: 3px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.user-details h6 {
  color: white;
  font-size: 1rem;
}

.user-details small {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.85rem;
}

/* Logout Item */
.logout-item {
  padding: 12px 20px;
  transition: all 0.3s ease;
  color: #e74c3c;
  font-weight: 500;
}

.logout-item:hover {
  background: linear-gradient(135deg, #ff6b6b, #ee5a24);
  color: white;
  transform: translateX(5px);
}

.logout-icon-wrapper {
  width: 35px;
  height: 35px;
  background: rgba(231, 76, 60, 0.1);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.logout-item:hover .logout-icon-wrapper {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.1);
}

.logout-icon-wrapper i {
  font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
  .profile-dropdown {
    min-width: 250px;
  }

  .profile-dropdown::before {
    right: 15px;
  }
}

/* Animation */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.profile-dropdown.show {
  animation: slideDown 0.3s ease;
}

  /* Sidebar fix with header */
  #sidebar {
    position: fixed;
    /* Fix sidebar to stay in place */
    top: 40px;
    /* Push it below the header */
    left: 0;
    height: calc(100%);
    /* Full height minus header */
    z-index: 999;
    overflow-y: auto;
  }

  /* Adjust main page content with fixed header and sidebar */
  #main {
    margin-left: 200px;
    /* Adjust depending on your sidebar width */
    padding: 20px;
    margin-top: 0;
    /* Header is handled by body padding */
  }
  @media (max-width: 991.98px) {
  #header.header {
    height: auto;
    padding: 8px 15px;
    flex-wrap: wrap;
  }

  #header .logo img {
    height: 24px;
  }

  #header .logo span {
    font-size: 14px;
  }

  .toggle-sidebar-btn {
    font-size: 18px;
    margin-left: 10px;
  }

  #languageDropdown {
    font-size: 13px;
    padding: 5px 10px !important;
  }

  .dropdown-menu {
    font-size: 13px;
  }

  .profile-avatar {
    height: 32px !important;
    width: 32px !important;
  }

  .profile-dropdown {
    min-width: 220px;
    margin-top: 6px;
  }

  .profile-info img {
    width: 45px;
    height: 45px;
  }

  .user-details h6 {
    font-size: 0.95rem;
  }

  .user-details small {
    font-size: 0.8rem;
  }

  .logout-item {
    padding: 10px 16px;
    font-size: 13px;
  }

  .logout-icon-wrapper {
    width: 30px;
    height: 30px;
  }

  /* Adjust toggle button position */
  #themeToggle {
    top: 60%;
    left: 90%;
    font-size: 18px;
  }

  #main {
    margin-left: 0 !important;
    padding: 15px;
  }

  #sidebar {
    top: 50px;
    width: 100%;
    position: fixed;
    z-index: 999;
    height: auto;
    display: none; /* You can toggle this with JS on small screens */
  }
}

</style>

<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
      <img src="{{ url('') }}/assets/img/12.png" alt="">
      <span class="d-none d-lg-block">ریاست انسجام محصلان</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" id="toggleSidebar"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <!-- Language Dropdown -->
      <li class="nav-item dropdown me-3">
        <div class="dropdown">
          <button class="btn btn-outline-primary dropdown-toggle shadow-sm px-3 py-1 rounded-pill" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            {{ App::getLocale() == 'ps' ? 'پښتو' : (App::getLocale() == 'fa' ? 'فارسی' : 'English') }}
          </button>
          <ul class="dropdown-menu dropdown-menu-end text-center shadow-sm" aria-labelledby="languageDropdown">
            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}"> English</a></li>
            <li><a class="dropdown-item" href="{{ route('lang.switch', 'ps') }}"> پښتو</a></li>
            <li><a class="dropdown-item" href="{{ route('lang.switch', 'fa') }}"> فارسی</a></li>
          </ul>
        </div>
      </li>

      <!-- Profile Dropdown -->

<li class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center pe-0 position-relative" href="#" data-bs-toggle="dropdown">
    <div class="profile-avatar-wrapper position-relative">
      <img src="{{ asset('assets/img/default-avatar.png') }}"
           alt="Profile"
           class="profile-avatar rounded-circle"
           width="40"
           height="40">
      <div class="online-indicator"></div>
    </div>
    <i class="bi bi-chevron-down ps-1 profile-chevron"></i>
  </a>

  <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
    <li class="profile-info">
      <div class="d-flex align-items-center p-3">
        <img src="{{ asset('assets/img/default-avatar.png') }}"
             alt="Profile"
             class="rounded-circle me-3"
             width="50"
             height="50">
        <div class="user-details">
          <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
          <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
      </div>
    </li>

    <li><hr class="dropdown-divider m-0"></li>

    <li>
      <a class="dropdown-item logout-item d-flex align-items-center" href="{{ url('logout') }}">
        <div class="logout-icon-wrapper me-3">
          <i class="bi bi-box-arrow-right"></i>
        </div>
        <span>{{ __('messages.Logout') }}</span>
      </a>
    </li>
  </ul>
</li><!-- End Profile Nav -->
    </ul>
  </nav><!-- End Icons Navigation -->

  <button id="themeToggle" onclick="toggleDarkMode()"
    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2001; background: none; border: none; font-size: 20px; cursor: pointer; color: white;">
    🌙
  </button>


  <script>
    // Toggle between light and dark mode
    function toggleDarkMode() {
      const body = document.body;
      const toggleBtn = document.getElementById('themeToggle');

      body.classList.toggle('dark-mode');

      // Change icon based on mode
      if (body.classList.contains('dark-mode')) {
        toggleBtn.textContent = '☀️'; // Sun icon for light mode
      } else {
        toggleBtn.textContent = '🌙'; // Moon icon for dark mode
      }
    }
  </script>

</header><!-- End Header -->
