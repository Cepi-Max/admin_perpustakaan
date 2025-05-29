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