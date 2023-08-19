 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name; }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
                <a href="dashboard" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard 
                    </p>
                </a>
          </li>
         <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                 Groups
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="group" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                  <p>
                    Create Group 
                  </p>
              </a>
            </li>
              <li class="nav-item">
                <a href="assign-mails" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Assign E-Mails 
                    </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-groups" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    View Groups  
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
               Campaigns
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="campaign" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                     Campaign Schedule
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-campaign" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                     Campaigns  
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                  Templates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="template" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Create Template
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view-templates" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                     Templates  
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
              <a href="" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>