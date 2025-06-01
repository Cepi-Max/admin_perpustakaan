<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>

<body class="flex flex-col min-h-screen bg-gray-50">

    <!-- Header -->
    @include('pengunjung.layouts.header')

    <!-- Konten Utama -->
    <main class="flex-grow container mx-auto p-6 ">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('pengunjung.layouts.footer')

</body>

</html>
