<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                       <img class="mb-1 logo-login h-10" src="{{ asset('resources/image/logo2.png')}}" alt="" height="38px">
                    </a>

                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @if(auth()->user()->role == 'Admin')
                        <x-jet-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('admin.index.account') }}" :active="request()->routeIs('admin.index.account')">
                            {{ __('Manage Account') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('admin.index.menu') }}" :active="request()->routeIs('admin.index.menu')">
                            {{ __('Index Menu') }}
                        </x-jet-nav-link>
                       
                        <div class="hidden sm:flex sm:items-center sm:ml-6 hover:border-gray-300  focus:outline-none focus:text-gray-700 focus:border-gray-300  border-transparent 
                        transition duration-150 ease-in-out  hover:text-gray-700">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">

                                    <button class="inline-flex items-center px-1 pt-1 border-b-2text-sm font-medium leading-5 text-gray-500 focus:outline-none ">
                                        <div>Report</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>

                                </x-slot>

                                <x-slot name="content">

                                    <!-- User Management -->
                                    <div class="block px-4 py-2 text-base text-gray-700 font-semibold border-b">
                                        {{ __('Report') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('admin.index.review') }}">
                                        {{ __('Review ') }}
                                    </x-jet-dropdown-link>
                                      <x-jet-dropdown-link href="{{ route('admin.index.order_catering') }}">
                                        {{ __('Summary Employees ') }}
                                    </x-jet-dropdown-link>
                                      <x-jet-dropdown-link href="{{ route('admin.index.order') }}">
                                        {{ __('Meal`s Taken ') }}
                                    </x-jet-dropdown-link>
                                      <x-jet-dropdown-link href="{{ route('admin.index.order_not_taken') }}">
                                        {{ __('Meal`s Not Taken  ') }}
                                    </x-jet-dropdown-link>

                                </x-slot>

                            </x-jet-dropdown>
                        </div>
                      

                    @elseif(auth()->user()->role == 'Catering')
                        <x-jet-nav-link href="{{ route('catering.dashboard') }}" :active="request()->routeIs('catering.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('catering.index.menu') }}" :active="request()->routeIs('catering.index.menu')">
                            {{ __('Manage Menu') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('catering.index.schedule') }}" :active="request()->routeIs('catering.index.schedule')">
                            {{ __('Manage Schedule') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('catering.index.catering') }}" :active="request()->routeIs('catering.index.catering')">
                            {{ __('Menu Today') }}
                        </x-jet-nav-link>
                        <div class="hidden sm:flex sm:items-center sm:ml-6 hover:border-gray-300  focus:outline-none focus:text-gray-700 focus:border-gray-300  border-transparent 
                        transition duration-150 ease-in-out  hover:text-gray-700">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">

                                <button class="inline-flex items-center px-1 pt-1 border-b-2text-sm font-medium leading-5 text-gray-500 focus:outline-none ">
                                    <div>Report</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>

                            </x-slot>

                            <x-slot name="content">

                                <!-- User Management -->
                                <div class="block px-4 py-2 text-base text-gray-700 font-semibold border-b">
                                    {{ __('Report') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('catering.index.report') }}">
                                    {{ __('Catering Menu ') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('catering.index.review') }}">
                                    {{ __('Review & Rate') }}
                                </x-jet-dropdown-link>


                            </x-slot>

                        </x-jet-dropdown>
                    </div>                    
                      
                    @else
                        <x-jet-nav-link href="{{ route('employee.dashboard') }}" :active="request()->routeIs('employee.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('employee.create.order') }}" :active="request()->routeIs('employee.create.order')">
                            {{ __('Create Order') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('employee.history.order') }}" :active="request()->routeIs('employee.history.order')">
                            {{ __('Catering Order History') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('employee.history.review') }}" :active="request()->routeIs('employee.history.review')">
                            {{ __('Review History') }}
                        </x-jet-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

                    @if(auth()->user()->role == 'Admin')
                        <x-jet-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('admin.index.account') }}" :active="request()->routeIs('admin.index.account')">
                            {{ __('Manage Account') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('admin.index.menu') }}" :active="request()->routeIs('admin.index.menu')">
                            {{ __('Index Menu') }}
                        </x-jet-responsive-nav-link>                       
                       
                        <x-jet-responsive-nav-link  href="{{ route('admin.index.review') }}" :active="request()->routeIs('admin.index.review')">
                            {{ __('Report Review ') }}
                        </x-jet-responsive-nav-link >
                        <x-jet-responsive-nav-link  href="{{ route('admin.index.order_catering') }}" :active="request()->routeIs('admin.index.order_catering')">
                            {{ __('Summary Employees ') }}
                        </x-jet-responsive-nav-link >
                        <x-jet-responsive-nav-link  href="{{ route('admin.index.order') }}" :active="request()->routeIs('admin.index.order')">
                            {{ __('Report Catering Taken ') }}
                        </x-jet-responsive-nav-link >
                        <x-jet-responsive-nav-link  href="{{ route('admin.index.order_not_taken') }}" :active="request()->routeIs('admin.index.order_not_taken')">
                            {{ __('Report Catering Not Taken  ') }}
                        </x-jet-responsive-nav-link >

                                

                    @elseif(auth()->user()->role == 'Catering')
                        <x-jet-responsive-nav-link href="{{ route('catering.dashboard') }}" :active="request()->routeIs('catering.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('catering.index.menu') }}" :active="request()->routeIs('catering.index.menu')">
                            {{ __('Manage Menu') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('catering.index.schedule') }}" :active="request()->routeIs('catering.index.schedule')">
                            {{ __('Manage Schedule') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('catering.index.catering') }}" :active="request()->routeIs('catering.index.catering')">
                            {{ __('Menu Today') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('catering.index.report') }}" :active="request()->routeIs('catering.index.report')">
                            {{ __('Report Catering Menu') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('catering.index.review') }}" :active="request()->routeIs('catering.index.review')">
                            {{ __('Report Review & Feed') }}
                        </x-jet-responsive-nav-link>
                    @else
                        <x-jet-responsive-nav-link href="{{ route('employee.dashboard') }}" :active="request()->routeIs('employee.dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('employee.create.order') }}" :active="request()->routeIs('employee.create.order')">
                            {{ __('Create Order') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('employee.history.order') }}" :active="request()->routeIs('employee.history.order')">
                            {{ __('Order History ') }}
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link href="{{ route('employee.history.review') }}" :active="request()->routeIs('employee.history.review')">
                            {{ __('History of Your Review and Feed') }}
                        </x-jet-responsive-nav-link>
                    @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3  hide-scroll">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                        {{ __('Create New Team') }}
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
