<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Kasku</title>
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
            <div class="text-center">
                <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Hubungi <span class="font-['Playfair_Display'] italic">Kami</span>
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Ada pertanyaan atau saran? Tim kami siap membantu Anda kapan saja.
                </p>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16">

                <!-- CONTACT FORM -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Kirim Pesan Kepada Kami</h2>
                    <form action="/contact/send" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-600 focus:outline-none transition" placeholder="Nama Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-600 focus:outline-none transition" placeholder="email@anda.com">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Subjek</label>
                            <input type="text" name="subject" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-600 focus:outline-none transition" placeholder="Topik pertanyaan Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Tipe Pertanyaan</label>
                            <select name="type" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-600 focus:outline-none transition">
                                <option value="">Pilih kategori</option>
                                <option value="general">Pertanyaan Umum</option>
                                <option value="technical">Masalah Teknis</option>
                                <option value="feature">Saran Fitur</option>
                                <option value="partnership">Kerjasama</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Pesan</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-600 focus:outline-none transition resize-none" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Kirim Pesan
                        </button>

                        <p class="text-sm text-gray-500">
                            Kami biasanya merespon dalam waktu 24 jam.
                        </p>
                    </form>
                </div>

                <!-- CONTACT INFO -->
                <div class="space-y-8">
                    <h2 class="text-3xl font-bold text-gray-900">Informasi Kontak</h2>

                    <!-- Email -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Email</h3>
                                <a href="mailto:support@kasku.app" class="text-indigo-600 hover:underline">kasku@gmail.com</a>
                                <p class="text-sm text-gray-600 mt-1">Kami balas dalam 24 jam</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">WhatsApp</h3>
                                <a href="https://wa.me/qr/PHMHZV7LLAGDL1" class="text-indigo-600 hover:underline">(+62) 899-6733-553</a>
                                <p class="text-sm text-gray-600 mt-1">Senin - Jumat, 09:00 - 17:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Lokasi</h3>
                                <p class="text-gray-600">Jl Perjuangan<br>Kota Cirebon, Jawa Barat<br>Indonesia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ikuti Kami</h3>
                        <div class="flex gap-3 flex-wrap">
                            <a href="https://instagram.com/kasku.app" class="w-12 h-12 rounded-lg bg-white border border-indigo-200 flex items-center justify-center hover:bg-indigo-50 transition text-lg">📷</a>
                            <a href="https://twitter.com/kasku_app" class="w-12 h-12 rounded-lg bg-white border border-indigo-200 flex items-center justify-center hover:bg-indigo-50 transition text-lg">𝕏</a>
                            <a href="https://facebook.com/kasku.app" class="w-12 h-12 rounded-lg bg-white border border-indigo-200 flex items-center justify-center hover:bg-indigo-50 transition text-lg">f</a>
                            <a href="https://tiktok.com/@kasku.app" class="w-12 h-12 rounded-lg bg-white border border-indigo-200 flex items-center justify-center hover:bg-indigo-50 transition text-lg">♪</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
                <p class="text-gray-600">Cari jawaban atas pertanyaan yang sering diajukan</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-indigo-300 transition">
                    <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="font-semibold text-gray-900 text-left">Apakah Kasku benar-benar gratis?</span>
                        <span class="text-xl text-gray-400 group-hover:text-indigo-600 transition">+</span>
                    </button>
                    <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-gray-600">Ya, Kasku 100% gratis untuk semua kelas. Tidak ada biaya tersembunyi atau charge tambahan. Kami percaya transparansi keuangan kelas harus dapat diakses oleh semua orang.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-indigo-300 transition">
                    <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="font-semibold text-gray-900 text-left">Berapa lama waktu setup?</span>
                        <span class="text-xl text-gray-400 group-hover:text-indigo-600 transition">+</span>
                    </button>
                    <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-gray-600">Hanya butuh 2 menit! Cukup daftar, buat kelas, dan ajak teman-teman. Tidak ada konfigurasi rumit, langsung bisa pakai.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-indigo-300 transition">
                    <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="font-semibold text-gray-900 text-left">Bagaimana dengan keamanan data?</span>
                        <span class="text-xl text-gray-400 group-hover:text-indigo-600 transition">+</span>
                    </button>
                    <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-gray-600">Data Anda dilindungi dengan enkripsi tingkat enterprise. Kami menggunakan cloud server terpercaya dengan backup otomatis setiap hari untuk memastikan data Anda selalu aman.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-indigo-300 transition">
                    <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="font-semibold text-gray-900 text-left">Apakah bisa diakses dari smartphone?</span>
                        <span class="text-xl text-gray-400 group-hover:text-indigo-600 transition">+</span>
                    </button>
                    <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-gray-600">Tentu! Kasku dioptimalkan untuk mobile. Akses dari browser atau download aplikasi kami di iOS dan Android untuk pengalaman terbaik.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-indigo-300 transition">
                    <button class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition" onclick="toggleFaq(this)">
                        <span class="font-semibold text-gray-900 text-left">Apakah ada dukungan pelanggan?</span>
                        <span class="text-xl text-gray-400 group-hover:text-indigo-600 transition">+</span>
                    </button>
                    <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <p class="text-gray-600">Ya! Tim support kami tersedia 24/7 melalui email, WhatsApp, dan chat. Kami siap membantu menyelesaikan masalah dalam waktu singkat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Masih Ada Pertanyaan?</h2>
            <p class="text-lg text-indigo-100 mb-8">
                Jangan ragu untuk menghubungi kami. Kami senang membantu!
            </p>
            <a href="#contact" class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Hubungi Kami Sekarang
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

    <script>
        function toggleFaq(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.text-xl');

            // Close other FAQs
            document.querySelectorAll('.bg-white.rounded-xl').forEach(item => {
                if (item !== button.closest('.bg-white.rounded-xl')) {
                    item.querySelector('div:not(button)').classList.add('hidden');
                    item.querySelector('.text-xl').textContent = '+';
                }
            });

            // Toggle current
            content.classList.toggle('hidden');
            icon.textContent = content.classList.contains('hidden') ? '+' : '−';
        }
    </script>

</body>
</html>
