<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Data Padi</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Montserrat', sans-serif; }
  </style>
</head>
<body class="text-gray-800">
  <!-- Sidebar -->
  @include('admin.layouts.sidebar')

  <!-- Main Content -->
  <div class="bg-gray-100 ml-56 p-8">
    <!-- Topbar -->
    @include('admin.layouts.navbar')

    @yield('content')
    
  </div>

 @if(session('success'))
  <div
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 100); setTimeout(() => show = false, 3100);"
    x-show="show"
    x-transition:enter="transform transition ease-out duration-500"
    x-transition:enter-start="-translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transform transition ease-in duration-500"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-full opacity-0"
    class="fixed bottom-5 left-5 z-50 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg text-sm"
  >
    {{ session('success') }}
  </div>
@endif

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @stack('scripts')
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
