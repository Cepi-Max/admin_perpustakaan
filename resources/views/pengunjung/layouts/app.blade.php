<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'PERPUSTAKAAN POLMAN BABEL' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen">

  <!-- Header -->
  @include('pengunjung.layouts.header')

  <!-- Konten Utama -->
  <main class="flex-grow container mx-auto p-6">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('pengunjung.layouts.footer')

</body>
</html>
