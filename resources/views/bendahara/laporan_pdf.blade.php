<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Kasku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2dd4bf;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #0f172a;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #64748b;
        }
        .summary {
            width: 100%;
            margin-bottom: 20px;
        }
        .summary td {
            width: 33.33%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            text-align: center;
            background: #f8fafc;
        }
        .summary td strong {
            display: block;
            font-size: 14px;
            color: #0f172a;
            margin-bottom: 5px;
        }
        .summary td span {
            font-size: 18px;
            font-weight: bold;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data th, table.data td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
        }
        table.data th {
            background-color: #f1f5f9;
            color: #475569;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        .text-green { color: #16a34a; }
        .text-red { color: #dc2626; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Keuangan Kas Kelas</h1>
        <p>Aplikasi KASKU - Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>

    <table class="summary">
        <tr>
            <td>
                <strong>Total Pemasukan</strong>
                <span class="text-green">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</span>
            </td>
            <td>
                <strong>Total Pengeluaran</strong>
                <span class="text-red">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</span>
            </td>
            <td>
                <strong>Saldo Akhir</strong>
                <span>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>

    <h3 style="margin-bottom: 10px; color:#0f172a;">Rincian Transaksi (Masuk & Keluar)</h3>
    <table class="data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Deskripsi / Nama</th>
                <th>Kategori</th>
                <th>Jenis</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $semuaTransaksi = collect();
                
                foreach($pembayaran as $p) {
                    $semuaTransaksi->push([
                        'tanggal' => $p->tanggal_bayar,
                        'deskripsi' => ($p->siswa->name ?? 'User') . ' - Membayar Kas',
                        'kategori' => $p->tagihan->nama_tagihan ?? 'Kas Masuk',
                        'jenis' => 'Masuk',
                        'nominal' => $p->jml_bayar,
                    ]);
                }

                foreach($pengeluaran as $p) {
                    $semuaTransaksi->push([
                        'tanggal' => $p->tanggal,
                        'deskripsi' => $p->keterangan,
                        'kategori' => 'Umum',
                        'jenis' => 'Keluar',
                        'nominal' => $p->nominal,
                    ]);
                }

                $semuaTransaksi = $semuaTransaksi->sortByDesc('tanggal');
            @endphp

            @forelse($semuaTransaksi as $trx)
            <tr>
                <td>{{ \Carbon\Carbon::parse($trx['tanggal'])->format('d M Y') }}</td>
                <td>{{ $trx['deskripsi'] }}</td>
                <td>{{ $trx['kategori'] }}</td>
                <td>
                    @if($trx['jenis'] == 'Masuk')
                        <span class="text-green">Masuk</span>
                    @else
                        <span class="text-red">Keluar</span>
                    @endif
                </td>
                <td class="text-right">
                    @if($trx['jenis'] == 'Masuk')
                        <span class="text-green">+ Rp {{ number_format($trx['nominal'], 0, ',', '.') }}</span>
                    @else
                        <span class="text-red">- Rp {{ number_format($trx['nominal'], 0, ',', '.') }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>