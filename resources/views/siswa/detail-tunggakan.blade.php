<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tagihan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen text-gray-900">

<div class="max-w-xl mx-auto px-4 py-6 pb-24">

    <!-- BACK -->
       <div class="flex items-center justify-between mb-6">
        <a href="{{ route('siswa.index') }}" class="w-12 h-12 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="relative">
            <button id="accountBtn" class="w-11 h-11 rounded-2xl border border-gray-200 flex items-center justify-center hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21a8 8 0 10-16 0m12-11a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </button>

            <div id="accountMenu" class="hidden absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden z-50">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>

                <a href="/profile" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium">Manage Account</span>
                </a>

                <form method="POST" action="{{ route('siswa.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-50 text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                        </svg>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- CARD -->
    <div class="border border-gray-200 rounded-3xl overflow-hidden bg-white">

        <!-- HEADER -->
        <div class="p-6 border-b border-gray-100">

            <h1 class="text-2xl font-bold text-gray-900">
                Detail Tagihan
            </h1>

              <p class="text-sm text-gray-500 mt-1">
            Informasi lengkap tagihan kas
        </p>
        </div>


        <!-- CONTENT -->
        <div class="p-6">

            <div class="space-y-5">

                <!-- NAMA -->
                <div class="flex items-left justify-between py-4">

                    <p class="text-sm text-gray-500">
                        Nama Tagihan
                    </p>

                    <p class="text-sm font-semibold text-gray-900">
                        {{ $tagihan->nama_tagihan }}
                    </p>

                </div>


                <!-- PERIODE -->
                <div class="flex items-start justify-between py-4">

                    <p class="text-sm text-gray-500">
                        Periode
                    </p>

                    <p class="text-sm font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($tagihan->periode)->translatedFormat('F Y') }}
                    </p>

                </div>


                <!-- NOMINAL -->
                <div class="flex items-start justify-between py-4">

                    <p class="text-sm text-gray-500">
                        Nominal
                    </p>

                    <p class="text-sm font-semibold text-gray-900">
                        Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                    </p>

                </div>


                <!-- DEADLINE -->
                <div class="flex items-start justify-between py-4">

                    <p class="text-sm text-gray-500">
                        Deadline
                    </p>

                    <p class="text-sm font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($tagihan->batas_bayar)->translatedFormat('d M Y') }}
                    </p>

                </div>


                <!-- STATUS -->
                <div class="flex items-start justify-between py-4">

                    <p class="text-sm text-gray-500">
                        Status
                    </p>

                    @if($lunas)

                        <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-semibold border border-green-100">
                            Lunas
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-50 text-red-500 text-xs font-semibold border border-red-100">
                            Belum Bayar
                        </span>

                    @endif

                </div>

            </div>

        </div>


        <!-- PAYMENT SECTION -->
        <div class="border-t border-gray-100 p-6">

            @if(!$lunas)

                <!-- TITLE -->
                <h2 class="font-semibold text-gray-900 mb-4">
                    Metode Pembayaran
                </h2>

                <!-- METHOD -->
              <div class="border border-blue-200 bg-blue-50 rounded-2xl p-4 flex items-center gap-4">

    <div class="w-12 h-12 rounded-2xl bg-white border border-blue-200 flex items-center justify-center">

        <!-- SVG QR Scan -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 text-blue-600"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="1.8"
                  d="M7 4H5a1 1 0 00-1 1v2
                     M17 4h2a1 1 0 011 1v2
                     M20 17v2a1 1 0 01-1 1h-2
                     M4 17v2a1 1 0 001 1h2"/>

            <rect x="8" y="8" width="8" height="8" rx="1"
                  stroke-width="1.8"/>

            <path stroke-linecap="round"
                  stroke-width="2"
                  d="M7 12h10"/>

        </svg>

    </div>

    <div>

        <h3 class="font-semibold text-sm text-gray-900">
            QRIS
        </h3>

        <p class="text-xs text-gray-500 mt-1">
            Pembayaran via scan QR code
        </p>

    </div>

</div>


                <!-- BUTTON -->
                <a href="{{ route('siswa.transaksi', [
                        'tagihan_id' => $tagihan->id,
                        'nominal' => $tagihan->nominal
                    ]) }}"
                   class="w-full mt-6 inline-flex items-center justify-center rounded-2xl bg-black text-white py-4 text-sm font-semibold hover:scale-[1.01] transition text-sm md:text-base">

                    Lanjut Bayar

                </a>

            @else

                <!-- TITLE -->
                <h2 class="font-semibold text-gray-900 mb-4">
                    Data Pembayaran
                </h2>


                <!-- PAYMENT INFO -->
                <div class="space-y-4">

                    <!-- METODE -->
                    <div class="border border-gray-200 rounded-2xl p-4 flex items-center justify-between">

                        <div>

                            <p class="text-xs text-gray-400">
                                Metode
                            </p>

                            <h3 class="font-semibold text-sm text-gray-900 mt-1">
                                {{ $pembayaran->metode ?? 'QRIS' }}
                            </h3>

                        </div>

                        <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-green-600"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7" />

                            </svg>

                        </div>

                    </div>


                    <!-- TANGGAL -->
                    <div class="border border-gray-200 rounded-2xl p-4 flex items-center justify-between">

                        <div>

                            <p class="text-xs text-gray-400">
                                Tanggal Pembayaran
                            </p>

                            <h3 class="font-semibold text-sm text-gray-900 mt-1">
                                {{ \Carbon\Carbon::parse($pembayaran->created_at)->translatedFormat('d F Y') }}
                            </h3>

                        </div>

                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-gray-700"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7
                                      a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />

                            </svg>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@include('components.footer')

</body>
</html>