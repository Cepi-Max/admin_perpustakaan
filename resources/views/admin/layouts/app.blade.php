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
        @include('admin.layouts.sidebar')

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Top Header -->
            @include('admin.layouts.navbar')

            <!-- Content Area -->
            <main class="flex-1 p-6 bg-gray-200">
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