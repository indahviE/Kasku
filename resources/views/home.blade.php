<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasku</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        body { background: #F8F8F8; }
        .hero-text { line-height: 1.1; }
        .floating-line {
            position: absolute;
            border: 2px solid #d4d4d4;
            border-radius: 999px;
            opacity: .6;
        }

        /* =================== TESTIMONIAL =================== */
        .testimonial-section {
            background: #0A0A0A;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .testimonial-section::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .testimonial-section::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168,85,247,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .testimonial-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            margin-bottom: 20px;
        }

        .testimonial-label::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #6366F1;
        }

        .testimonial-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 60px;
        }

        .testimonial-card {
            background: #111111;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 32px;
            transition: border-color 0.3s ease, transform 0.3s ease;
        }

        .testimonial-card:hover {
            border-color: rgba(99,102,241,0.4);
            transform: translateY(-4px);
        }

        .testimonial-card.featured {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-color: rgba(99,102,241,0.3);
        }

        .quote-mark {
            font-size: 48px;
            line-height: 1;
            color: rgba(99,102,241,0.4);
            font-family: Georgia, serif;
            margin-bottom: 16px;
        }

        .testimonial-text {
            color: rgba(255,255,255,0.75);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .testimonial-author-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: white;
        }

        .star-row {
            display: flex;
            gap: 3px;
            margin-bottom: 18px;
        }

        .star {
            color: #FBBF24;
            font-size: 14px;
        }

        /* =================== STATS =================== */
        .stats-section {
            background: #0A0A0A;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 60px 0;
        }

        .stat-divider {
            width: 1px;
            height: 60px;
            background: rgba(255,255,255,0.1);
        }

        /* =================== FEATURES =================== */
        .features-section {
            background: #F8F8F8;
            padding: 100px 0;
        }

        .feature-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: #EEF0FF;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            color: #4F46E5;
            margin-bottom: 20px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 56px;
        }

        .feature-card {
            background: white;
            border: 1px solid #EBEBEB;
            border-radius: 24px;
            padding: 36px 32px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 20px 60px rgba(0,0,0,0.07);
            transform: translateY(-4px);
        }

        .feature-card.highlight {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
            border-color: transparent;
            color: white;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 22px;
        }

        .feature-card:not(.highlight) .feature-icon {
            background: #F3F4FF;
        }

        .feature-card.highlight .feature-icon {
            background: rgba(255,255,255,0.15);
        }

        .feature-card.highlight .feature-tag-mini {
            background: rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9);
        }

        .feature-tag-mini {
            display: inline-block;
            padding: 3px 10px;
            background: #EEF0FF;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
            color: #4F46E5;
            margin-bottom: 14px;
        }

        /* =================== CTA =================== */
        .cta-section {
            background: #F8F8F8;
            padding: 0 0 100px;
        }

        .cta-inner {
            background: #0A0A0A;
            border-radius: 40px;
            padding: 80px 60px;
            position: relative;
            overflow: hidden;
        }

        .cta-inner::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(99,102,241,0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
        }

        .cta-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 99px;
            font-size: 12px;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            margin-bottom: 28px;
        }

        .cta-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: white;
            color: #0A0A0A;
            padding: 14px 32px;
            border-radius: 99px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .cta-btn-primary:hover {
            background: #F0F0F0;
            transform: translateY(-2px);
        }

        .cta-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: rgba(255,255,255,0.7);
            padding: 14px 32px;
            border-radius: 99px;
            font-weight: 500;
            font-size: 15px;
            border: 1px solid rgba(255,255,255,0.2);
            text-decoration: none;
            transition: border-color 0.2s ease;
        }

        .cta-btn-secondary:hover {
            border-color: rgba(255,255,255,0.4);
            color: white;
        }

        .floating-card {
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 20px 24px;
        }

        /* =================== FOOTER =================== */
        .footer-section {
            background: #0A0A0A;
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 80px 0 40px;
        }

        .footer-logo-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #6366F1;
            display: inline-block;
            margin-right: 8px;
        }

        .footer-link {
            color: rgba(255,255,255,0.45);
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-link:hover { color: rgba(255,255,255,0.85); }

        .footer-subscribe-input {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px 0 0 12px;
            padding: 11px 18px;
            font-size: 13px;
            color: white;
            outline: none;
            flex: 1;
        }

        .footer-subscribe-input::placeholder { color: rgba(255,255,255,0.3); }

        .footer-subscribe-btn {
            background: #6366F1;
            color: white;
            border: none;
            padding: 11px 22px;
            border-radius: 0 12px 12px 0;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .footer-subscribe-btn:hover { background: #4F46E5; }

        .footer-social {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 15px;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
        }

        .footer-social:hover {
            border-color: rgba(255,255,255,0.3);
            color: white;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.08);
            margin: 48px 0 32px;
        }

        @media (max-width: 768px) {
            .testimonial-cards { grid-template-columns: 1fr; }
            .feature-grid { grid-template-columns: 1fr; }
            .cta-inner { padding: 48px 28px; }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .testimonial-cards { grid-template-columns: repeat(2, 1fr); }
            .feature-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <!-- ===== NAVBAR PLACEHOLDER ===== -->
    <!-- <x-navbar></x-navbar> -->

    <!-- ===== HERO (TIDAK DIUBAH) ===== -->
    <section class="relative">
        <div class="floating-line w-[400px] h-[400px] top-24 right-20"></div>
        <div class="floating-line w-[300px] h-[300px] bottom-0 left-[45%]"></div>
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-xs font-semibold mb-6">#1 WEBSITE KAS KELAS</div>
                    <h1 class="hero-text text-5xl lg:text-7xl font-bold text-gray-900 mb-6" style="font-family: 'Poppins', sans-serif;">
                        Kelola <span class="font-['Playfair_Display'] italic font-medium">Kas Kelas</span> <br>
                        Jadi Lebih <span class="font-['Playfair_Display'] italic font-medium underline underline-offset-8 decoration-1">Mudah</span>
                    </h1>
                    <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-xl">Platform modern untuk mengatur pemasukan dan pengeluaran kas kelas secara transparan, cepat, dan efisien.</p>
                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <div class="flex items-center bg-white rounded-full px-5 py-3 shadow-sm border border-gray-200 w-full max-w-md">
                            <input type="text" placeholder="Masukkan email..." class="w-full outline-none text-sm bg-transparent">
                            <a href="/login"><button class="bg-black text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-gray-800 transition">Get Started</button></a>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 mb-4">Trusted by</p>
                        <div class="flex items-center gap-8 text-2xl font-bold text-gray-300">
                            <span>Google</span><span>Meta</span><span>Apple</span>
                        </div>
                    </div>
                </div>
                <div class="relative flex justify-center">
                    <div class="bg-black rounded-[45px] p-3 shadow-2xl w-[320px] relative z-10">
                        <div class="bg-white rounded-[35px] overflow-hidden min-h-[620px] p-5">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <p class="text-xs text-gray-400">Welcome back</p>
                                    <h2 class="font-bold" style="font-family:'Poppins',sans-serif;">Kasku</h2>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl p-6 text-white mb-8">
                                <p class="text-sm opacity-80 mb-4">Total Kas</p>
                                <h1 class="text-3xl font-bold mb-8" style="font-family:'Poppins',sans-serif;">Rp 5.250.000</h1>
                                <div class="flex items-center justify-between text-sm opacity-80"><span>2026</span><span>KAS KELAS</span></div>
                            </div>
                            <div class="grid grid-cols-4 gap-4 mb-8">
                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 mx-auto mb-2 flex items-center justify-center">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                                    </div>
                                    <p class="text-xs">Bayar</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-pink-100 mx-auto mb-2 flex items-center justify-center">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#EC4899" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 6v6l4 2"/></svg>
                                    </div>
                                    <p class="text-xs">Kas</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-green-100 mx-auto mb-2 flex items-center justify-center">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22C55E" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                    </div>
                                    <p class="text-xs">Laporan</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 mx-auto mb-2 flex items-center justify-center">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#EAB308" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                                    </div>
                                    <p class="text-xs">More</p>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="font-bold text-lg" style="font-family:'Poppins',sans-serif;">Transactions</h3>
                                    <span class="text-xs text-gray-400">Today</span>
                                </div>
                                <div class="flex items-center justify-between mb-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                                        </div>
                                        <div><h4 class="font-semibold text-sm">Pembayaran Kas</h4><p class="text-xs text-gray-400">XI RPL 2</p></div>
                                    </div>
                                    <p class="font-semibold text-sm text-green-500">+25.000</p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                                        </div>
                                        <div><h4 class="font-semibold text-sm">Beli Peralatan</h4><p class="text-xs text-gray-400">Pengeluaran</p></div>
                                    </div>
                                    <p class="font-semibold text-sm text-red-500">-50.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS (TIDAK DIUBAH) ===== -->
    <section class="py-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-20">
                <p class="text-sm text-gray-400 mb-3">— PROCESS</p>
                <h2 class="text-4xl font-bold text-gray-900" style="font-family:'Poppins',sans-serif;">How it works</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">1</div>
                    <h3 class="text-xl font-bold mb-4" style="font-family:'Poppins',sans-serif;">Register</h3>
                    <p class="text-gray-500 leading-relaxed">Daftarkan akun kelasmu dan mulai kelola keuangan dengan mudah.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">2</div>
                    <h3 class="text-xl font-bold mb-4" style="font-family:'Poppins',sans-serif;">Input Kas</h3>
                    <p class="text-gray-500 leading-relaxed">Tambahkan pemasukan dan pengeluaran kas secara real-time.</p>
                </div>
                <div class="text-center">
                    <div class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center mx-auto mb-6 font-bold">3</div>
                    <h3 class="text-xl font-bold mb-4" style="font-family:'Poppins',sans-serif;">Monitor</h3>
                    <p class="text-gray-500 leading-relaxed">Pantau seluruh transaksi dan laporan kas dengan transparan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================== -->
    <!-- ========================= BAGIAN YANG DIUBAH ======================== -->
    <!-- ===================================================================== -->

    <!-- ===== TESTIMONIALS (DARK, MODERN) ===== -->
    <section class="testimonial-section">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-4">
                <div class="testimonial-label" style="display:inline-flex;">TESTIMONIALS</div>
            </div>
            <div class="text-center">
                <h2 class="text-4xl lg:text-5xl font-bold text-white mb-5" style="font-family:'Poppins',sans-serif; line-height:1.15;">
                    Dipercaya ribuan<br>
                    <span style="background: linear-gradient(90deg, #818CF8, #A78BFA); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">bendahara kelas</span>
                </h2>
                <p style="color:rgba(255,255,255,0.45); font-size:16px; max-width:480px; margin:0 auto;">
                    Lihat apa yang mereka katakan tentang pengalaman menggunakan Kasku.
                </p>
            </div>

            <div class="testimonial-cards">

                <!-- Card 1 -->
                <div class="testimonial-card featured">
                    <div class="star-row">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    </div>
                    <div class="quote-mark">"</div>
                    <p class="testimonial-text">
                        Kasku benar-benar mengubah cara kami mengelola kas kelas. Semua transaksi tercatat otomatis, laporan tinggal unduh. Tidak perlu lagi ribet tulis manual di buku.
                    </p>
                    <div style="display:flex; align-items:center; gap:12px; border-top:1px solid rgba(255,255,255,0.08); padding-top:20px;">
                        <div class="testimonial-author-avatar" style="background: linear-gradient(135deg,#6366F1,#8B5CF6);">IN</div>
                        <div>
                            <p style="color:white; font-weight:600; font-size:14px; margin:0;">Indah Nraisyh</p>
                            <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:0;">Bendahara · XI RPL 2</p>
                        </div>
                        <div style="margin-left:auto; background:rgba(99,102,241,0.15); padding:4px 12px; border-radius:99px; border:1px solid rgba(99,102,241,0.3);">
                            <span style="color:#818CF8; font-size:11px; font-weight:600;">VERIFIED</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="testimonial-card">
                    <div class="star-row">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    </div>
                    <div class="quote-mark">"</div>
                    <p class="testimonial-text">
                        Transparansi keuangan kelas kami meningkat drastis. Semua siswa bisa lihat pemasukan dan pengeluaran kapan saja. Kepercayaan jadi lebih terjaga.
                    </p>
                    <div style="display:flex; align-items:center; gap:12px; border-top:1px solid rgba(255,255,255,0.08); padding-top:20px;">
                        <div class="testimonial-author-avatar" style="background: linear-gradient(135deg,#059669,#0D9488);">AR</div>
                        <div>
                            <p style="color:white; font-weight:600; font-size:14px; margin:0;">Arif Ramadhan</p>
                            <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:0;">Ketua Kelas · XII IPA 1</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="testimonial-card">
                    <div class="star-row">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
                    </div>
                    <div class="quote-mark">"</div>
                    <p class="testimonial-text">
                        Fitur laporan PDF-nya sangat membantu saat rapat dengan wali kelas. Tampilannya profesional, data lengkap, guru pun terkesan dengan pengelolaan kami.
                    </p>
                    <div style="display:flex; align-items:center; gap:12px; border-top:1px solid rgba(255,255,255,0.08); padding-top:20px;">
                        <div class="testimonial-author-avatar" style="background: linear-gradient(135deg,#DC2626,#DB2777);">SP</div>
                        <div>
                            <p style="color:white; font-weight:600; font-size:14px; margin:0;">Sari Putri</p>
                            <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:0;">Bendahara · X TKJ 3</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== STATS BAR ===== -->
    <section class="stats-section">
        <div class="max-w-6xl mx-auto px-6">
            <div style="display:flex; align-items:center; justify-content:center; gap:48px; flex-wrap:wrap;">

                <div style="text-align:center;">
                    <p style="font-size:36px; font-weight:700; color:white; font-family:'Poppins',sans-serif; margin:0; line-height:1.1;">5.200+</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:6px 0 0;">Kelas Aktif</p>
                </div>

                <div class="stat-divider hidden md:block"></div>

                <div style="text-align:center;">
                    <p style="font-size:36px; font-weight:700; color:white; font-family:'Poppins',sans-serif; margin:0; line-height:1.1;">Rp 48M+</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:6px 0 0;">Kas Dikelola</p>
                </div>

                <div class="stat-divider hidden md:block"></div>

                <div style="text-align:center;">
                    <p style="font-size:36px; font-weight:700; color:white; font-family:'Poppins',sans-serif; margin:0; line-height:1.1;">98%</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:6px 0 0;">Kepuasan Pengguna</p>
                </div>

                <div class="stat-divider hidden md:block"></div>

                <div style="text-align:center;">
                    <p style="font-size:36px; font-weight:700; color:white; font-family:'Poppins',sans-serif; margin:0; line-height:1.1;">340+</p>
                    <p style="color:rgba(255,255,255,0.4); font-size:13px; margin:6px 0 0;">Sekolah Bergabung</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== FEATURES ===== -->
    <section class="features-section">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center">
                <div class="feature-tag">✦ Fitur Unggulan</div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-5" style="font-family:'Poppins',sans-serif; line-height:1.15;">
                    Semua yang kamu butuhkan<br>ada di sini
                </h2>
                <p style="color:#6B7280; font-size:16px; max-width:480px; margin:0 auto;">
                    Dirancang khusus untuk kebutuhan kas kelas — simple, cepat, dan dapat diandalkan.
                </p>
            </div>

            <div class="feature-grid">

                <!-- Highlighted card -->
                <div class="feature-card highlight" style="grid-row: span 2;">
                    <div class="feature-tag-mini">Andalan</div>
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.9)" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:700; color:white; margin:0 0 14px;">Dashboard Real-time</h3>
                    <p style="color:rgba(255,255,255,0.7); line-height:1.7; font-size:15px; margin:0 0 28px;">
                        Pantau saldo, pemasukan, dan pengeluaran kas kelas secara langsung. Grafik otomatis terupdate setiap ada transaksi baru masuk.
                    </p>
                    <div style="background:rgba(255,255,255,0.08); border-radius:16px; padding:20px;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                            <span style="color:rgba(255,255,255,0.5); font-size:12px;">Saldo Bulan Ini</span>
                            <span style="color:#A7F3D0; font-size:12px; font-weight:600;">+12.4%</span>
                        </div>
                        <p style="color:white; font-size:26px; font-weight:700; font-family:'Poppins',sans-serif; margin:0 0 14px;">Rp 5.250.000</p>
                        <div style="display:flex; gap:4px; align-items:flex-end; height:40px;">
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:60%;"></div>
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:80%;"></div>
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:45%;"></div>
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:90%;"></div>
                            <div style="flex:1; background:white; border-radius:3px; height:100%;"></div>
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:70%;"></div>
                            <div style="flex:1; background:rgba(255,255,255,0.15); border-radius:3px; height:55%;"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="feature-card">
                    <div class="feature-tag-mini" style="background:#FEF3C7; color:#D97706;">Populer</div>
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#4F46E5" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#111; margin:0 0 10px;">Absensi Pembayaran</h3>
                    <p style="color:#6B7280; line-height:1.7; font-size:14px; margin:0;">
                        Lacak siapa saja yang sudah dan belum membayar kas. Notifikasi otomatis dikirim ke siswa yang menunggak.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card">
                    <div class="feature-tag-mini" style="background:#DCFCE7; color:#16A34A;">Baru</div>
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#4F46E5" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#111; margin:0 0 10px;">Laporan PDF Otomatis</h3>
                    <p style="color:#6B7280; line-height:1.7; font-size:14px; margin:0;">
                        Generate laporan keuangan bulanan dalam format PDF profesional dengan satu klik — siap diserahkan ke wali kelas.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card" style="grid-column: span 1;">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#4F46E5" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#111; margin:0 0 10px;">Akses Transparan</h3>
                    <p style="color:#6B7280; line-height:1.7; font-size:14px; margin:0;">
                        Seluruh anggota kelas bisa melihat saldo dan riwayat transaksi. Bendahara tetap yang bisa input dan kelola data.
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="feature-card" style="grid-column: span 1;">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#4F46E5" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:700; color:#111; margin:0 0 10px;">Multi-Kelas</h3>
                    <p style="color:#6B7280; line-height:1.7; font-size:14px; margin:0;">
                        Satu akun untuk mengelola beberapa kelas sekaligus. Cocok untuk OSIS atau pengurus yang pegang lebih dari satu kelas.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="cta-section">
        <div class="max-w-6xl mx-auto px-6">
            <div class="cta-inner">
                <div class="cta-grid-overlay"></div>

                <div style="position:relative; z-index:1; display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">

                    <!-- Left -->
                    <div>
                        <div class="cta-badge">
                            <span style="width:6px;height:6px;border-radius:50%;background:#6366F1;display:inline-block;"></span>
                            Gratis untuk semua kelas
                        </div>
                        <h2 style="font-family:'Poppins',sans-serif; font-size:40px; font-weight:700; color:white; line-height:1.15; margin:0 0 18px;">
                            Siap membawa kas kelasmu ke level berikutnya?
                        </h2>
                        <p style="color:rgba(255,255,255,0.5); font-size:16px; line-height:1.7; margin:0 0 36px;">
                            Bergabung dengan ribuan kelas yang sudah mengelola keuangan mereka dengan lebih modern dan transparan bersama Kasku.
                        </p>
                        <div style="display:flex; gap:14px; flex-wrap:wrap;">
                            <a href="/register" class="cta-btn-primary">
                                Mulai Gratis Sekarang
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="/demo" class="cta-btn-secondary">
                                Lihat Demo
                            </a>
                        </div>
                    </div>

                    <!-- Right — floating mini cards -->
                    <div style="display:flex; flex-direction:column; gap:16px;">

                        <div class="floating-card" style="display:flex;align-items:center;gap:16px;">
                            <div style="width:44px;height:44px;border-radius:12px;background:rgba(99,102,241,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#818CF8" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p style="color:white;font-weight:600;font-size:14px;margin:0;">Setup dalam 2 menit</p>
                                <p style="color:rgba(255,255,255,0.4);font-size:13px;margin:0;">Tidak perlu konfigurasi rumit</p>
                            </div>
                        </div>

                        <div class="floating-card" style="display:flex;align-items:center;gap:16px;">
                            <div style="width:44px;height:44px;border-radius:12px;background:rgba(16,185,129,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#34D399" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <p style="color:white;font-weight:600;font-size:14px;margin:0;">Data aman & terenkripsi</p>
                                <p style="color:rgba(255,255,255,0.4);font-size:13px;margin:0;">Keamanan tingkat enterprise</p>
                            </div>
                        </div>

                        <div class="floating-card" style="display:flex;align-items:center;gap:16px;">
                            <div style="width:44px;height:44px;border-radius:12px;background:rgba(251,191,36,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#FCD34D" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div>
                                <p style="color:white;font-weight:600;font-size:14px;margin:0;">Dukungan 24/7</p>
                                <p style="color:rgba(255,255,255,0.4);font-size:13px;margin:0;">Tim siap membantu kapan saja</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer-section">
        <div class="max-w-7xl mx-auto px-6">

            <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:48px; flex-wrap:wrap;">

                <!-- Brand -->
                <div>
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:18px;">
                        <span class="footer-logo-dot"></span>
                        <h2 style="font-family:'Poppins',sans-serif;font-size:22px;font-weight:700;color:white;margin:0;">Kasku</h2>
                    </div>
                    <p style="color:rgba(255,255,255,0.4);font-size:14px;line-height:1.7;max-width:260px;margin:0 0 24px;">
                        Platform modern untuk manajemen kas kelas yang transparan, efisien, dan mudah digunakan.
                    </p>
                    <div style="display:flex;gap:8px;">
                        <a href="#" class="footer-social" aria-label="Instagram">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                        <a href="#" class="footer-social" aria-label="Twitter">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                        </a>
                        <a href="#" class="footer-social" aria-label="GitHub">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Menu -->
                <div>
                    <h3 style="font-family:'Poppins',sans-serif;color:white;font-size:14px;font-weight:600;margin:0 0 20px;letter-spacing:0.05em;text-transform:uppercase;">Menu</h3>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
                        <li><a href="#" class="footer-link">Beranda</a></li>
                        <li><a href="#" class="footer-link">Fitur</a></li>
                        <li><a href="#" class="footer-link">Cara Kerja</a></li>
                        <li><a href="#" class="footer-link">Harga</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 style="font-family:'Poppins',sans-serif;color:white;font-size:14px;font-weight:600;margin:0 0 20px;letter-spacing:0.05em;text-transform:uppercase;">Perusahaan</h3>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
                        <li><a href="#" class="footer-link">Tentang Kami</a></li>
                        <li><a href="#" class="footer-link">Blog</a></li>
                        <li><a href="#" class="footer-link">Karir</a></li>
                        <li><a href="#" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Subscribe -->
                <div>
                    <h3 style="font-family:'Poppins',sans-serif;color:white;font-size:14px;font-weight:600;margin:0 0 10px;letter-spacing:0.05em;text-transform:uppercase;">Newsletter</h3>
                    <p style="color:rgba(255,255,255,0.4);font-size:13px;margin:0 0 16px;line-height:1.6;">Dapatkan tips pengelolaan kas dan update fitur terbaru.</p>
                    <div style="display:flex;">
                        <input type="email" placeholder="email@kamu.com" class="footer-subscribe-input">
                        <button class="footer-subscribe-btn">Daftar</button>
                    </div>
                    <p style="color:rgba(255,255,255,0.25);font-size:12px;margin:10px 0 0;">Tidak ada spam. Berhenti kapan saja.</p>
                </div>

            </div>

            <hr class="footer-divider">

            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
                <p style="color:rgba(255,255,255,0.25);font-size:13px;margin:0;">© 2026 Kasku. Semua hak dilindungi.</p>
                <div style="display:flex;gap:24px;">
                    <a href="#" class="footer-link" style="font-size:13px;">Kebijakan Privasi</a>
                    <a href="#" class="footer-link" style="font-size:13px;">Syarat & Ketentuan</a>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>