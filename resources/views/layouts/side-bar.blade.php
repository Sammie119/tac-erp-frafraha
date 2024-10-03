@php
//    use App\Enums\PermissionsEnum;
    use App\Enums\RolesEnum;
@endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link"> <!--begin::Brand Image--> <img src="{{ asset('dist/assets/img/tacgh_logo.png') }}" alt="Logo" class="brand-image opacity-100 shadow rounded"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">TAC-GH</span> <!--end::Brand Text--> </a> <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"> <i class="nav-icon bi bi-speedometer" style="font-size: 20px"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if(use_roles_sidebar(RolesEnum::STAFFMANAGER))
                    <li class="nav-item"> <a href="#" class="nav-link
                    {{ request()->is('staff') ? 'active' : '' }}
                    {{ request()->is('attendance') ? 'active' : '' }}
                    "> <i class="nav-icon bi bi-people" style="font-size: 20px"></i>
                            <p>
                                Staff Management
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"> <a href="{{ route('staff') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Staff</p>
                                </a>
                            </li>
                            <li class="nav-item"> <a href="{{ route('attendance') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Attendance</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(use_roles_sidebar(RolesEnum::PRODUCTMANAGER))
                    <li class="nav-item"> <a href="#" class="nav-link
                    {{ request()->is('products') ? 'active' : '' }}
                    {{ request()->is('restock_products') ? 'active' : '' }}
                    {{ request()->is('product_pricing') ? 'active' : '' }}
                    {{ request()->is('requisitions') ? 'active' : '' }}
                    "> <i class="nav-icon bi bi-box-seam-fill" style="font-size: 20px"></i>
                            <p>
                                Inventory
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"> <a href="{{ route('products') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item"> <a href="{{ route('restock_products') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Restock</p>
                                </a>
                            </li>
                            <li class="nav-item"> <a href="{{ route('product_pricing') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Pricing</p>
                                </a>
                            </li>
                            @can(\App\Enums\PermissionsEnum::REQUISITIONREQUEST->value)
                            <li class="nav-item"> <a href="{{ route('requisitions') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Requisition</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if(use_roles_sidebar(RolesEnum::TRANSACTIONSMANAGER))
                    <li class="nav-item"> <a href="#" class="nav-link
                    {{ request()->is('transactions') ? 'active' : '' }}
                    {{ request()->is('payments') ? 'active' : '' }}
                    {{ request()->is('transaction_reports') ? 'active' : '' }}
                    {{ request()->is('waybills') ? 'active' : '' }}
                    "> <i class="nav-icon bi bi-cash-coin" style="font-size: 20px"></i>
                            <p>
                                Transactions
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can(\App\Enums\PermissionsEnum::VIEWINVOICE->value)
                                <li class="nav-item"> <a href="{{ route('transactions') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Generate Invoice</p>
                                    </a>
                                </li>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWPAYMENT->value)
                                <li class="nav-item"> <a href="{{ route('payments') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Make Payment</p>
                                    </a>
                                </li>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::PRINTWAYBILL->value)
                            <li class="nav-item"> <a href="{{ route('waybills') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Waybill</p>
                                </a>
                            </li>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWTRANSACTIONREPORT->value)
                                <li class="nav-item"> <a href="{{ route('transaction_reports') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Transaction Report</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if(use_roles_sidebar(RolesEnum::PROJECTMANAGER))
                    <li class="nav-item"> <a href="#" class="nav-link
                    {{ request()->is('projects') ? 'active' : '' }}
                    {{ request()->is('tasks') ? 'active' : '' }}
                    {{ request()->is('my_tasks') ? 'active' : '' }}
                    "> <i class="bi bi-pc-display" style="font-size: 20px"></i>
                            <p>
                                Project Management
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can(\App\Enums\PermissionsEnum::VIEWALLTASK->value)
                            <li class="nav-item"> <a href="{{ route('my_tasks') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>My Tasks</p>
                                </a>
                            </li>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWPROJECT->value)
                            <li class="nav-item"> <a href="{{ route('projects') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Projects</p>
                                </a>
                            </li>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWTASK->value)
                            <li class="nav-item"> <a href="{{ route('tasks') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Tasks</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <li class="nav-item"> <a href="#" class="nav-link
                {{ request()->is('financials') ? 'active' : '' }}
                {{ request()->is('financial_report') ? 'active' : '' }}
                "> <i class="nav-icon bi bi-cash-coin" style="font-size: 20px"></i>
                        <p>
                            Financials
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can(\App\Enums\PermissionsEnum::VIEWFINANCIAL->value)
                            <li class="nav-item"> <a href="{{ route('financials') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Financial Entries</p>
                                </a>
                            </li>
                        @endcan
                        @can(\App\Enums\PermissionsEnum::VIEWPAYMENT->value)
                            <li class="nav-item"> <a href="{{ route('payments') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Payment</p>
                                </a>
                            </li>
                        @endcan
                        @can(\App\Enums\PermissionsEnum::FINANCIALREPORT->value)
                            <li class="nav-item"> <a href="{{ route('financial_report') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Financial Reports</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i class="bi bi-house-door" style="font-size: 20px"></i>
                        <p>
                            Stores
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="./tables/simple.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                <p>Simple Tables</p>
                            </a> </li>
                    </ul>
                </li>

                @if(use_roles_sidebar(RolesEnum::USERSMANAGER) || use_roles_sidebar(RolesEnum::SYSTEMADMIN))
                    <li class="nav-item"> <a href="#" class="nav-link
                        {{ request()->is('users') ? 'active' : '' }}
                        {{ request()->is('system_lovs') ? 'active' : '' }}
                        {{ request()->is('roles') ? 'active' : '' }}
                        {{ request()->is('permissions') ? 'active' : '' }}
                        {{ request()->is('setups') ? 'active' : '' }}

                        "> <i class="nav-icon bi bi-person" style="font-size: 20px"></i>
                            <p>
                                System Admin
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(use_roles_sidebar(RolesEnum::USERSMANAGER))
                                <li class="nav-item"> <a href="{{ route('users') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>User Management</p>
                                    </a>
                                </li>
                            @endif

                            @if(use_roles_sidebar(RolesEnum::SYSTEMADMIN))
                                <li class="nav-item"> <a href="{{ route('system_lovs') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>List of Values</p>
                                    </a>
                                </li>
                            @endif

                            @if(get_logged_in_user_id() === 1)
                                <li class="nav-item"> <a href="{{ route('permissions') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>

                                <li class="nav-item"> <a href="{{ route('roles') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                           @endif

                            <li class="nav-item"> <a href="{{ route('setups') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                    <p>Setups</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item"> <a href="{{ route('profile.edit') }}" class="nav-link"> <i class="nav-icon bi bi-circle"></i> <!-- <i class="nav-icon bi bi-people"></i> -->
                                <p>{{ __('Profile') }}</p>
                            </a>

                            <li class="nav-item"> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link"> <i class="nav-icon bi bi-circle"></i> <!-- <i class="nav-icon bi bi-people"></i> -->
                                <p>{{ __('Log Out') }}</p>
                            </a> --}}

    {{--                    </li>--}}
                        </ul>
                    </li>
                @endif
                {{-- <li class="nav-item"> <a href="" class="nav-link"> <i class="nav-icon bi bi-people"></i>
                    <p></p>
                </a> </li> --}}
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
</aside>
