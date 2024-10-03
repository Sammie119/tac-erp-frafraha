<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
            <li class="nav-item d-none d-md-block"> <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a> </li>
            <!-- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li> -->
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">20</span> </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span class="dropdown-item dropdown-header">Notifications</span>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span> </a>

                </div>
            </li> <!--end::Notifications Dropdown Menu--> <!--begin::Fullscreen Toggle-->
            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <span class="d-none d-md-inline">{{ get_logged_staff_name() }}</span> </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="text-bg-primary">
                        <p style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
                           <span style="font-size: 1.3rem; padding-left:5px; padding-right: 5px;">{{ get_logged_staff_name() }}</span> <br> <!-- Chjange for staff name and position -->
                            <span>{{ get_logged_staff_position() }}, {{ get_logged_user_division_name() }}</span>
                        </p>
                    </li> <!--end::User Image--> <!--begin::Menu Body-->
                    <li class="user-footer"> <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-end">Log Out</a> </li> <!--end::Menu Footer-->
                </ul>
            </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->
    </div> <!--end::Container-->
</nav> <!--end::Header-->
