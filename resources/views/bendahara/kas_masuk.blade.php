@extends('layouts.app')

@section('content')
<div class="p-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Selamat datang, {{ Auth::user()->name }}
            </h1>
            <p class="text-gray-400 mt-1">
                Berikut ringkasan keuangan bulan ini.
            </p>
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

    <!-- STAT CARDS -->
    <div class="grid grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <iconify-icon icon="solar:wallet-bold" class="text-[20px] text-blue-500"></iconify-icon>
                </div>
                <span class="text-gray-500 font-semibold">Saldo Kas</span>
            </div>
            <p class="text-2xl font-bold text-[#0F5D73]">
                Rp {{ number_format($saldoKas, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                    <iconify-icon icon="solar:arrow-down-bold" class="text-[20px] text-green-500"></iconify-icon>
                </div>
                <span class="text-gray-500 font-semibold">Total Kas Masuk</span>
            </div>
            <p class="text-2xl font-bold text-green-500">
                Rp {{ number_format($totalMasuk, 0, ',', '.') }}
            </p>
        </div>

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

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                    <iconify-icon icon="solar:clipboard-list-bold" class="text-[20px] text-purple-500"></iconify-icon>
                </div>
                <span class="text-gray-500 font-semibold">Jumlah Transaksi</span>
            </div>
            <p class="text-2xl font-bold text-purple-500">
                {{ $jumlahTransaksi }}
            </p>
        </div>

    </div>

    <!-- CHART + RINGKASAN -->
    <div class="grid grid-cols-3 gap-6">

        <div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-bold text-gray-700">Grafik Arus Kas</h2>
                <button class="text-sm border border-gray-200 px-4 py-2 rounded-lg text-gray-500">
                    7 Hari Terakhir
                </button>
            </div>
            <div class="flex items-center gap-6 mb-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <span class="text-sm text-gray-500">Kas Masuk</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                    <span class="text-sm text-gray-500">Kas Keluar</span>
                </div>
            </div>
            <canvas id="kasChart" height="120"></canvas>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <h2 class="font-bold text-gray-700 mb-6">Ringkasan Bulan Ini</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Saldo Awal</span>
                    <span class="font-semibold text-gray-700">
                        Rp {{ number_format($saldoAwal, 0, ',', '.') }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Total Kas Masuk</span>
                    <span class="font-semibold text-green-500">
                        Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Total Kas Keluar</span>
                    <span class="font-semibold text-red-500">
                        Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                    </span>
                </div>
                <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                    <span class="text-gray-500 font-semibold">Saldo Akhir</span>
                    <span class="font-bold text-[#0F5D73] text-lg">
                        Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [
                {
                    label: 'Kas Masuk',
                    data: [500000, 750000, 1250000, 800000, 650000, 750000, 1200000],
                    borderColor: '#3B82F6',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#3B82F6',
                    pointRadius: 4,
                },
                {
                    label: 'Kas Keluar',
                    data: [400000, 350000, 750000, 500000, 300000, 400000, 850000],
                    borderColor: '#EF4444',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#EF4444',
                    pointRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) return (value/1000000).toFixed(1) + 'M';
                            if (value >= 1000) return (value/1000) + 'K';
                            return value;
                        }
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection