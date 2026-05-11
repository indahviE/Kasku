@extends('layouts.app')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kas Keluar</h1>
            <p class="text-gray-400 mt-1">Daftar semua pengeluaran kas.</p>
        </div>
        <div class="flex items-center gap-4">
            <button class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-gray-500">
                <iconify-icon icon="solar:bell-bold" class="text-[20px]"></iconify-icon>
            </button>
            <div class="flex items-center gap-3 bg-white shadow px-4 py-2 rounded-full">
                <div class="w-8 h-8 rounded-full bg-[#0F5D73] flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <span class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>

    <!-- TOTAL CARD -->
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <iconify-icon icon="solar:arrow-up-bold" class="text-[20px] text-red-500"></iconify-icon>
                </div>
                <span class="text-gray-500 font-semibold">Total Kas Keluar</span>
            </div>
            <p class="text-2xl font-bold text-red-500">
                Rp {{ number_format($totalKeluar, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-bold text-gray-700">Daftar Pengeluaran</h2>
            <a href="{{ route('kas_keluar.create') }}"
               class="bg-[#0F5D73] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#0a4a5c] transition">
                + Tambah
            </a>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-400 border-b border-gray-100">
                    <th class="pb-3">No</th>
                    <th class="pb-3">Tanggal</th>
                    <th class="pb-3">Keterangan</th>
                    <th class="pb-3">Nominal</th>
                    <th class="pb-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $index => $item)
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="py-3 text-gray-500">{{ $index + 1 }}</td>
                    <td class="py-3 text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="py-3 text-gray-700">{{ $item->keterangan }}</td>
                    <td class="py-3 font-semibold text-red-500">
                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                    </td>
                    <td class="py-3">
                        <form method="POST" action="{{ route('kas_keluar.delete') }}" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                <iconify-icon icon="solar:trash-bin-bold" class="text-[18px]"></iconify-icon>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-400">Belum ada data pengeluaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection