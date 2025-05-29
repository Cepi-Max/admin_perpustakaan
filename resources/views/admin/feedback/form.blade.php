@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow space-y-4">
    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" name="nama" placeholder="Nama"
                    class="w-full border border-gray-300 rounded-md p-2" required>
            </div>
            <div>
                <input type="text" name="no_hp" placeholder="No.Handphone/WhatsApp"
                    class="w-full border border-gray-300 rounded-md p-2">
            </div>
        </div>

        <div>
            <input type="email" name="email" placeholder="Email*"
                class="w-full border border-gray-300 rounded-md p-2" required>
        </div>

        <div>
            <textarea name="kritik" rows="4" placeholder="Masukkan kritikan Anda"
                class="w-full border border-gray-300 rounded-md p-2"></textarea>
        </div>

        <div>
            <textarea name="saran" rows="4" placeholder="Saran Anda kepada kami"
                class="w-full border border-gray-300 rounded-md p-2"></textarea>
        </div>

        <div>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                Kirim
            </button>
        </div>
    </form>
</div>
@endsection
