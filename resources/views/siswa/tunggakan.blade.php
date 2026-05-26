<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tagihan Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen text-gray-900">

<div class="max-w-4xl mx-auto px-4 py-8">
    
    <div class="mb-6">
        <a href="{{ route('siswa.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-black transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Tagihan Kas Anda</h1>
        <p class="text-gray-500 mt-1">Berikut adalah daftar seluruh tagihan kas yang tercatat di sistem.</p>
    </div>

    <div class="space-y-4">
        @forelse ($tunggakan as $item)
            @php
                // Cek status pembayaran berdasarkan relasi ke tabel pembayaran
                $lunas = $item->pembayaran->where('status', 'lunas')->count() > 0;
            @endphp

            <div class="border border-gray-200 rounded-3xl p-6 bg-white hover:shadow-md transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0 {{ $lunas ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                        @if($lunas)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg text-gray-900">{{ $item->nama_tagihan }}</h3>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 mt-1">
                            <p>Periode: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($item->periode)->translatedFormat('F Y') }}</span></p>
                            <p>Batas Bayar: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($item->batas_bayar)->translatedFormat('d M Y') }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between sm:justify-end sm:text-right gap-6 border-t sm:border-t-0 pt-4 sm:pt-0 border-gray-100">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Nominal</p>
                        <p class="font-bold text-xl text-gray-900">Rp {{ number_format($item->nominal, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        @if($lunas)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                Lunas
                            </span>
                        @else
                            <div class="flex flex-col gap-1">
                                <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                    Belum Bayar
                                </span>
                                <a href="{{ route('siswa.transaksi', [
                                        'tagihan_id' => $item->id,
                                        'nominal' => $item->nominal
                                    ]) }}"
                                    class="text-xs text-center font-medium text-black underline hover:text-gray-600 mt-1">
                                        Bayar Sekarang
                                    </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="border border-dashed border-gray-200 rounded-3xl p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-500 font-medium">Bagus sekali! Tidak ada data tagihan kas yang ditemukan.</p>
            </div>
        @endforelse
    </div>

</div>

</body>
@include('components.footer')
</html>