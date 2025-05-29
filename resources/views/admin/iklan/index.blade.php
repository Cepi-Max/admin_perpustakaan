@extends('admin.layouts.app')

@section('breadcrumb', 'Iklan')

@section('content')
<div x-data="galleryViewer()" class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Iklan Perpustakaan</h1>
                <p class="text-gray-600 mt-1">Kelola iklan perpustakaan</p>
            </div>
            <a href="{{ route('admin.iklan.form') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                <i class="bi bi-plus-lg mr-2"></i>
                Tambah Iklan
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200">
                <div class="flex items-center">
                    <i class="bi bi-images text-blue-600 text-2xl mr-3"></i>
                    <div>
                        <p class="text-blue-600 text-sm font-medium">Total Iklan</p>
                        <p class="text-2xl font-bold text-blue-800">{{ $iklans->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-lg border border-green-200">
                <div class="flex items-center">
                    <i class="bi bi-check-circle text-green-600 text-2xl mr-3"></i>
                    <div>
                        <p class="text-green-600 text-sm font-medium">Dipilih</p>
                        <p class="text-2xl font-bold text-green-800" x-text="selectedCount">0</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200">
                <div class="flex items-center">
                    <i class="bi bi-calendar text-purple-600 text-2xl mr-3"></i>
                    <div>
                        <p class="text-purple-600 text-sm font-medium">Terakhir Upload</p>
                        <p class="text-sm font-semibold text-purple-800">
                            @if($iklans->count() > 0)
                                {{ \Carbon\Carbon::parse($iklans->first()->created_at)->diffForHumans() }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    @if($iklans->count() > 0)
    <div class="bg-white rounded-xl shadow-lg p-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <button @click="selectAll" 
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <i class="bi bi-check-all mr-1"></i>
                    Pilih Semua
                </button>
                <button @click="deselectAll" 
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <i class="bi bi-x-lg mr-1"></i>
                    Batal Pilih
                </button>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600" x-text="selectedCount + ' item dipilih'"></span>
                <button @click="deleteSelected" 
                        x-show="selectedCount > 0"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium text-sm rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                    <i class="bi bi-trash mr-2"></i>
                    Hapus (<span x-text="selectedCount"></span>)
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Iklan Grid -->
    <form id="deleteForm" method="POST" action="{{ route('admin.iklan.delete') }}">
        @csrf
        
        @if($iklans->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
            @foreach ($iklans as $index => $iklan)
                <div class="group relative bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 hover:scale-105">
                    
                    <!-- Image Container -->
                    <div class="relative w-full h-[296px] overflow-hidden">
                        <!-- Gambar (klik untuk popup) -->
                        <img src="{{ asset('storage/' . $iklan->gambar) }}" 
                            alt="{{ $iklan->deskripsi }}" 
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110 cursor-pointer"
                            @click="openPopup({{ $index }})"
                            loading="lazy"
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'">

                        <!-- Overlay Deskripsi -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end p-4 pointer-events-none">
                            <p class="text-white text-sm line-clamp-2" title="{{ $iklan->deskripsi }}">
                                {{ $iklan->deskripsi }}
                            </p>
                        </div>

                        <!-- Checkbox (tidak trigger popup) -->
                        <div class="absolute top-2 right-2 z-20">
                            <label>
                                <input type="checkbox" 
                                    name="ids[]" 
                                    value="{{ $iklan->id }}"
                                    class="w-5 h-5 text-blue-600 bg-white border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 shadow-lg cursor-pointer gallery-checkbox"
                                    @change="updateSelectedCount"
                                    @click.stop>
                            </label>
                        </div>

                        <!-- Quick Actions -->
                        <div class="absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                            <div class="flex gap-1">
                                <a href="{{ route('admin.iklan.edit', $iklan->id) }}" 
                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors"
                                    title="Edit">
                                    <i class="bi bi-pencil text-xs"></i>
                                </a>
                                <button type="button" 
                                        @click.stop="deleteOne({{ $iklan->id }})"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors"
                                        title="Hapus">
                                    <i class="bi bi-trash text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Judul & Tanggal -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 text-sm truncate mb-1" title="{{ $iklan->judul }}">
                            {{ $iklan->judul }}
                        </h3>
                        <div class="flex items-center text-xs text-gray-400">
                            <i class="bi bi-calendar3 mr-1"></i>
                            <time datetime="{{ $iklan->tanggal_upload }}">
                                {{ \Carbon\Carbon::parse($iklan->tanggal_upload)->translatedFormat('d M Y') }}
                            </time>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="bi bi-images text-gray-400 text-4xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada iklan</h3>
            <p class="text-gray-600 mb-6">Mulai dengan menambahkan iklan pertama perpustakaan</p>
            <a href="{{ route('admin.iklan.form') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                <i class="bi bi-plus-lg mr-2"></i>
                Tambah Iklan Pertama
            </a>
        </div>
        @endif
    </form>

    <!-- Image Viewer Modal -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-hidden"
         @keydown.escape.window="closeModal"
         @keydown.arrow-left.window="prevImage"
         @keydown.arrow-right.window="nextImage">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-90 " @click="closeModal"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full h-full flex items-center justify-center p-4">
            <!-- Close Button -->
            <button @click="closeModal"
                    class="absolute top-4 right-4 z-10 w-10 h-10 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full flex items-center justify-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                <i class="bi bi-x-lg"></i>
            </button>
            
            <!-- Navigation Buttons -->
            <template x-if="imageList.length > 1">
                <div>
                    <button @click="prevImage"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full flex items-center justify-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                        <i class="bi bi-chevron-left text-xl"></i>
                    </button>
                    
                    <button @click="nextImage"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white bg-opacity-20 hover:bg-opacity-30 text-white rounded-full flex items-center justify-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                        <i class="bi bi-chevron-right text-xl"></i>
                    </button>
                </div>
            </template>
            
            <!-- Image -->
            <div class="max-w-7xl max-h-full flex flex-col items-center">
                <img :src="activeImage" 
                     :alt="activeTitle"
                     class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                
                <!-- Image Info -->
                <div class="text-center text-white max-w-2xl">
                    <h2 x-text="activeTitle" class="text-2xl font-bold mb-2"></h2>
                    <p x-text="activeDescription" class="text-gray-300 mb-3"></p>
                    <div class="flex items-center justify-center gap-4 text-sm text-gray-400">
                        <span x-text="activeDate"></span>
                        <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                        <span x-text="`${currentIndex + 1} dari ${imageList.length}`"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         x-transition
         class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50" @click="showDeleteModal = false"></div>
            
            <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <i class="bi bi-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Konfirmasi Hapus
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" x-text="deleteMessage"></p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button @click="confirmDelete"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </button>
                    <button @click="showDeleteModal = false"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function galleryViewer() {
        return {
            isOpen: false,
            activeImage: '',
            activeTitle: '',
            activeDescription: '',
            activeDate: '',
            currentIndex: 0,
            selectedCount: 0,
            showDeleteModal: false,
            deleteMessage: '',
            deleteAction: null,
            imageList: @json($iklans->pluck('gambar')->map(fn($g) => asset('storage/' . $g))),
            titleList: @json($iklans->pluck('judul')),
            descriptionList: @json($iklans->pluck('deskripsi')),
            dateList: @json($iklans->map(fn($g) => \Carbon\Carbon::parse($g->tanggal_upload)->translatedFormat('d F Y'))),
            
            openPopup(index) {
              console.log('Popup triggered for index:', index);
                if (this.imageList.length === 0) return;
                
                this.currentIndex = index;
                this.updateActiveImage();
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            
            closeModal() {
                this.isOpen = false;
                document.body.style.overflow = '';
            },
            
            nextImage() {
                if (this.imageList.length <= 1) return;
                this.currentIndex = (this.currentIndex + 1) % this.imageList.length;
                this.updateActiveImage();
            },
            
            prevImage() {
                if (this.imageList.length <= 1) return;
                this.currentIndex = (this.currentIndex - 1 + this.imageList.length) % this.imageList.length;
                this.updateActiveImage();
            },
            
            updateActiveImage() {
                this.activeImage = this.imageList[this.currentIndex] || '';
                this.activeTitle = this.titleList[this.currentIndex] || '';
                this.activeDescription = this.descriptionList[this.currentIndex] || '';
                this.activeDate = this.dateList[this.currentIndex] || '';
            },
            
            updateSelectedCount() {
                this.$nextTick(() => {
                    this.selectedCount = document.querySelectorAll('input[name="ids[]"]:checked').length;
                });
            },
            
            selectAll() {
                document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
                    checkbox.checked = true;
                });
                this.updateSelectedCount();
            },
            
            deselectAll() {
                document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                this.updateSelectedCount();
            },
            
            deleteSelected() {
                const checkedBoxes = document.querySelectorAll('input[name="ids[]"]:checked');
                if (checkedBoxes.length === 0) return;
                
                this.deleteMessage = `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} gambar yang dipilih? Tindakan ini tidak dapat dibatalkan.`;
                this.deleteAction = () => {
                    document.getElementById('deleteForm').submit();
                };
                this.showDeleteModal = true;
            },
            
            deleteOne(id) {
                // Uncheck all checkboxes first
                document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                
                // Check only the target checkbox
                document.querySelector(`input[value="${id}"]`).checked = true;
                
                this.deleteMessage = 'Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.';
                this.deleteAction = () => {
                    document.getElementById('deleteForm').submit();
                };
                this.showDeleteModal = true;
            },
            
            confirmDelete() {
                if (this.deleteAction) {
                    this.deleteAction();
                }
                this.showDeleteModal = false;
            }
        }
    }
</script>
@endpush

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection