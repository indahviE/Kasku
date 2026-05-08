<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasku</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tambahkan Playfair Display di baris Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap');

        *{
            font-family: 'Inter', sans-serif;
        }

        h1,h2,h3{
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #F8F8F8;
        }

        .hero-text{
            line-height: 1.1;
        }

        .floating-line{
            position: absolute;
            border: 2px solid #d4d4d4;
            border-radius: 999px;
            opacity: .6;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <x-navbar></x-navbar>

    <!-- Hero -->
    <section class="relative">

        <!-- decorative lines -->
        <div class="floating-line w-[400px] h-[400px] top-24 right-20"></div>
        <div class="floating-line w-[300px] h-[300px] bottom-0 left-[45%]"></div>

        <div class="max-w-7xl mx-auto px-6 py-16">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Left -->
                <div>

                    <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-xs font-semibold mb-6">
                        #1 WEBSITE KAS KELAS
                    </div>
                    <h1 class="hero-text text-5xl lg:text-7xl font-bold text-gray-900 mb-6">
                        Kelola <span class="font-['Playfair_Display'] italic font-medium">Kas Kelas</span> <br>
                        Jadi Lebih <span class="font-['Playfair_Display'] italic font-medium underline underline-offset-8 decoration-1">Mudah</span>
                    </h1>

                    <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-xl">
                        Platform modern untuk mengatur pemasukan dan pengeluaran kas kelas secara transparan, cepat, dan efisien.
                    </p>

                    <!-- Input -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">

                        <div class="flex items-center bg-white rounded-full px-5 py-3 shadow-sm border border-gray-200 w-full max-w-md">

                            <input
                                type="text"
                                placeholder="Masukkan email..."
                                class="w-full outline-none text-sm bg-transparent"
                            >

                            <a href="/login"><button class="bg-black text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                                Get Started
                            </button></a>

                        </div>

                    </div>

                    <!-- Partners -->
                    <div>
                        <p class="text-sm text-gray-400 mb-4">
                            Trusted by
                        </p>

                        <div class="flex items-center gap-8 text-2xl font-bold text-gray-300">
                            <span>Google</span>
                            <span>Meta</span>
                            <span>Apple</span>
                        </div>
                    </div>

                </div>

                <!-- Right -->
                <div class="relative flex justify-center">

                    <!-- Phone -->
                    <div class="bg-black rounded-[45px] p-3 shadow-2xl w-[320px] relative z-10">

                        <div class="bg-white rounded-[35px] overflow-hidden min-h-[620px] p-5">

                            <!-- top -->
                            <div class="flex items-center justify-between mb-8">

                                <div>
                                    <p class="text-xs text-gray-400">
                                        Welcome back
                                    </p>

                                    <h2 class="font-bold">
                                        Kasku
                                    </h2>
                                </div>

                                <div class="w-10 h-10 rounded-full bg-indigo-100"></div>

                            </div>

                            <!-- card -->
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl p-6 text-white mb-8">

                                <p class="text-sm opacity-80 mb-4">
                                    Total Kas
                                </p>

                                <h1 class="text-3xl font-bold mb-8">
                                    Rp 5.250.000
                                </h1>

                                <div class="flex items-center justify-between text-sm opacity-80">
                                    <span>2026</span>
                                    <span>KAS KELAS</span>
                                </div>

                            </div>

                            <!-- menu -->
                            <div class="grid grid-cols-4 gap-4 mb-8">

                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 mx-auto mb-2"></div>
                                    <p class="text-xs">Bayar</p>
                                </div>

                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-pink-100 mx-auto mb-2"></div>
                                    <p class="text-xs">Kas</p>
                                </div>

                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-green-100 mx-auto mb-2"></div>
                                    <p class="text-xs">Laporan</p>
                                </div>

                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 mx-auto mb-2"></div>
                                    <p class="text-xs">More</p>
                                </div>

                            </div>

                            <!-- transaction -->
                            <div>

                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="font-bold text-lg">
                                        Transactions
                                    </h3>

                                    <span class="text-xs text-gray-400">
                                        Today
                                    </span>
                                </div>

                                <!-- item -->
                                <div class="flex items-center justify-between mb-5">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-full bg-indigo-100"></div>

                                        <div>
                                            <h4 class="font-semibold text-sm">
                                                Pembayaran Kas
                                            </h4>

                                            <p class="text-xs text-gray-400">
                                                XI RPL 2
                                            </p>
                                        </div>

                                    </div>

                                    <p class="font-semibold text-sm text-green-500">
                                        +25.000
                                    </p>

                                </div>

                                <!-- item -->
                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="w-12 h-12 rounded-full bg-red-100"></div>

                                        <div>
                                            <h4 class="font-semibold text-sm">
                                                Beli Peralatan
                                            </h4>

                                            <p class="text-xs text-gray-400">
                                                Pengeluaran
                                            </p>
                                        </div>

                                    </div>

                                    <p class="font-semibold text-sm text-red-500">
                                        -50.000
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

        <!-- How It Works -->
    <section class="py-24">

        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-20">

                <p class="text-sm text-gray-400 mb-3">
                    — PROCESS
                </p>

                <h2 class="text-4xl font-bold text-gray-900">
                    How it works
                </h2>

            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <!-- Item -->
                <div class="text-center">

                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">
                        1
                    </div>

                    <h3 class="text-xl font-bold mb-4">
                        Register
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Daftarkan akun kelasmu dan mulai kelola keuangan dengan mudah.
                    </p>

                </div>

                <!-- Item -->
                <div class="text-center">

                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">
                        2
                    </div>

                    <h3 class="text-xl font-bold mb-4">
                        Input Kas
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Tambahkan pemasukan dan pengeluaran kas secara real-time.
                    </p>

                </div>

                <!-- Item -->
                <div class="text-center">

                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">
                        3
                    </div>

                    <h3 class="text-xl font-bold mb-4">
                        Monitor
                    </h3>

                    <p class="text-gray-500 leading-relaxed">
                        Pantau seluruh transaksi dan laporan kas dengan transparan.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Testimonial -->
    <section class="pb-24">

        <div class="max-w-6xl mx-auto px-6">

            <div class="bg-white rounded-[40px] p-10 lg:p-16 shadow-sm border border-gray-100">

                <div class="grid lg:grid-cols-2 gap-12 items-center">

                    <!-- Left -->
                    <div class="flex justify-center">

                        <div class="w-[300px] h-[380px] bg-gradient-to-b from-gray-100 to-gray-200 rounded-[30px]"></div>

                    </div>

                    <!-- Right -->
                    <div>

                        <p class="text-sm text-gray-400 mb-4">
                            — TESTIMONIALS
                        </p>

                        <h2 class="text-4xl font-bold text-gray-900 leading-tight mb-6">
                            Apa kata pengguna kami
                        </h2>

                        <p class="text-gray-500 leading-relaxed mb-8">
                            “Kasku membantu kami mengatur keuangan kelas dengan lebih transparan dan modern. Semua siswa jadi bisa memantau kas tanpa ribet.”
                        </p>

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-full bg-indigo-100"></div>

                            <div>
                                <h4 class="font-bold">
                                    Indah Nraisyh
                                </h4>

                                <p class="text-sm text-gray-400">
                                    Bendahara Kelas
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-200 py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-4 gap-12">

                <!-- Logo -->
                <div>

                    <div class="flex items-center gap-2 mb-5">

                        <div class="w-3 h-3 rounded-full bg-indigo-600"></div>

                        <h2 class="text-2xl font-bold">
                            Kasku
                        </h2>

                    </div>

                    <p class="text-gray-500 leading-relaxed mb-6">
                        Platform modern untuk manajemen kas kelas online yang transparan dan efisien.
                    </p>

                </div>

                <!-- Menu -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Menu
                    </h3>

                    <ul class="space-y-3 text-gray-500">

                        <li>
                            <a href="#" class="hover:text-black transition">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="#" class="hover:text-black transition">
                                Features
                            </a>
                        </li>

                        <li>
                            <a href="#" class="hover:text-black transition">
                                About
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- Company -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Company
                    </h3>

                    <ul class="space-y-3 text-gray-500">

                        <li>About Us</li>
                        <li>Careers</li>
                        <li>Blog</li>

                    </ul>

                </div>

                <!-- Subscribe -->
                <div>

                    <h3 class="font-bold text-lg mb-5">
                        Subscribe
                    </h3>

                    <div class="flex items-center bg-white border border-gray-200 rounded-full p-2">

                        <input
                            type="text"
                            placeholder="Your email"
                            class="w-full px-4 outline-none bg-transparent text-sm"
                        >

                        <button class="bg-black text-white px-5 py-2 rounded-full text-sm">
                            Submit
                        </button>

                    </div>

                </div>

            </div>

            <div class="border-t border-gray-200 mt-14 pt-8 text-center text-sm text-gray-400">
                © 2026 Kasku. All rights reserved.
            </div>

        </div>

    </footer>

</body>
</html>
