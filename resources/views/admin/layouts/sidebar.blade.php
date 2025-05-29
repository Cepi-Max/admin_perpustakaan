<aside class="fixed inset-y-0 left-0 w-56 bg-gradient-to-br from-gray-400 to-gray-500 shadow-lg flex flex-col">
    <div class="p-6 bg-gray-300 text-dark text-center rounded-b-2xl">
      <span class="material-symbols-outlined text-dark text-4xl mx-auto">
        menu_book
      </span>
      <h4 class="mt-2 text-3xl tracking-wider text-dark font-bold" style="font-family: 'Dancing Script', cursive;">
        Perpustakaan
      </h4>
    </div>
    <nav class="mt-8 flex-1 px-4">
      <ul class="space-y-4">
        <li>
          <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded-lg text-dark hover:bg-gray-400 {{ request()->routeIs('dashboard') ? 'bg-gray-400' : '' }}">
            <span class="mr-3 text-xl"></span>
            <span class="font-medium">Beranda</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.galeri.show') }}" class="flex items-center p-2 rounded-lg text-dark hover:bg-gray-400 {{ request()->routeIs('admin.galeri.' . '*') ? 'bg-gray-400' : '' }}">
            <span class="mr-3 text-xl"></span>
            <span class="font-medium">Galeri</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.berita.show') }}" class="flex items-center p-2 rounded-lg text-dark hover:bg-gray-400 {{ request()->routeIs('admin.berita.' . '*') ? 'bg-gray-400' : '' }}">
            <span class="mr-3 text-xl"></span>
            <span class="font-medium">Berita</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center p-2 rounded-lg text-dark hover:bg-gray-400 {{ request()->routeIs('admin.tentang.' . '*') ? 'bg-gray-400' : '' }}">
            <span class="mr-3 text-xl"></span>
            <span class="font-medium">Tentang Perpustakaan</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center p-2 rounded-lg text-dark hover:bg-gray-400 {{ request()->routeIs('admin.kritik.' . '*') ? 'bg-gray-400' : '' }}">
            <span class="mr-3 text-xl"></span>
            <span class="font-medium">Kritik dan saran</span>
          </a>
        </li>
      </ul>
    </nav>
    <div class="p-4 text-center text-sm text-gray-700">
      &copy; 2025 Data Padi
    </div>
  </aside>