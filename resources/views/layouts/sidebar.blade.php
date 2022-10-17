<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu text-capitalize">
            <ul class="menu">
                <li class='sidebar-title'>{{ __('Main Menu') }}</li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link text-decoration-none'>
                        <i class="fas fa-solar-panel"></i>
                        <span>{{ __('Dashboards') }}</span>
                    </a>
                    <ul class="submenu ">
                        @auth
                            <li>
                                <a class='text-decoration-none' href="{{ route('dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endauth
                        @can('Dashboard Per VP')
                            <li>
                                <a class='text-decoration-none' href="{{ route('test.dashboard') }}">
                                    {{ __('Dashboard') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('Basic Setting Tab')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-cogs"></i>
                            <span>{{ __('Basic Setting') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Countries List')
                                <li>
                                    <a class='text-decoration-none' href="{{ route('countries.index') }}">
                                        {{ __('Countries') }}
                                    </a>
                                </li>
                            @endcan
                            @can('Locations List')
                                <li>
                                    <a class='text-decoration-none' href="{{ route('locations.index') }}">
                                        {{ __('Locations') }}
                                    </a>
                                </li>
                            @endcan
                            @can('VPS List')
                                <li>
                                    <a class='text-decoration-none' href="{{ route('vps.index') }}">
                                        {{ __('VPs') }}
                                    </a>
                                </li>
                            @endcan
                            @can('Areas List')
                                <li>
                                    <a class='text-decoration-none' href="{{ route('areas.index') }}">
                                        {{ __('Areas') }}
                                    </a>
                                </li>
                            @endcan
                            @can('Violation Classifications List')
                                <li>
                                    <a href="{{ route('classifications.index') }}"
                                        class="text-decoration-none">{{ __('Violation Classifications') }}</a>
                                </li>
                            @endcan
                            @can('Workers Types List')
                                <li>
                                    <a href="{{ route('types.index') }}"
                                        class="text-decoration-none">{{ __('Worker Types') }}</a>
                                </li>
                            @endcan
                            @can('Workers Titles List')
                                <li>
                                    <a href="{{ route('titles.index') }}"
                                        class="text-decoration-none">{{ __('Titles') }}</a>
                                </li>
                            @endcan
                            @can('Fixed Companies List')
                                <li>
                                    <a href="{{ route('companies.index') }}"
                                        class="text-decoration-none">{{ __('Fixed Companies') }}</a>
                                </li>
                            @endcan
                            @can('Service Companies List')
                                <li>
                                    <a href="{{ route('service.companies.index') }}"
                                        class="text-decoration-none">{{ __('Service Companies') }}</a>
                                </li>
                            @endcan
                            @can('Workers List')
                                <li>
                                    <a href="{{ route('workers.index') }}"
                                        class="text-decoration-none">{{ __('Workers') }}</a>
                                </li>
                            @endcan
                            @can('Unfixed Workers List')
                                <li>
                                    <a href="{{ route('unfixed.emps.index') }}"
                                        class="text-decoration-none">{{ __('Unfixed Workers') }}</a>
                                </li>
                            @endcan
                            @can('Roles List')
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="text-decoration-none">{{ __('Roles') }}</a>
                                </li>
                            @endcan
                            @can('Groups List')
                                <li>
                                    <a href="{{ route('groups.index') }}"
                                        class="text-decoration-none">{{ __('Groups') }}</a>
                                </li>
                            @endcan
                            @can('Users List')
                                <li>
                                    <a href="{{ route('users.index') }}"
                                        class="text-decoration-none">{{ __('Users') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Violations Tab')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Violations') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Uae Violations List')
                                <li>
                                    <a href="{{ route('uae.violations.index') }}"
                                        class="text-decoration-none">{{ __('UAE Violation') }}</a>
                                </li>
                            @endcan
                            @can('Egy Violations List')
                                <li>
                                    <a href="{{ route('violations.index') }}"
                                        class="text-decoration-none">{{ __('Egypt Violation') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Permits Tab')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Permits') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Vehicles Permits - Section')
                                <li class='sidebar-title'>{{ __('Vehicle Permits') }}</li>
                                @can('Request Vehicles Permits')
                                    <li>
                                        <a href="{{ route('permits.vehicle.create') }}"
                                            class="text-decoration-none">{{ __('Service Vehicle Permit') }}</a>
                                    </li>
                                @endcan
                                @can('Request Private Permits')
                                    <li>
                                        <a href="{{ route('permits.private.create') }}"
                                            class="text-decoration-none">{{ __('Private Vehicle Permit') }}</a>
                                    </li>
                                @endcan
                            @endcan

                            @can('CLM - Section')
                                <li class='sidebar-title'>{{ __('CLM') }}</li>
                                @can('Request Unfixed Permits')
                                    <li>
                                        <a href="{{ route('unfixed.permit.create') }}"
                                            class="text-decoration-none">{{ __('Request Unfixed Permit') }}</a>
                                    </li>
                                @endcan
                            @endcan

                            @can('Safety - Section')
                                <li class='sidebar-title'>{{ __('Safety') }}</li>
                                @can('Security - Pending Permits')
                                    <li>
                                        <a href="{{ route('safety.permits.index') }}"
                                            class="text-decoration-none">{{ __('Pending Permits') }}</a>
                                    </li>
                                @endcan
                            @endcan
                            @can('Security - Section')
                                <li class='sidebar-title'>{{ __('Security') }}</li>
                                @can('Security - Pending Permits')
                                    <li>
                                        <a href="{{ route('security.permits.index') }}"
                                            class="text-decoration-none">{{ __('Pending Permits') }}</a>
                                    </li>
                                @endcan
                            @endcan
                            @can('Permits Management - Section')
                                <li class='sidebar-title'>{{ __('Permits Management') }}</li>
                                @can('Group - Pending Permits')
                                    <li>
                                        <a href="{{ route('permits.group') }}"
                                            class="text-decoration-none">{{ __('My Group Permits') }}</a>
                                    </li>
                                @endcan

                                @can('Own Permits List')
                                    <li>
                                        <a href="{{ route('permits.mypermits') }}"
                                            class="text-decoration-none">{{ __('Own Permits State') }}</a>
                                    </li>
                                @endcan
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Records Tab')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link text-decoration-none'>
                            <i class="fas fa-users"></i>
                            <span>{{ __('Records') }}</span>
                        </a>
                        <ul class="submenu ">
                            @can('Records Create')
                                <li>
                                    <a href="{{ route('records.create') }}"
                                        class="text-decoration-none">{{ __('تسجيل جديد') }}</a>
                                </li>
                            @endcan
                            @can('Records List')
                                <li>
                                    <a href="{{ route('records.archive') }}"
                                        class="text-decoration-none">{{ __('الارشيف') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
