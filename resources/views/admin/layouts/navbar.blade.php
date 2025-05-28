@php
      use Illuminate\Support\Facades\Auth;
      $user = Auth::user();
    @endphp
    <div class="bg-gradient-to-br from-gray-300 to-gray-500 shadow rounded-xl p-6 flex justify-between items-center mb-8">
      <h1 class="text-2xl font-bold text-dark">Selamat Datang, {{ $user ? $user->name : 'Admin' }}!</h1>
      <div class="flex items-center space-x-4">
        <img src="https://img.icons8.com/ios-glyphs/36/6baf54/user-male-circle.png" alt="Profile" class="h-10 w-10">
        <span class="text-gray-700">{{ $user ? $user->email : '-' }}</span>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full font-medium shadow hover:bg-gray-200 transition">
            Logout
          </button>
        </form>
      </div>
    </div>