<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Kasku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        body { background: #F8F8F8; }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- NAVBAR PLACEHOLDER -->
    <x-navbar></x-navbar>

    <!-- HERO SECTION -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Tentang <span class="font-['Playfair_Display'] italic">Kasku</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami membangun solusi modern untuk transparansi keuangan kelas, membuat pengelolaan kas menjadi lebih mudah dan terpercaya.
                </p>
            </div>
        </div>
    </section>

    <!-- STORY SECTION -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Awal Mula Kasku</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        Kasku lahir dari pengalaman nyata di ruang kelas. Kami melihat bendahara kelas kesulitan mengelola kas dengan cara manual — mencatat di buku, menghitung ulang, dan sering terjadi kesalahan pencatatan.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        Kami juga melihat siswa bertanya-tanya tentang berapa saldo kas mereka, tidak ada transparansi, dan kepercayaan pun sering tergoyahkan.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Itulah mengapa kami memutuskan untuk membangun Kasku — platform digital yang membuat pengelolaan kas kelas menjadi transparan, efisien, dan dapat dipercaya oleh semua pihak.
                    </p>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-8 text-white shadow-2xl">
                        <div class="text-6xl font-bold mb-4" style="font-family:'Poppins',sans-serif;">2024</div>
                        <p class="text-lg mb-4">Kasku diluncurkan sebagai solusi terpercaya untuk ribuan kelas di Indonesia.</p>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">1</span>
                                <span>Platform mobile-first yang user-friendly</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">2</span>
                                <span>Keamanan data tingkat enterprise</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">3</span>
                                <span>Teknologi cloud modern</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Bergabung dengan Ribuan Kelas Lainnya?</h2>
            <p class="text-lg text-indigo-100 mb-8 max-w-2xl mx-auto">
                Mulai kelola kas kelas dengan cara yang lebih modern, transparan, dan terpercaya.
            </p>
            <a href="/register" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 border-t border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:10px;height:10px;border-radius:50%;background:#6366F1;"></div>
                    <h2 style="font-family:'Poppins',sans-serif;font-size:20px;font-weight:700;color:white;margin:0;">Kasku</h2>
                </div>
                <p style="color:rgba(255,255,255,0.4);font-size:14px;margin:0;">© 2026 Kasku. Semua hak dilindungi.</p>
                <div style="display:flex;gap:20px;">
                    <a href="/privacy" style="color:rgba(255,255,255,0.4);text-decoration:none;font-size:14px;">Privasi</a>
                    <a href="/terms" style="color:rgba(255,255,255,0.4);text-decoration:none;font-size:14px;">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
