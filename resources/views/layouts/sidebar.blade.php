<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('root') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/GP-Logo-01.png') }}" class="img-fluid" alt="">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/GP-Logo-01.png') }}" class="img-fluid" alt="">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('root') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/GP-Logo-01.png') }}" class="img-fluid" alt="">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/GP-Logo-01.png') }}" class="img-fluid" alt="">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-settings-2-fill"></i>
                        <span data-key="t-multi-level">Setup</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item d-none">
                                <a href="{{ route('statuses.index') }}"
                                    class="nav-link {{ Request::is('statuses') || Request::is('statuses/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Status
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('platforms.index') }}"
                                    class="nav-link {{ Request::is('platforms') || Request::is('platforms/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Platforms
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('games.index') }}" class="nav-link" data-key="t-dashboards">
                                    Games</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('gamer-tags.index') }}"
                                    class="nav-link {{ Request::is('gamer-tags') || Request::is('gamer-tags/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Gamer Tags
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('coins.index') }}"
                                    class="nav-link {{ Request::is('coins') || Request::is('coins/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Credits
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('subscriptions.index') }}"
                                    class="nav-link {{ Request::is('subscriptions') || Request::is('subscriptions/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Subscription Price
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTournament" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTournament">
                        <i class="ri-trophy-fill"></i>
                        <span data-key="t-multi-level">Tournaments</span>
                    </a>

                    <div class="collapse menu-dropdown" id="sidebarTournament">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('tournaments.index') }}"
                                    class="nav-link {{ Request::is('tournaments') || Request::is('tournaments/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Manage Tournaments
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('prizes.index') }}"
                                    class="nav-link {{ Request::is('prizes') || Request::is('prizes/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Manage Prizes
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTeams" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTeams">
                        <i class="ri-team-fill"></i>
                        <span data-key="t-multi-level">Teams</span>
                    </a>

                    <div class="collapse menu-dropdown" id="sidebarTeams">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('teams.index') }}"
                                    class="nav-link {{ Request::is('teams') || Request::is('teams/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Manage Teams
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('teams-members.index') }}"
                                    class="nav-link {{ Request::is('members') || Request::is('members/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Manage members
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWager" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarWager">
                        <i class="ri-team-fill"></i>
                        <span data-key="t-multi-level">Wager</span>
                    </a>

                    <div class="collapse menu-dropdown" id="sidebarWager">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('wager-post.index') }}"
                                    class="nav-link {{ Request::is('wager-post') || Request::is('wager-post/*') ? 'active' : '' }}"
                                    data-key="t-dashboards">
                                    Manage Wager Post
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('tournament-enrollments.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Team
                            Enrollment</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('match-scheduler.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Match Scheduler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('transactions') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('subscription-transactions') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Subscription
                            Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Request::is('staffs') ||
                        Request::is('staffs/*') ||
                        Request::is('roles-permission-assignment-list') ||
                        Request::is('permissions') ||
                        Request::is('permissions/*') ||
                        Request::is('roles') ||
                        Request::is('roles/*')) active @endif"
                        href="#sidebarRolePermission" data-bs-toggle="collapse" role="button"
                        aria-expanded="@if (Request::is('staffs') ||
                            Request::is('staffs/*') ||
                            Request::is('roles-permission-assignment-list') ||
                            Request::is('permissions') ||
                            Request::is('permissions/*') ||
                            Request::is('roles') ||
                            Request::is('roles/*')) true @else false @endif"
                        aria-controls="sidebarRolePermission">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Roles & Permissions</span>
                    </a>
                    <div class="collapse menu-dropdown @if (Request::is('staffs') ||
                        Request::is('staffs/*') ||
                        Request::is('roles-permission-assignment-list') ||
                        Request::is('permissions') ||
                        Request::is('permissions/*') ||
                        Request::is('roles') ||
                        Request::is('roles/*')) show @endif"
                        id="sidebarRolePermission">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('staffs.index') }}"
                                    class="nav-link {{ Request::is('staffs') || Request::is('staffs/*') ? 'active' : '' }}"
                                    data-key="t-analytics">
                                    Staffs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles-permission-assignment-list') }}"
                                    class="nav-link {{ Request::is('roles-permission-assignment-list') || Request::is('roles-permission-assignment-list/*') ? 'active' : '' }}"
                                    data-key="t-analytics"> Roles Assignment </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}"
                                    class="nav-link {{ Request::is('roles') || Request::is('roles/*') ? 'active' : '' }}"
                                    data-key="t-analytics"> Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}"
                                    class="nav-link {{ Request::is('permissions') || Request::is('permissions/*') ? 'active' : '' }}"
                                    data-key="t-analytics">
                                    Permissions </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
