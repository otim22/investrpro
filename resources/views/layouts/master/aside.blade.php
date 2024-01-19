<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bs-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: #000b1e !important;">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <h3 class="fw-bold" style="color: #ffffff;">PesaShield</h3>
        </a>

        {{-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a> --}}
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item added-active {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bxs-dashboard'></i>
                <div>Dashboard</div>
            </a>
        </li>
        
        <!-- Investments -->
        <li class="menu-item added-active {{ Request::is('individual-account') ? 'active' : '' }}">
            <a href="{{ route('individual-account') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bxs-user-account'></i>
                <div>Individual Account</div>
            </a>
        </li>

        <!-- Meeting -->
        <li class="menu-item added-active {{ Request::is(['calendar/index', 'meetings']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-calendar'></i>
                <div>Meetings<span class="badge bg-white bg-primary ms-3">10</span></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('calendar/index') ? 'active' : '' }}">
                    <a href="{{ route('calendar.index') }}" class="menu-link text-capitalize">
                        <div>Calendar</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('meetings') ? 'active' : '' }}">
                    <a href="{{ route('meetings.index') }}" class="menu-link text-capitalize">
                        <div>Meetings</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Investments -->
        <li class="menu-item added-active {{ Request::is('investments') ? 'active' : '' }}">
            <a href="{{ route('investments.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-line-chart'></i>
                <div>Investments</div>
            </a>
        </li>
        
        <!-- Assets -->
        <li class="menu-item added-active {{ Request::is('assets') ? 'active' : '' }}">
            <a href="{{ route('assets.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-money'></i>
                <div>Assets</div>
            </a>
        </li>
        
        <!-- Assets -->
        <li class="menu-item added-active {{ Request::is(['procedures', 'loan-application', 'loan-history', 'loan-approval', 'settlements']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bxs-bank'></i>
                <div>Loan service</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('agreement') ? 'active' : '' }}">
                    <a href="{{ route('procedures.index') }}" class="menu-link text-capitalize">
                        <div>Procedure</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('loan-application') ? 'active' : '' }}">
                    <a href="{{ route('loan-application.index') }}" class="menu-link text-capitalize">
                        <div>Loan application</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('loan-history') ? 'active' : '' }}">
                    <a href="{{ route('loan-history') }}" class="menu-link text-capitalize">
                        <div>Loan history</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('loan-approval') ? 'active' : '' }}">
                    <a href="{{ route('loan-approval.index') }}" class="menu-link text-capitalize">
                        <div>Loan approvals</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('settlements') ? 'active' : '' }}">
                    <a href="{{ route('settlements.index') }}" class="menu-link text-capitalize">
                        <div>Settlements</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Expenses -->
        <li class="menu-item added-active {{ Request::is('expenses') ? 'active' : '' }}">
            <a href="{{ route('expenses.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-credit-card-alt'></i>
                <div>Expenses</div>
            </a>
        </li>
        
        <!-- Profits and Loss -->
        <li class="menu-item added-active {{ Request::is('profit-and-loss') ? 'active' : '' }}">
            <a href="{{ route('profit-and-loss.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-dollar-circle'></i>
                <div>Profit & Loss</div>
            </a>
        </li>
        
        <!-- Membership -->
        <li class="menu-item added-active {{ Request::is(['all-members', 'executive-members', 'members']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bxs-group'></i>
                <div>Membership</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('all-members') ? 'active' : '' }}">
                    <a href="{{ route('all-members') }}" class="menu-link text-capitalize">
                        <div>All members</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('executive-members') ? 'active' : '' }}">
                    <a href="{{ route('executive-members') }}" class="menu-link text-capitalize">
                        <div>Executive members</div>
                    </a>
                </li>
                @can('add member')
                    <li class="menu-item {{ Request::is('members') ? 'active' : '' }}">
                        <a href="{{ route('members.index') }}" class="menu-link text-capitalize">
                            <div>Registration</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        
        <!-- Reports -->
        <li class="menu-item added-active {{ Request::is(['general-reports', 'financial-reports', 'audit-reports']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bxs-file'></i>
                <div>Reports</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('general-reports') ? 'active' : '' }}">
                    <a href="{{ route('general-reports.index') }}" class="menu-link text-capitalize">
                        <div>General</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('financial-reports') ? 'active' : '' }}">
                    <a href="{{ route('financial-reports.index') }}" class="menu-link text-capitalize">
                        <div>Financial</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('audit-reports') ? 'active' : '' }}">
                    <a href="{{ route('audit-reports.index') }}" class="menu-link text-capitalize">
                        <div>Audit</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- HR manauls -->
        <li class="menu-item added-active {{ Request::is('hr-manuals') ? 'active' : '' }}">
            <a href="{{ route('hr-manuals.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bxs-file-archive'></i>
                <div>HR Manuals</div>
            </a>
        </li>

        <!-- Account -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-capitalize">Account</span>
        </li>

        <!-- Add user -->
        @can('add user')
            <li class="menu-item added-active {{ Request::is('add-user') ? 'active' : '' }}">
                <a href="{{ route('org.user.index') }}" class="menu-link text-capitalize">
                    <i class='menu-icon bx bx-user-plus'></i>
                    <div>Users</div>
                </a>
            </li>
        @endcan
        <!-- Profile -->
        <li class="menu-item added-active {{ Request::is('profile') ? 'active' : '' }}">
            <a href="{{ route('profile') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bxs-user-circle' ></i>
                <div>Profile</div>
            </a>
        </li>
    </ul>
</aside>

@push('scripts')
    <script>
        function addActiveClass(elem) {
            var a = document.getElementsByTagName('a');
            var menuItems = document.getElementsByClassName('added-active');
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