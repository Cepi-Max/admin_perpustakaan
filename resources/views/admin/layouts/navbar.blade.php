<header class="bg-white shadow-md border-b border-gray-200">
                <div class="flex items-center justify-between px-4 py-4">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" 
                            type="button" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 lg:hidden">
                        <i class="bi bi-list text-xl"></i>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl">Dashboard Admin</h1>
                    </div>

                    <!-- Right side buttons -->
                    <div class="flex items-center space-x-3">
                        <!-- Notifications -->
                        {{-- <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors duration-200">
                            <i class="bi bi-bell text-lg"></i>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">3</span>
                        </button> --}}

                        <!-- Settings -->
                        {{-- <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors duration-200">
                            <i class="bi bi-gear text-lg"></i>
                        </button> --}}

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                    title="Logout">
                                <i class="bi bi-box-arrow-right mr-2"></i>
                                <span class="hidden sm:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            <!-- Breadcrumb -->
            <nav class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors duration-200">
                            <i class="bi bi-house-door"></i>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="bi bi-chevron-right mx-2 text-gray-400"></i>
                        <span class="text-gray-900 font-medium">@yield('breadcrumb', 'Dashboard')</span>
                    </li>
                </ol>
            </nav>