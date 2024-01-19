<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bs-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: #000b1e !important;">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <h3 class="fw-bolder ms-2" style="color: #ffffff;">PesaShield</h3>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item added-active {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-tachometer'></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-capitalize">settings</span>
        </li>

        <!-- General -->
        <li class="menu-item added-active {{ Request::is(['admin/charge-settings', 'admin/asset-types', 'admin/expense-types', 'admin/financial-months', 'admin/financial-years']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-grid'></i>
                <div>General</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('admin/charge-settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.charge-settings.index') }}" class="menu-link text-capitalize">
                        <div>Charge types</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/asset-types') ? 'active' : '' }}">
                    <a href="{{ route('admin.asset-types.index') }}" class="menu-link text-capitalize">
                        <div>Asset types</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/expense-types') ? 'active' : '' }}">
                    <a href="{{ route('admin.expense-types.index') }}" class="menu-link text-capitalize">
                        <div>Expense types</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/financial-months') ? 'active' : '' }}">
                    <a href="{{ route('admin.financial-months.index') }}" class="menu-link text-capitalize">
                        <div>Financial Months</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/financial-years') ? 'active' : '' }}">
                    <a href="{{ route('admin.financial-years.index') }}" class="menu-link text-capitalize">
                        <div>Financial years</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Roles -->
        <li class="menu-item {{ Request::is('admin/roles') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-user-circle'></i>
                <div data-i18n="Roles text-capitalize">Roles</div>
            </a>
        </li>

        <!-- Permissions -->
        <li class="menu-item {{ Request::is('admin/permissions') ? 'active' : '' }}">
            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-user-detail' ></i>
                <div data-i18n="Permissions text-capitalize">Permissions</div>
            </a>
        </li>
    </ul>
</aside>

@push('scripts')
    <script>
        function addActiveClass(elem) {
            var a = document.getElementsByTagName('a');
            var menuItems = document.getElementsByTagName('menu-item');
            for (i = 0; i < a.length; i++) {
                a[i].classList.remove('active')
            }
            for (i = 0; i < menuItems.length; i++) {
                menuItems[i].classList.remove('active')
            }
            elem.classList.add('active');
        }
    </script>
@endpush