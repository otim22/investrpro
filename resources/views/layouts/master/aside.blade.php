<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bs-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); background-color: #011338 !important;">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <h3 class="fw-bold" style="color: #ffffff;">PesaBridge</h3>
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
        <li class="menu-item added-active {{ Request::is('calendar') ? 'active' : '' }}">
            <a href="{{ route('calendar.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-calendar'></i>
                <div>Calendar</div>
            </a>
        </li>

        <!-- Investments -->
        <li class="menu-item added-active {{ Request::is('investments') ? 'active' : '' }}">
            <a href="{{ route('investments.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-line-chart'></i>
                <div>Investments</div>
            </a>
        </li>

        <!-- Asset -->
        <li class="menu-item added-active {{ Request::is(['member-savings', 'late-remissions', 'missed-meetings']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-money'></i>
                <div>Assets</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('member-savings') ? 'active' : '' }}">
                    <a href="{{ route('member-savings.index') }}" class="menu-link text-capitalize">
                        <div>Monthly Savings</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('late-remissions') ? 'active' : '' }}">
                    <a href="{{ route('late-remissions.index') }}" class="menu-link text-capitalize">
                        <div>Late remissions</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('missed-meetings') ? 'active' : '' }}">
                    <a href="{{ route('missed-meetings.index') }}" class="menu-link text-capitalize">
                        <div>Missed meetings</div>
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
                <div>Profits & Losses</div>
            </a>
        </li>
        
        <!-- Membership -->
        <li class="menu-item added-active {{ Request::is(['all-members', 'executive-members', 'members', 'membership-fees']) ? 'active' : '' }}" onclick="addActiveClass(this)">
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
                <li class="menu-item {{ Request::is('members') ? 'active' : '' }}">
                    <a href="{{ route('members.index') }}" class="menu-link text-capitalize">
                        <div>Member registration</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('membership-fees') ? 'active' : '' }}">
                    <a href="{{ route('membership-fees.index') }}" class="menu-link text-capitalize">
                        <div>Membership Fee</div>
                    </a>
                </li>
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
        
        <!-- Archive -->
        <li class="menu-item added-active {{ Request::is(['constitution', 'sop', 'saved-emails', 'meeting-minutes', 'elections']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bxs-file-archive'></i>
                <div>HR Manual</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('constitution') ? 'active' : '' }}">
                    <a href="{{ route('constitution.index') }}" class="menu-link text-capitalize">
                        <div>Constitution</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('sop') ? 'active' : '' }}">
                    <a href="{{ route('sop.index') }}" class="menu-link text-capitalize">
                        <div>SOP</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('meeting-minutes') ? 'active' : '' }}">
                    <a href="{{ route('meeting-minutes.index') }}" class="menu-link text-capitalize">
                        <div>Meeting minutes</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('saved-emails') ? 'active' : '' }}">
                    <a href="{{ route('saved-emails.index') }}" class="menu-link text-capitalize">
                        <div>Saved Emails</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('elections') ? 'active' : '' }}">
                    <a href="{{ route('elections.index') }}" class="menu-link text-capitalize">
                        <div>Elections</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-capitalize">settings</span>
        </li>
        
        <!-- General -->
        <li class="menu-item added-active {{ Request::is(['charge-settings', 'asset-types', 'liability-types', 'financial-months', 'financial-years']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-grid'></i>
                <div>General</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('charge-settings') ? 'active' : '' }}">
                    <a href="{{ route('charge-settings.index') }}" class="menu-link text-capitalize">
                        <div>Charges</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('asset-types') ? 'active' : '' }}">
                    <a href="{{ route('asset-types.index') }}" class="menu-link text-capitalize">
                        <div>Asset types</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('liability-types') ? 'active' : '' }}">
                    <a href="{{ route('liability-types.index') }}" class="menu-link text-capitalize">
                        <div>Liability types</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('financial-months') ? 'active' : '' }}">
                    <a href="{{ route('financial-months.index') }}" class="menu-link text-capitalize">
                        <div>Financial Months</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('financial-years') ? 'active' : '' }}">
                    <a href="{{ route('financial-years.index') }}" class="menu-link text-capitalize">
                        <div>Financial years</div>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- Account -->
        <li class="menu-item added-active {{ Request::is(['profile', 'add-user', 'billing']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bxs-user-account'></i>
                <div>Account</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('add-user') ? 'active' : '' }}">
                    <a href="{{ route('org.user.index') }}" class="menu-link text-capitalize">
                        <div>Add user</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="menu-link text-capitalize">
                        <div>Profile</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('billing') ? 'active' : '' }}">
                    <a href="{{ route('billing') }}" class="menu-link text-capitalize">
                        <div>Billing</div>
                    </a>
                </li>
            </ul>
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