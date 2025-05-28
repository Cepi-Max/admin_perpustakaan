@extends('admin.layouts.app')

@section('content')

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <div class="bg-white border-l-4 border-[#7F8CAA] rounded-2xl shadow-lg p-6 text-center hover:scale-[1.03] transition-transform">
    <h6 class="text-gray-700 font-bold mb-2 text-sm tracking-wide uppercase">Total Pengunjung Hari Ini</h6>
    <div class="text-4xl font-extrabold text-gray-900">5000</div>
  </div>
  <div class="bg-white border-l-4 border-[#7F8CAA] rounded-2xl shadow-lg p-6 text-center hover:scale-[1.03] transition-transform">
    <h6 class="text-gray-700 font-bold mb-2 text-sm tracking-wide uppercase">Petani Terdaftar</h6>
    <div class="text-4xl font-extrabold text-gray-900">150</div>
  </div>
  <div class="bg-white border-l-4 border-[#7F8CAA] rounded-2xl shadow-lg p-6 text-center hover:scale-[1.03] transition-transform">
    <h6 class="text-gray-700 font-bold mb-2 text-sm tracking-wide uppercase">Transaksi Bulan Ini</h6>
    <div class="text-4xl font-extrabold text-gray-900">25</div>
  </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
  <div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">📊 Grafik Penjualan Bulan Ini</h2>
    <canvas id="penjualanChart" class="w-full h-80"></canvas>
  </div>
  <div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">🔥 Produk Terlaris</h2>
    <canvas id="produkTerlarisChart" class="w-full h-80"></canvas>
  </div>
</div>

<!-- Table Data Padi -->
<div class="bg-white rounded-2xl shadow overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100">
    <h3 class="text-gray-800 font-semibold text-lg">🌾 Tabel Data Padi Terbaru</h3>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left font-semibold text-gray-700">No</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-700">Nama Padi</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-700">Jenis</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-700">Jumlah (Kg)</th>
          <th class="px-6 py-3 text-left font-semibold text-gray-700">Tanggal Update</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">1</td>
          <td class="px-6 py-4 whitespace-nowrap">Padi IR64</td>
          <td class="px-6 py-4 whitespace-nowrap">Indica</td>
          <td class="px-6 py-4 whitespace-nowrap">1000</td>
          <td class="px-6 py-4 whitespace-nowrap">01 Mei 2025</td>
        </tr>
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">2</td>
          <td class="px-6 py-4 whitespace-nowrap">Padi Ciherang</td>
          <td class="px-6 py-4 whitespace-nowrap">Inpari</td>
          <td class="px-6 py-4 whitespace-nowrap">750</td>
          <td class="px-6 py-4 whitespace-nowrap">03 Mei 2025</td>
        </tr>
        <tr class="hover:bg-gray-50">
          <td class="px-6 py-4 whitespace-nowrap">3</td>
          <td class="px-6 py-4 whitespace-nowrap">Padi Mentik</td>
          <td class="px-6 py-4 whitespace-nowrap">Hibrida</td>
          <td class="px-6 py-4 whitespace-nowrap">500</td>
          <td class="px-6 py-4 whitespace-nowrap">05 Mei 2025</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@push('scripts')
@endpush

@endsection
