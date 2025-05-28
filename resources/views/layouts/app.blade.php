<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Perpustakaan') }}</title>

  <!-- Google Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Tailwind -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-green-50 text-green-800">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-auto">
      <!-- Topbar -->
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <div class="flex items-center">
          <span class="material-symbols-outlined text-green-600 text-3xl mr-2">library_books</span>
          <h1 class="text-xl font-semibold">{{ $header ?? __('Dashboard') }}</h1>
        </div>
        <div class="flex items-center space-x-4">
          @auth
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="bg-green-100 text-green-700 px-3 py-1 rounded-full hover:bg-green-200">Logout</button>
            </form>
          @endauth
        </div>
      </header>

      <!-- Page Content -->
      <main class="p-6 bg-green-50 flex-1">
        {{ $slot }}
      </main>
    </div>
  </div>
</body>
</html>
