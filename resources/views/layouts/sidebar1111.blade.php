<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="#" class="brand-link">
      <img src="{{url('public/images/action_step_logo.png')}}" alt="Logo" class="brand-image  elevation-3" >
      <span class="brand-text font-weight-light" >Admin</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
           <img src="{{url('public/images/action_step_logo.png')}}" alt="Logo" class="brand-image  elevation-3" >
        </div>
        <!-- <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div> -->
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item  @yield('dashboardMenu')">
            <a href="{{url('Admin/dashboard')}}" class="nav-link @yield('navLinkDashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            
          </li>
          <li class="nav-item  @yield('datadMenu')">
            <a href="{{url('dashboard')}}" class="nav-link @yield('navLinkdata')">
            <i class="fa-solid fa-database"></i>
              <p>
                Data Source
                
              </p>
            </a>
            
          </li>
         
          <li class="nav-item @yield('settingMenu')">
            <a href="#" class="nav-link  @yield('navLinkSetting')">
            <i class="fa-solid fa-gear"></i>
              <p>
              Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('Admin/changePassword')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a>
              </li> -->
            </ul>
          </li>
          <li class="nav-item ">
         
              <a href="route('logout')" class="nav-link"
                  onclick="event.preventDefault();
                  $('.logoutForm').submit();"><i class="fa fa-sign-out fa-rotate-180"></i>&nbsp; {{ __('Log Out') }}
              </a>
               <form method="POST"  class="logoutForm" action="{{ route('logout') }}" >
              @csrf
           </form>
           
            
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>