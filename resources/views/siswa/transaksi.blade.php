<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Kas</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen text-gray-900 pb-6">

<div class="max-w-6xl mx-auto px-4 py-6">

    {{-- HEADER WITH BACK BUTTON AND PROFILE DROPDOWN --}}
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

    {{-- WARNING / PEMBERITAHUAN METODE --}}
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-2xl text-sm flex items-start gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-semibold">Informasi Metode Pembayaran:</p>
            <p class="text-blue-700 mt-1">Halaman ini hanya menerima pembayaran non-tunai via <strong>QRIS</strong>. Jika Anda ingin membayar secara <strong>Tunai (Cash)</strong>, silakan serahkan uang langsung ke Bendahara kelas agar diinputkan secara manual.</p>
        </div>
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
                    Silahkan lakukan pembayaran melalui scan QRIS di samping, lalu unggah bukti pembayaran Anda untuk divalidasi.
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

                    {{-- FIXED METODE (HIDDEN) SEBAGAI QRIS/TRANSFER --}}
                    <input type="hidden" name="metode" value="transfer">

                    {{-- QRIS --}}
                    <div class="mb-6">
                        <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4 text-center">
                            <img src="{{ asset('images/QRIS FATHAN.png') }}"
                                 alt="QRIS"
                                 class="w-44 md:w-56 mx-auto object-contain">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mt-4">
                                Metode: Transfer (QRIS)
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
                            @if(request('nominal')) readonly @endif
                            placeholder="Masukkan nominal pembayaran"
                            class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm md:text-base focus:outline-none focus:ring-2 focus:ring-black"
                        >
                    </div>

                    {{-- BUKTI (DROPZONE DRAG & DROP + PREVIEW) --}}
                    <div class="mb-6">
                        <label class="text-sm text-gray-500 mb-2 block">
                            Upload Bukti Pembayaran
                        </label>

                        <label id="dropzone" class="group flex flex-col items-center justify-center w-full min-h-36 rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 hover:bg-gray-100 hover:border-black transition cursor-pointer p-4 text-center relative overflow-hidden">
                            
                            {{-- Tampilan Informasi Awal --}}
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-black transition mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-gray-600 font-medium">
                                    <span class="text-black font-semibold">Seret & Lepas foto disini</span> atau Klik
                                </p>
                                <p class="text-xs text-gray-400 mt-1 max-w-[250px] truncate">
                                    Format: PNG, JPG, JPEG
                                </p>
                            </div>

                            {{-- Tampilan Preview Gambar --}}
                            <div id="preview-container" class="hidden w-full flex flex-col items-center gap-2 pointer-events-none">
                                <img id="image-preview" src="#" alt="Pratinjau Bukti" class="max-h-48 rounded-xl object-contain shadow-sm border border-gray-200">
                                <p id="file-name-display" class="text-xs text-emerald-600 font-semibold max-w-[250px] truncate"></p>
                                <span class="text-xs text-gray-400 underline">Klik / seret file baru untuk mengganti</span>
                            </div>

                            <input
                                type="file"
                                id="bukti_bayar"
                                name="bukti_bayar"
                                accept="image/*"
                                class="hidden"
                                onchange="handleFileSelect(this.files)"
                            >
                        </label>
                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-black text-white py-4 font-semibold hover:scale-[1.01] transition text-sm md:text-base shadow-md">
                        Bayar Sekarang
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@include('components.footer')

<script>
    // SCRIPT DROPDOWN PROFIL
    const accountBtn = document.getElementById('accountBtn');
    const accountMenu = document.getElementById('accountMenu');

    accountBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        accountMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', function(e) {
        if (!accountBtn.contains(e.target) && !accountMenu.contains(e.target)) {
            accountMenu.classList.add('hidden');
        }
    });

    // SCRIPT DRAG AND DROP & PREVIEW GAMBAR
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('bukti_bayar');

    // Mencegah perilaku default browser (seperti membuka gambar otomatis di tab baru)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Efek visual saat file diseret di atas Dropzone
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.add('border-black', 'bg-gray-100');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.remove('border-black', 'bg-gray-100');
        }, false);
    });

    // Menangani file saat dilepas (Dropped)
    dropzone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            // Masukkan file hasil drag ke dalam input file HTML agar form bisa mengirimkannya
            fileInput.files = files;
            handleFileSelect(files);
        }
    });

    // Memproses file untuk memunculkan gambar (Preview)
    function handleFileSelect(files) {
        const placeholder = document.getElementById('upload-placeholder');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const fileNameDisplay = document.getElementById('file-name-display');

        if (files && files[0]) {
            const file = files[0];

            // Validasi sederhana memastikan yang dimasukkan adalah gambar
            if (!file.type.startsWith('image/')) {
                alert('Silakan masukkan file format gambar saja!');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                fileNameDisplay.innerText = "Terpilih: " + file.name;
                
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "#";
            fileNameDisplay.innerText = "";
            placeholder.classList.remove('hidden');
            previewContainer.classList.add('hidden');
        }
    }
</script>

</body>
</html>