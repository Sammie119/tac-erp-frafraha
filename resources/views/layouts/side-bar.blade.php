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
                    <x-menu-item :route="'dashboard'" :icon="'speedometer'">Dashboard</x-menu-item>
                </li>

                @if(use_roles_sidebar(RolesEnum::STAFFMANAGER))
                    <x-main-menu-item
                        :menu_open="['staff', 'attendance', 'customers']"
                        :icon="'people'"
                        :title="'Staff Management'"
                    >
                        <ul class="nav nav-treeview">
                            <x-menu-item :route="'staff'">Staff</x-menu-item>

                            @can(\App\Enums\PermissionsEnum::STAFFATTENDANCE->value)
                                <x-menu-item :route="'attendance'">Attendance</x-menu-item>
                            @endcan

                            @can(\App\Enums\PermissionsEnum::MANAGERCUSTOMER->value)
                                <x-menu-item :route="'customers'">Customers</x-menu-item>
                            @endcan
                        </ul>
                    </x-main-menu-item>
                @endif

                @if(use_roles_sidebar(RolesEnum::PRODUCTMANAGER))
                    <x-main-menu-item
                        :menu_open="['products', 'restock_products', 'product_pricing', 'requisitions', 'suppliers', 'sub_categories', 'materials', 'stores_transfer']"
                        :icon="'seam'"
                        :title="'Inventory'"
                    >
                        <ul class="nav nav-treeview">
                            <x-menu-item :route="'products'">{{ get_logged_user_division_id() === 14 ? 'Item Descriptions' : 'Products' }}</x-menu-item>

                            <x-menu-item :route="'restock_products'">Restock</x-menu-item>

                            <x-menu-item :route="'product_pricing'">Pricing</x-menu-item>

                            @if(get_logged_user_division_id() === 14)
                                <x-menu-item :route="'materials'">Materials</x-menu-item>
                            @endif

                            @if(get_logged_user_division_id() === 42)
                                <x-menu-item :route="'stores_transfer'">Stock Transfer</x-menu-item>
                            @endif

                            @can(\App\Enums\PermissionsEnum::REQUISITIONREQUEST->value)
                                <x-menu-item :route="'requisitions'">Requisition</x-menu-item>
                            @endcan

                            @can(\App\Enums\PermissionsEnum::SUPPLIERSMANAGER->value)
                                <x-menu-item :route="'suppliers'">Suppliers</x-menu-item>
                            @endcan

                            @can(\App\Enums\PermissionsEnum::CREATESTORESPRODUCTS->value)
                                <x-menu-item :route="'sub_categories'">Sub Categories</x-menu-item>
                            @endcan

                        </ul>
                    </x-main-menu-item>
                @endif

                @if(use_roles_sidebar(RolesEnum::TRANSACTIONSMANAGER))
                    <x-main-menu-item
                        :menu_open="['transactions', 'payments', 'transaction_reports', 'waybills', 'sales_banking']"
                        :icon="'cash'"
                        :title="'Transactions'"
                    >
                        <ul class="nav nav-treeview">
                            @can(\App\Enums\PermissionsEnum::VIEWINVOICE->value)
                                <x-menu-item :route="'transactions'">{{ get_logged_user_division_id() === 42 ? 'Sales' : 'Generate Invoice' }}</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWPAYMENT->value)
                                <x-menu-item :route="'payments'">Make Payment</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::PRINTWAYBILL->value)
                                <x-menu-item :route="'waybills'">Waybill</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::CREATESALESBANKING->value)
                                <x-menu-item :route="'sales_banking'">Sales Banking</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWTRANSACTIONREPORT->value)
                                <x-menu-item :route="'transaction_reports'">Transaction Report</x-menu-item>
                            @endcan
                        </ul>
                    </x-main-menu-item>
                @endif

                @if(use_roles_sidebar(RolesEnum::PROJECTMANAGER))
                    <x-main-menu-item
                        :menu_open="['projects', 'tasks', 'my_tasks']"
                        :icon="'display'"
                        :title="'Project Management'"
                    >
                        <ul class="nav nav-treeview">
                            @can(\App\Enums\PermissionsEnum::VIEWALLTASK->value)
                                <x-menu-item :route="'my_tasks'">My Tasks</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWPROJECT->value)
                                <x-menu-item :route="'projects'">Projects</x-menu-item>
                            @endcan
                            @can(\App\Enums\PermissionsEnum::VIEWTASK->value)
                                <x-menu-item :route="'tasks'">Tasks</x-menu-item>
                            @endcan
                        </ul>
                    </x-main-menu-item>
                @endif
                @can(\App\Enums\PermissionsEnum::VIEWFINANCIAL->value)
                    <x-main-menu-item
                        :menu_open="['financials', 'financial_report']"
                        :icon="'cash'"
                        :title="'Financials'"
                    >
                        <ul class="nav nav-treeview">
                            <x-menu-item :route="'financials'">Financial Entries</x-menu-item>

                            <x-menu-item :route="'payments'">Payment</x-menu-item>

                            <x-menu-item :route="'financial_report'">Financial Reports</x-menu-item>

                        </ul>
                    </x-main-menu-item>
                @endcan

                @if(use_roles_sidebar(RolesEnum::STORESMANAGER))
                    <x-main-menu-item
                        :menu_open="['purchase_orders']"
                        :icon="'house'"
                        :title="'Stores'"
                    >
                        <ul class="nav nav-treeview">
                            @can(\App\Enums\PermissionsEnum::PURCHASEORDER->value)
                                <x-menu-item :route="'purchase_orders'">Purchase Order</x-menu-item>
                            @endcan
                        </ul>
                    </x-main-menu-item>
                @endif

                @if(use_roles_sidebar(RolesEnum::USERSMANAGER) || use_roles_sidebar(RolesEnum::SYSTEMADMIN))
                    <x-main-menu-item
                        :menu_open="['users', 'system_lovs', 'roles', 'permissions', 'setups', 'financial_periods']"
                        :icon="'person'"
                        :title="'System Admin'"
                    >
                        <ul class="nav nav-treeview">
                            @if(use_roles_sidebar(RolesEnum::USERSMANAGER))
                                <x-menu-item :route="'users'">User Management</x-menu-item>
                            @endif

                            @if(use_roles_sidebar(RolesEnum::SYSTEMADMIN))
                                <x-menu-item :route="'financial_periods'">Financial Periods</x-menu-item>
                            @endif

                            @if(use_roles_sidebar(RolesEnum::SYSTEMADMIN))
                                <x-menu-item :route="'system_lovs'">List of Values</x-menu-item>
                            @endif

                            @if(get_logged_in_user_id() === 1)
                                <x-menu-item :route="'permissions'">Permissions</x-menu-item>

                                <x-menu-item :route="'roles'">Roles</x-menu-item>
                            @endif

                            <x-menu-item :route="'setups'">Setups</x-menu-item>

                        </ul>
                    </x-main-menu-item>
                @endif
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
</aside>
