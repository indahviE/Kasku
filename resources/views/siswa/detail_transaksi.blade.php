<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen text-slate-900 antialiased pb-16">

<div class="max-w-4xl mx-auto px-4 py-8 sm:py-14">

    <div class="flex items-center justify-between mb-8">
        <a href="{{ route('siswa.riwayat') }}"
           class="group w-11 h-11 rounded-2xl border border-slate-200 bg-white flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-100 hover:shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-base font-bold text-slate-800 tracking-wide">Detail Transaksi</h1>
        <div class="w-11"></div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden grid grid-cols-1 md:grid-cols-12 gap-0 relative">
        
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-500 z-10"></div>

        <div class="md:col-span-5 p-8 pt-14 text-center bg-gradient-to-b from-slate-50/60 via-white to-white border-b md:border-b-0 md:border-r border-slate-100 flex flex-col justify-center items-center">
            
            @if($pembayaran->status == 'lunas')
                <div class="w-20 h-20 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 border-4 border-white shadow-md shadow-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold tracking-wider uppercase shadow-sm">
                    Sukses Diverifikasi
                </span>
            @elseif($pembayaran->status == 'pending' || $pembayaran->status == 'nunggak')
                <div class="w-20 h-20 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mb-4 border-4 border-white shadow-md shadow-amber-100 relative">
                    <span class="absolute inset-0 rounded-full bg-amber-400/20 animate-pulse"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01"/>
                    </svg>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold tracking-wider uppercase shadow-sm">
                    Menunggu Verifikasi
                </span>
            @else
                <div class="w-20 h-20 rounded-full bg-red-50 text-red-600 flex items-center justify-center mb-4 border-4 border-white shadow-md shadow-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-red-50 text-red-700 border border-red-200 text-xs font-bold tracking-wider uppercase shadow-sm">
                    Pembayaran Ditolak
                </span>
            @endif

            <div class="mt-6">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Bayar</p>
                <h2 class="text-3xl lg:text-4xl font-black text-slate-900 mt-1 tracking-tight">
                    Rp {{ number_format($pembayaran->jml_bayar, 0, ',', '.') }}
                </h2>
            </div>
            
            <p class="text-xs text-slate-400 mt-3 font-medium bg-slate-100 inline-block px-3 py-1 rounded-md">
                {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}
            </p>
        </div>


        <div class="md:col-span-7 p-6 sm:p-8 space-y-6 flex flex-col justify-between bg-white">
            
            <div class="space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Rincian Pembayaran</h3>
                    <span class="text-[9px] font-mono bg-slate-100 text-slate-500 px-2 py-0.5 rounded">SECURE</span>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400 font-medium">ID Transaksi</span>
                        <span class="font-mono font-bold text-slate-700 bg-slate-50 px-2 py-0.5 rounded-md border border-slate-100">{{ $pembayaran->id }}</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400 font-medium">Nama Siswa</span>
                        <span class="font-bold text-slate-800">{{ auth()->user()->name }}</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400 font-medium">Metode</span>
                        <span class="font-semibold text-slate-800">{{ $pembayaran->metode == 'transfer' ? 'QRIS' : 'Tunai Ke Bendahara' }}</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400 font-medium">Status Verifikasi</span>
                        <span class="font-extrabold capitalize text-xs px-2.5 py-0.5 rounded-md
                            @if($pembayaran->status == 'lunas') bg-emerald-50 text-emerald-600 border border-emerald-100
                            @elseif($pembayaran->status == 'pending' || $pembayaran->status == 'nunggak') bg-amber-50 text-amber-600 border border-amber-100
                            @else bg-red-50 text-red-600 border border-red-100 @endif">
                            {{ $pembayaran->status == 'nunggak' ? 'pending' : $pembayaran->status }}
                        </span>
                    </div>

                    @if($pembayaran->tagihan)
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400 font-medium">Periode Kas</span>
                        <span class="font-bold text-indigo-600 bg-indigo-50/50 px-2.5 py-0.5 rounded-md">{{ $pembayaran->tagihan->periode }}</span>
                    </div>
                    @endif
                </div>

                <div class="p-4 rounded-2xl border transition-all duration-300
                @if($pembayaran->status == 'lunas') bg-emerald-50/60 border-emerald-100/80
                @elseif($pembayaran->status == 'pending' || $pembayaran->status == 'nunggak') bg-amber-50/60 border-amber-100/80
                @else bg-red-50/60 border-red-100/80 @endif">
                
                <div class="flex items-start gap-3 text-left">
                    @if($pembayaran->status == 'lunas')
                        <div class="shrink-0 w-5 h-5 text-emerald-600 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p class="text-xs text-emerald-700 font-semibold leading-relaxed">
                            Terima kasih, pembayaran Anda telah resmi dibukukan oleh bendahara kelas.
                        </p>

                    @elseif($pembayaran->status == 'pending' || $pembayaran->status == 'nunggak')
                        <div class="shrink-0 w-5 h-5 text-amber-600 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p class="text-xs text-amber-700 font-semibold leading-relaxed">
                            Mohon tunggu, bendahara sedang memeriksa validitas bukti transfer Anda.
                        </p>

                    @else
                        <div class="shrink-0 w-5 h-5 text-red-600 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p class="text-xs text-red-700 font-semibold leading-relaxed">
                            Bukti tidak valid atau nominal tidak sesuai. Silakan hubungi bendahara.
                        </p>
                    @endif
                </div>
            </div>

            @if($pembayaran->bukti_bayar)
            <div class="pt-4 border-t border-slate-100">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2.5">Lampiran Bukti</h3>
                <div class="bg-slate-50 p-2 rounded-2xl border border-slate-200/60 shadow-sm flex justify-center overflow-hidden group">
                    <img src="{{ asset('storage/bukti_pembayaran/'.$pembayaran->bukti_bayar) }}"
                         alt="Bukti Pembayaran"
                         class="w-full max-h-[160px] object-contain rounded-xl group-hover:scale-[1.02] transition-transform duration-300">
                </div>
            </div>
            @endif

        </div>

    </div>
</div>

@include('components.footer')

</body>
</html>