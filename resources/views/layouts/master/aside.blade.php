<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bs-class="bg-menu-theme" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            {{-- <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <path
                            d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                            id="path-1"></path>
                        <path
                            d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                            id="path-3"></path>
                        <path
                            d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                            id="path-4"></path>
                        <path
                            d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                            id="path-5"></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                            <g id="Icon" transform="translate(27.000000, 15.000000)">
                                <g id="Mask" transform="translate(0.000000, 8.000000)">
                                    <mask id="mask-2" fill="white">
                                        <use xlink:href="#path-1"></use>
                                    </mask>
                                    <use fill="#696cff" xlink:href="#path-1"></use>
                                    <g id="Path-3" mask="url(#mask-2)">
                                        <use fill="#696cff" xlink:href="#path-3"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                    </g>
                                    <g id="Path-4" mask="url(#mask-2)">
                                        <use fill="#696cff" xlink:href="#path-4"></use>
                                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                    </g>
                                </g>
                                <g id="Triangle"
                                    transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                    <use fill="#696cff" xlink:href="#path-5"></use>
                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span> --}}
            <h3 class="fw-bolder ms-2">InvestrPro</h3>
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
        <li class="menu-item added-active {{ Request::is('investments') ? 'active' : '' }}">
            <a href="{{ route('investments.index') }}" class="menu-link text-capitalize">
                <i class='menu-icon bx bx-line-chart'></i>
                <div>Investments</div>
            </a>
        </li>

        <!-- Profit & Loss -->
        <li class="menu-item added-active {{ Request::is(['assets', 'liabilities']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-dollar'></i>
                <div>Profit & Loss</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('assets') ? 'active' : '' }}">
                    <a href="{{ route('assets.index') }}" class="menu-link text-capitalize">
                        <div>Assets</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('liabilities') ? 'active' : '' }}">
                    <a href="{{ route('liabilities.index') }}" class="menu-link text-capitalize">
                        <div>Liabilities</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Fund -->
        <li class="menu-item added-active {{ Request::is(['member-savings', 'expenses', 'late-remissions', 'missed-meetings']) ? 'active' : '' }}" onclick="addActiveClass(this)">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-capitalize">
                <i class='menu-icon bx bx-money'></i>
                <div>Fund</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('member-savings') ? 'active' : '' }}">
                    <a href="{{ route('member-savings.index') }}" class="menu-link text-capitalize">
                        <div>Savings</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('expenses') ? 'active' : '' }}">
                    <a href="{{ route('expenses.index') }}" class="menu-link text-capitalize">
                        <div>Expenses</div>
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
        
        <!-- Membership -->
        <li class="menu-item added-active {{ Request::is(['all-members', 'executive-members', 'member-registration', 'membership-fees']) ? 'active' : '' }}" onclick="addActiveClass(this)">
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
                <li class="menu-item {{ Request::is('member-registration') ? 'active' : '' }}">
                    <a href="{{ route('member-registration.index') }}" class="menu-link text-capitalize">
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
                <div>Archive</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('constitution') ? 'active' : '' }}">
                    <a href="{{ route('constitution') }}" class="menu-link text-capitalize">
                        <div>Constitution</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('sop') ? 'active' : '' }}">
                    <a href="{{ route('sop') }}" class="menu-link text-capitalize">
                        <div>SOP</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('meeting-minutes') ? 'active' : '' }}">
                    <a href="{{ route('meeting-minutes') }}" class="menu-link text-capitalize">
                        <div>Meeting minutes</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('saved-emails') ? 'active' : '' }}">
                    <a href="{{ route('saved-emails') }}" class="menu-link text-capitalize">
                        <div>Saved Emails</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('elections') ? 'active' : '' }}">
                    <a href="{{ route('elections') }}" class="menu-link text-capitalize">
                        <div>Elections</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ Request::is('audit-reports') ? 'active' : '' }}">
                    <a href="{{ route('audit-reports.index') }}" class="menu-link text-capitalize">
                        <div>Meeting recording</div>
                    </a>
                </li> --}}
            </ul>
        </li>

        <!-- Settings -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text text-capitalize">settings</span>
        </li>
        
        <!-- General -->
        <li class="menu-item added-active {{ Request::is(['charge-settings', 'asset-settings', 'liability-settings', 'economic-calendar-year']) ? 'active' : '' }}" onclick="addActiveClass(this)">
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
                <li class="menu-item {{ Request::is('asset-settings') ? 'active' : '' }}">
                    <a href="{{ route('asset-settings.index') }}" class="menu-link text-capitalize">
                        <div>Assets</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('liability-settings') ? 'active' : '' }}">
                    <a href="{{ route('liability-settings.index') }}" class="menu-link text-capitalize">
                        <div>Liabilities</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('economic-calendar-year') ? 'active' : '' }}">
                    <a href="{{ route('economic-calendar-year.index') }}" class="menu-link text-capitalize">
                        <div>Economic calendar</div>
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
                <li class="menu-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="menu-link text-capitalize">
                        <div>Profile</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('add-user') ? 'active' : '' }}">
                    <a href="{{ route('org.user.index') }}" class="menu-link text-capitalize">
                        <div>Add user</div>
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