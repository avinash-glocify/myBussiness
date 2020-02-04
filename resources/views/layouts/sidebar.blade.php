<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="navbar p-0 d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
              <a class="navbar-brand brand-logo" href="#"><img src="/images/logo.svg" alt="logo"/></a>
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
              </button>
            </div>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">{{ Auth::user()->name }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item" style="position:absolute; bottom:0px;">
      <a class="nav-link"  href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      <i class="mdi mdi-logout text-primary menu-icon"></i><span class="menu-title">Logout</span></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      </li
  </ul>
</nav>
