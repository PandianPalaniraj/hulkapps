<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ url('assets/images/faces-clipart/pic-4.png') }}" alt="profile image" style="height:3rem; width: 3rem;">
          </div>
          <div class="text-wrapper">

            <p class="profile-name">{{ getUserName() }}</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">{{ getUserRole() }}</small>
                <span class="status-indicator online"></span>
              </a>
            </div>
          </div>
        </div>
        @if(getUserRole() !== 'Doctor')
        <button class="btn btn-success btn-block create_new_{{getModuleName()}} text-capitalize">New {{ getModuleName() }}<i class="mdi mdi-plus"></i>
        @endif
        </button>
      </div>
    </li>
    <li class="nav-item {{ active_class(['appointments']) }}">
      <a class="nav-link" href="{{ url('appointments/') }}">
        <i class="menu-icon mdi mdi-book-multiple"></i>
        <span class="menu-title">Appointments</span>
      </a>
    </li>
    @if(getUserRole() !== 'Doctor' && getUserRole() !== 'Patient')
    <li class="nav-item {{ active_class(['doctors']) }}">
        <a class="nav-link" href="{{ url('/doctors') }}">
          <i class="menu-icon mdi mdi-doctor"></i>
          <span class="menu-title">Doctors</span>
        </a>
    </li>
    <li class="nav-item {{ active_class(['patients']) }}">
      <a class="nav-link" href="{{ url('/patients') }}">
        <i class="menu-icon mdi mdi-nature-people"></i>
        <span class="menu-title">Patients</span>
      </a>
    </li>
    @endif
  </ul>
</nav>