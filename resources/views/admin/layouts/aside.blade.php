<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bs-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <h3 class="fw-bolder ms-2">InvestrPro</h3>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class='menu-icon bx bx-tachometer'></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-capitalize">settings</span>
        </li>
        <li class="menu-item {{ Request::is('admin.roles') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-user-circle'></i>
                <div data-i18n="Roles text-capitalize">Roles</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin.permissions') ? 'active' : '' }}">
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