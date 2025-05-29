<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- Alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- include summernote css/js-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                        'dancing': ['Dancing Script', 'cursive'],
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-montserrat">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <nav id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-center h-16 px-4 bg-gray-900">
                <h5 class="text-xl font-bold text-white text-center">
                    <i class="bi bi-book mr-2"></i>
                    Perpustakaan Admin
                </h5>
            </div>
            
            <!-- Navigation Menu -->
            <div class="flex flex-col p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-speedometer2 mr-3"></i>
                    <span class="font-medium">Beranda</span>
                </a>
                
                <a href="{{ route('admin.berita.show') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-newspaper mr-3"></i>
                    <span class="font-medium">Berita</span>
                </a>
                
                <a href="{{ route('admin.galeri.show') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.galeri.*') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-images mr-3"></i>
                    <span class="font-medium">Galeri</span>
                </a>

                <a href="{{ route('admin.iklan.show') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.iklan.*') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-table mr-3"></i> 
                    <span class="font-medium">Iklan</span>
                </a>
                
                <a href="{{ route('admin.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.index') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-question-circle mr-3"></i>
                    <span class="font-medium">Soal Kuis</span>
                </a>
                
                <a href="{{ route('admin.visitors') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-yellow-400 transition-colors duration-200 {{ request()->routeIs('admin.visitors') ? 'bg-gray-700 text-yellow-400' : '' }}">
                    <i class="bi bi-people-fill mr-3"></i>
                    <span class="font-medium">Pengunjung Hari Ini</span>
                </a>
            </div>
            
            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 w-full p-4">
                <div class="flex items-center p-3 bg-gray-700 rounded-lg">
                    <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                        <i class="bi bi-person-fill text-gray-800"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Admin</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Top Header -->
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
                        <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors duration-200">
                            <i class="bi bi-bell text-lg"></i>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">3</span>
                        </button>

                        <!-- Settings -->
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors duration-200">
                            <i class="bi bi-gear text-lg"></i>
                        </button>

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

            <!-- Content Area -->
            <main class="flex-1 p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Success Toast Notification -->
    @if(session('success'))
    <div x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 100); setTimeout(() => show = false, 5000);"
         x-show="show"
         x-transition:enter="transform transition ease-out duration-300"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transform transition ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fixed top-4 right-4 z-50 max-w-sm">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
            <i class="bi bi-check-circle-fill mr-3 text-xl"></i>
            <div>
                <p class="font-medium">Berhasil!</p>
                <p class="text-sm opacity-90">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Error Toast Notification -->
    @if(session('error'))
    <div x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 100); setTimeout(() => show = false, 5000);"
         x-show="show"
         x-transition:enter="transform transition ease-out duration-300"
         x-transition:enter-start="translate-x-full opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transform transition ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-full opacity-0"
         class="fixed top-4 right-4 z-50 max-w-sm">
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
            <i class="bi bi-exclamation-triangle-fill mr-3 text-xl"></i>
            <div>
                <p class="font-medium">Error!</p>
                <p class="text-sm opacity-90">{{ session('error') }}</p>
            </div>
            <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100); setTimeout(() => show = false, 5000);"
            x-show="show"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="fixed top-4 right-4 z-50 max-w-sm">
            <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center">
                <i class="bi bi-exclamation-triangle-fill mr-3 text-xl"></i>
                <div>
                    <p class="font-medium">Error!</p>
                    <ul class="text-sm opacity-90 list-disc pl-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
    @endif


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Summernote dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });


            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            mobileMenuButton.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                }
            });

            // Close sidebar when clicking on links (mobile)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) { // lg breakpoint
                        closeSidebar();
                    }
                });
            });
        });

        // Summernote
        $(document).ready(function() {
        // Summernote Initialization
        $('.summernote').summernote({
          placeholder: 'Tulis berita disini...',
          height: 100,
          toolbar: [
              ['font', ['bold', 'underline', 'clear']],
              ['para', ['ul', 'ol', 'paragraph']]
            ]
        });
      });
    </script>
    
    @stack('scripts')

</body>
</html>