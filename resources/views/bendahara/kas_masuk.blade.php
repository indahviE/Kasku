<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Masuk - KASKU Online</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            overflow: hidden;
        }

        body::-webkit-scrollbar,
        main::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar{
            display:none;
        }

        .sidebar {
            background: #0a0f1d;
            overflow: hidden;
        }

        .sidebar-item {
            transition: all .25s ease;
            color: #64748b;
            font-size: 14px;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-item:not(.sidebar-active):hover {
            background: rgba(255, 255, 255, .02);
            transform: translateX(4px);
            color: #94a3b8;
        }

        .sidebar-active {
            background: rgba(255,255,255,.05);
            color: #fff;
            font-weight: 500;
            position: relative;
        }

        .sidebar-active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 4px;
            background-color: #2dd4bf;
            border-radius: 0 4px 4px 0;
        }

        /* CARD STYLE DARI LAPORAN */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px 22px;
            border: 1px solid #e2e8f0;
            transition: .2s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,.06);
        }

        .stat-card .arrow-btn {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex; align-items: center; justify-content: center;
            color: #64748b;
            transition: .2s;
            cursor: pointer;
            border: none;
        }

        .stat-card .arrow-btn:hover {
            background: #e2e8f0;
        }

        .badge-green { background: #dcfce7; color: #16a34a; }
        .badge-red   { background: #fee2e2; color: #dc2626; }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all .25s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div class="flex h-screen overflow-hidden">

    <aside class="sidebar w-[250px] fixed h-screen text-white flex flex-col justify-between z-10">
        <div>
            <div class="px-6 py-6 flex items-center gap-4 border-b border-white/5">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-white text-2xl shadow-lg shadow-teal-500/20">
                    <iconify-icon icon="solar:wallet-bold"></iconify-icon>
                </div>
                <div>
                    <h1 class="text-[18px] font-bold tracking-wide text-white leading-none">KASKU</h1>
                    <p class="text-[11px] text-slate-500 font-medium mt-1 flex items-center gap-1">Online</p>
                </div>
            </div>

            <div class="px-4 mt-6">
                <nav class="space-y-1">
                    <a href="{{ route('bendahara.dashboard') }}" class="sidebar-item">
                        <iconify-icon icon="solar:home-2-bold" class="text-[18px]"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('bendahara.kas_masuk') }}" class="sidebar-item sidebar-active">
                        <iconify-icon icon="solar:wallet-money-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Masuk</span>
                    </a>
                    <a href="{{ route('bendahara.kas_keluar') }}" class="sidebar-item">
                        <iconify-icon icon="solar:card-send-bold" class="text-[18px]"></iconify-icon>
                        <span>Kas Keluar</span>
                    </a>
                    <a href="{{ route('bendahara.transaksi') }}" class="sidebar-item">
                        <iconify-icon icon="solar:clipboard-list-bold" class="text-[18px]"></iconify-icon>
                        <span>Transaksi</span>
                    </a>
                    <a href="{{ route('bendahara.tagihan') }}" class="sidebar-item">
                        <iconify-icon icon="solar:bill-list-bold" class="text-[18px]"></iconify-icon>
                        <span>Tagihan</span>
                    </a>
                    <a href="{{ route('bendahara.laporan') }}" class="sidebar-item">
                        <iconify-icon icon="solar:chart-bold" class="text-[18px]"></iconify-icon>
                        <span>Laporan</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="p-4 border-t border-white/5">
            <a href="{{ route('bendahara.pengaturan') }}" class="sidebar-item">
                <iconify-icon icon="solar:settings-bold" class="text-[18px]"></iconify-icon>
                <span>Pengaturan</span>
            </a>
        </div>
    </aside>

    <main class="ml-[250px] flex-1 overflow-y-auto h-screen flex flex-col">

        <div class="h-[72px] bg-white border-b border-slate-200 px-8 flex items-center justify-between shadow-sm sticky top-0 z-20 flex-shrink-0">
            <div>
                <p class="text-[12px] text-slate-400 font-medium">Pages / Kas Masuk</p>
                <h1 class="text-[20px] font-bold text-slate-800 mt-1">Pencatatan Kas Masuk</h1>
            </div>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition relative">
                    <iconify-icon icon="solar:bell-bold" class="text-[18px] text-slate-700"></iconify-icon>
                    <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></div>
                </button>

                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3">
                        <div class="text-right">
                            <h1 class="text-[13px] font-bold text-slate-800">Nafisah Adelia Putri</h1>
                            <p class="text-[11px] text-slate-400">Bendahara</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center text-white font-bold">M</div>
                    </button>

                    <div id="dropdownMenu" class="dropdown-menu absolute right-0 top-14 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                        <a href="{{ route('bendahara.profile') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:user-linear"></iconify-icon> Profile
                        </a>
                        <a href="{{ route('bendahara.pengaturan') }}" class="flex items-center gap-3 px-5 py-4 text-slate-700 hover:bg-slate-50 transition">
                            <iconify-icon icon="solar:settings-linear"></iconify-icon> Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 transition">
                                <iconify-icon icon="solar:logout-2-linear"></iconify-icon> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-7 space-y-6 flex-1">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kas Masuk</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Kelola dan pantau semua aliran dana masuk iuran kelas.</p>
                </div>
                <button onclick="openCreateModal()" class="h-11 px-5 bg-teal-500 hover:bg-teal-600 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 shadow-md shadow-teal-500/20 active:scale-[0.98] transition">
                    <iconify-icon icon="solar:plus-bold" class="text-base"></iconify-icon>
                    Tambah Kas Masuk
                </button>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Total Masuk (Bulan Ini)</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($totalMasukBulanIni, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ $persenMasuk >= 0 ? 'badge-green' : 'bg-rose-50 text-rose-600' }}">
                            {{ $persenMasuk >= 0 ? '↑' : '↓' }} {{ number_format(abs($persenMasuk), 1, ',', '.') }}%
                        </span>
                        <span class="text-[11px] text-slate-400">vs bulan lalu</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Iuran Wajib</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($iuranWajib, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-[11px] text-slate-400">Total terakumulasi</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Denda / Lainnya</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">Rp {{ number_format($dendaLainnya, 0, ',', '.') }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-[11px] text-slate-400">Total terakumulasi</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-4">
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Frekuensi Log</p>
                        <button class="arrow-btn"><iconify-icon icon="solar:arrow-right-up-linear" class="text-[14px]"></iconify-icon></button>
                    </div>
                    <p class="text-[22px] font-bold text-slate-900">{{ $pembayaran->count() }} <span class="text-slate-400">Transaksi</span></p>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-[11px] text-slate-400">Total log tercatat</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-wrap items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-3 flex-1 min-w-[280px]">
                    <div class="relative flex-1 max-w-md">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><iconify-icon icon="solar:magnifer-linear" class="text-lg"></iconify-icon></span>
                        <input type="text" placeholder="Cari nama siswa, nomor induk atau kategori..." class="w-full h-11 pl-11 pr-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition font-medium text-slate-700">
                    </div>
                    <select class="h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 outline-none focus:bg-white transition cursor-pointer">
                        <option>Semua Kategori</option>
                        <option>Iuran Wajib Mingguan</option>
                        <option>Denda Lambat</option>
                        <option>Sumbangan / Sukarela</option>
                    </select>
                </div>
                <a href="{{ route('bendahara.kas_masuk.cetak') }}" target="_blank" class="h-11 px-4 border border-slate-200 hover:bg-slate-50 text-slate-600 font-bold rounded-xl text-sm transition flex items-center gap-2">
                    <iconify-icon icon="solar:printer-linear" class="text-lg"></iconify-icon> Cetak Laporan
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200">
                                <th class="px-6 py-4">Siswa / Pembayar</th>
                                <th class="px-6 py-4">Kategori Kas</th>
                                <th class="px-6 py-4">Tanggal Masuk</th>
                                <th class="px-6 py-4 text-right">Jumlah Nominal</th>
                                <th class="px-6 py-4 text-center">Bukti Pembayaran</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs text-slate-600 font-medium">
                            @forelse($pembayaran as $item)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-sm shadow-sm">{{ strtoupper(substr($item->siswa->name ?? 'U', 0, 2)) }}</div>
                                        <div>
                                            <span class="font-bold text-slate-800 block text-[13px]">{{ $item->siswa->name ?? 'User Tidak Dikenal' }}</span>
                                            <span class="text-[10px] text-slate-400 font-medium">{{ $item->siswa->email ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-lg bg-teal-50 text-teal-600 text-[10px] font-bold border border-teal-100">{{ $item->tagihan ? $item->tagihan->nama_tagihan : 'Kas Umum' }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-rizght font-extrabold text-emerald-500 text-sm">+ Rp {{ number_format($item->jml_bayar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                    @if($item->bukti_bayar)
                                        <button onclick="lihatBukti('{{ asset('storage/bukti_pembayaran/' . $item->bukti_bayar) }}')"
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 text-[10px] font-bold border border-blue-100 transition">
                                            <iconify-icon icon="solar:eye-linear" class="text-base"></iconify-icon>
                                            Lihat
                                        </button>
                                    @else
                                        <span class="text-slate-400 text-[10px]">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($item->status == 'lunas')
                                        <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold border border-emerald-100">Diterima</span>
                                    @elseif($item->status == 'pending')
                                        <span class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-bold border border-amber-100">Menunggu</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-600 text-[10px] font-bold border border-rose-100">Ditolak</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-lg bg-slate-50 text-slate-600 text-[10px] font-bold border border-slate-100">Belum</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1.5">
                                        @if($item->status == 'pending')
                                            <button onclick="verifikasiKas({{ $item->id }}, '{{ asset('storage/bukti_pembayaran/' . $item->bukti_bayar) }}')" title="Verifikasi" class="w-8 h-8 rounded-lg bg-sky-50 hover:bg-sky-100 text-sky-600 flex items-center justify-center transition"><iconify-icon icon="solar:check-circle-linear" class="text-base"></iconify-icon></button>
                                        @endif
                                        <button onclick="openEditModal({{ $item }})" title="Ubah" class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 flex items-center justify-center transition"><iconify-icon icon="solar:pen-linear" class="text-base"></iconify-icon></button>
                                        <button onclick="deleteKas({{ $item->id }})" title="Hapus" class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center transition"><iconify-icon icon="solar:trash-bin-trash-linear" class="text-base"></iconify-icon></button>
                                    </div>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('bendahara.kas_masuk.delete', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <form id="verifikasi-form-{{ $item->id }}" action="{{ route('bendahara.kas_masuk.verifikasi', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="status" id="verifikasi-status-{{ $item->id }}">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-slate-500">Belum ada data kas masuk</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

{{-- PAGINATION --}}
@if($pembayaran->hasPages())
<div class="p-4 border-t border-slate-200 flex items-center justify-between bg-slate-50/50">
    <p class="text-xs text-slate-400 font-medium">
        Menampilkan <span class="font-semibold text-slate-700">{{ $pembayaran->firstItem() }} - {{ $pembayaran->lastItem() }}</span>
        dari <span class="font-semibold text-slate-700">{{ $pembayaran->total() }}</span> data kas masuk
    </p>
    <div class="flex items-center gap-1">
        {{-- Tombol Previous --}}
        @if($pembayaran->onFirstPage())
            <button disabled class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-300 text-xs font-semibold opacity-50">‹</button>
        @else
            <a href="{{ $pembayaran->previousPageUrl() }}" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-100 text-xs font-semibold transition">‹</a>
        @endif

        {{-- Nomor Halaman --}}
        @for($i = 1; $i <= $pembayaran->lastPage(); $i++)
            @if($i == $pembayaran->currentPage())
                <button class="px-3 py-1.5 bg-teal-500 text-white rounded-lg text-xs font-bold shadow-sm shadow-teal-500/10">{{ $i }}</button>
            @else
                <a href="{{ $pembayaran->url($i) }}" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-100 text-xs font-semibold transition">{{ $i }}</a>
            @endif
        @endfor

        {{-- Tombol Next --}}
        @if($pembayaran->hasMorePages())
            <a href="{{ $pembayaran->nextPageUrl() }}" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-500 hover:bg-slate-100 text-xs font-semibold transition">›</a>
        @else
            <button disabled class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-300 text-xs font-semibold opacity-50">›</button>
        @endif
    </div>
</div>
@endif

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleDropdown() { document.getElementById('dropdownMenu').classList.toggle('show'); }
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) { document.getElementById('dropdownMenu').classList.remove('show'); }
    });

    function openCreateModal() {
        const createModal = document.getElementById('createModal');
        const createModalContent = document.getElementById('createModalContent');
        createModal.classList.remove('hidden');
        setTimeout(() => {
            createModalContent.classList.remove('scale-95', 'opacity-0');
            createModalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeCreateModal() {
        const createModal = document.getElementById('createModal');
        const createModalContent = document.getElementById('createModalContent');
        createModalContent.classList.remove('scale-100', 'opacity-100');
        createModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            createModal.classList.add('hidden');
        }, 300);
    }

    function openEditModal(data) {
        const editModal = document.getElementById('editModal');
        const editModalContent = document.getElementById('editModalContent');
        const editForm = document.getElementById('editForm');

        document.getElementById('edit_user_id').value = data.user_id;
        document.getElementById('edit_tagihan_id').value = data.tagihan_id || '';
        document.getElementById('edit_jml_bayar').value = parseFloat(data.jml_bayar);
        document.getElementById('edit_tanggal_bayar').value = data.tanggal_bayar;
        editForm.action = `/bendahara/kasMasuk/update/${data.id}`;

        editModal.classList.remove('hidden');
        setTimeout(() => {
            editModalContent.classList.remove('scale-95', 'opacity-0');
            editModalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeEditModal() {
        const editModal = document.getElementById('editModal');
        const editModalContent = document.getElementById('editModalContent');

        editModalContent.classList.remove('scale-100', 'opacity-100');
        editModalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            editModal.classList.add('hidden');
        }, 300);
    }

    // SweetAlert Delete
    function deleteKas(id) {
        Swal.fire({
            title: 'Hapus Kas Masuk?',
            text: "Data kas yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl text-sm font-bold',
                cancelButton: 'rounded-xl text-sm font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }

    function verifikasiKas(id, imageUrl) {
        Swal.fire({
            title: 'Verifikasi Pembayaran',
            text: 'Silakan cek bukti transfer berikut.',
            imageUrl: imageUrl,
            imageWidth: 400,
            imageAlt: 'Bukti Pembayaran',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Terima (Lunas)',
            denyButtonText: 'Tolak Pembayaran',
            cancelButtonText: 'Tutup',
            confirmButtonColor: '#10b981',
            denyButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl text-sm font-bold',
                denyButton: 'rounded-xl text-sm font-bold',
                cancelButton: 'rounded-xl text-sm font-bold',
                image: 'rounded-xl border border-slate-200'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('verifikasi-status-' + id).value = 'lunas';
                document.getElementById('verifikasi-form-' + id).submit();
            } else if (result.isDenied) {
                document.getElementById('verifikasi-status-' + id).value = 'ditolak';
                document.getElementById('verifikasi-form-' + id).submit();
            }
        });
    }
    // Lihat bukti pembayaran
function lihatBukti(imageUrl) {
    Swal.fire({
        title: 'Bukti Pembayaran',
        imageUrl: imageUrl,
        imageWidth: 400,
        imageAlt: 'Bukti Pembayaran Siswa',
        showConfirmButton: true,
        confirmButtonText: 'Tutup',
        confirmButtonColor: '#0E7C7B',
        customClass: {
            popup: 'rounded-2xl',
            confirmButton: 'rounded-xl text-sm font-bold',
            image: 'rounded-xl border border-slate-200'
        }
    });
}

    // SweetAlert Notifications
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000,
            customClass: { popup: 'rounded-2xl' }
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000,
            customClass: { popup: 'rounded-2xl' }
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memproses Data!',
            html: '{!! implode("<br>", $errors->all()) !!}',
            showConfirmButton: true,
            confirmButtonColor: '#ef4444',
            customClass: { popup: 'rounded-2xl', confirmButton: 'rounded-xl text-sm font-bold' }
        });
    @endif
</script>

<!-- Modal Tambah -->
<div id="createModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="createModalContent">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-slate-800">Tambah Kas Masuk</h3>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-red-500 transition"><iconify-icon icon="solar:close-circle-bold" class="text-2xl"></iconify-icon></button>
        </div>
        <form action="{{ route('bendahara.kas_masuk.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pilih Siswa</label>
                    <select name="user_id" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                        <option value="">Pilih Siswa...</option>
                        @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori Kas (Opsional)</label>
                    <select name="tagihan_id" class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                        <option value="">Pilih Tagihan / Umum...</option>
                        @foreach($tagihanList as $tagihan)
                            <option value="{{ $tagihan->id }}">{{ $tagihan->nama_tagihan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jumlah Bayar (Rp)</label>
                    <input type="number" name="jml_bayar" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition" placeholder="Contoh: 50000">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition" value="{{ date('Y-m-d') }}">
                </div>
                <input type="hidden" name="metode" value="tunai">
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeCreateModal()" class="px-5 py-2.5 rounded-xl font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition text-sm">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-teal-500 hover:bg-teal-600 shadow-md shadow-teal-500/20 transition text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="editModalContent">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-slate-800">Ubah Kas Masuk</h3>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-red-500 transition"><iconify-icon icon="solar:close-circle-bold" class="text-2xl"></iconify-icon></button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pilih Siswa</label>
                    <select name="user_id" id="edit_user_id" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                        <option value="">Pilih Siswa...</option>
                        @foreach($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori Kas (Opsional)</label>
                    <select name="tagihan_id" id="edit_tagihan_id" class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                        <option value="">Pilih Tagihan / Umum...</option>
                        @foreach($tagihanList as $tagihan)
                            <option value="{{ $tagihan->id }}">{{ $tagihan->nama_tagihan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jumlah Bayar (Rp)</label>
                    <input type="number" name="jml_bayar" id="edit_jml_bayar" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" id="edit_tanggal_bayar" required class="w-full h-11 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-teal-500 outline-none transition">
                </div>
                <input type="hidden" name="metode" value="tunai">
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition text-sm">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-teal-500 hover:bg-teal-600 shadow-md shadow-teal-500/20 transition text-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
