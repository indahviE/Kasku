<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Kas</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">

<div class="max-w-6xl mx-auto px-4 py-6 md:py-10">

    {{-- BACK --}}
    <div class="mb-6">

        <a href="{{ route('siswa.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-black transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            Kembali
        </a>

    </div>

    {{-- WRAPPER --}}
    <div class="bg-[#f7f7f7] rounded-[2rem] md:rounded-[2.5rem] p-5 md:p-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            {{-- LEFT --}}
            <div>

                <p class="uppercase tracking-[0.2em] text-xs text-gray-400 font-semibold">
                    PAYMENT FORM
                </p>

                <h1 class="text-3xl md:text-5xl font-bold leading-tight mt-4 text-gray-900">
                    Bayar Kas <br>
                    Dengan Mudah
                </h1>

                <p class="text-gray-500 mt-5 leading-relaxed text-sm md:text-base max-w-md">
                    Silahkan pilih metode pembayaran dan unggah bukti pembayaran.
                </p>

            </div>

            {{-- RIGHT --}}
            <div class="bg-white rounded-[2rem] p-5 md:p-8 border border-gray-100">

                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm">

                        <ul class="list-disc list-inside">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                {{-- FORM --}}
                <form action="{{ route('siswa.transaksi.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- TAGIHAN ID --}}
                    <input type="hidden"
                           name="tagihan_id"
                           value="{{ request('tagihan_id') }}">

                    {{-- QRIS --}}
                    <div class="mb-6">

                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4 text-center">

                            <img src="{{ asset('images/QRIS FATHAN.png') }}"
                                 alt="QRIS"
                                 class="w-44 md:w-56 mx-auto object-contain">

                            <p class="text-sm text-gray-500 mt-4">
                                Scan QRIS jika memilih metode transfer
                            </p>

                        </div>

                    </div>

                    {{-- JUMLAH BAYAR --}}
                    <div class="mb-5">

                        <label class="text-sm text-gray-500 mb-2 block">
                            Jumlah Bayar (Rp)
                        </label>

                        <input
                            type="number"
                            name="jml_bayar"

                            value="{{ old('jml_bayar', request('nominal')) }}"

                            @if(request('nominal'))
                                readonly
                            @endif

                            placeholder="Masukkan nominal pembayaran"

                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-black"
                        >

                    </div>

                    {{-- BUKTI --}}
                    <div class="mb-6">

                        <label class="text-sm text-gray-500 mb-2 block">
                            Upload Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti_bayar"
                            accept="image/*"

                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm"
                        >

                    </div>

                    {{-- METODE --}}
                    <div class="mb-6">

                        <label class="text-sm text-gray-500 mb-3 block">
                            Metode Pembayaran
                        </label>

                        <div class="flex gap-6">

                            {{-- TRANSFER --}}
                            <label class="flex items-center gap-3 cursor-pointer group">

                                <input
                                    type="radio"
                                    name="metode"
                                    value="transfer"

                                    {{ old('metode', 'transfer') == 'transfer' ? 'checked' : '' }}

                                    class="w-5 h-5 accent-black cursor-pointer"
                                >

                                <span class="text-sm font-medium text-gray-700 group-hover:text-black transition">
                                    Transfer (QRIS)
                                </span>

                            </label>

                            {{-- TUNAI --}}
                            <label class="flex items-center gap-3 cursor-pointer group">

                                <input
                                    type="radio"
                                    name="metode"
                                    value="tunai"

                                    {{ old('metode') == 'tunai' ? 'checked' : '' }}

                                    class="w-5 h-5 accent-black cursor-pointer"
                                >

                                <span class="text-sm font-medium text-gray-700 group-hover:text-black transition">
                                    Tunai ke Bendahara
                                </span>

                            </label>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-black text-white py-4 font-semibold hover:scale-[1.01] transition text-sm md:text-base">

                        Bayar Sekarang

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@include('components.footer')

</body>
</html>