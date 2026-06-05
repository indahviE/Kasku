<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Kas Masuk</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0 0 5px 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .status-lunas { color: #10b981; font-weight: bold; }
        .status-pending { color: #f59e0b; font-weight: bold; }
        .status-ditolak { color: #f43f5e; font-weight: bold; }
        .img-bukti { max-width: 60px; max-height: 60px; object-fit: contain; border: 1px solid #ccc; padding: 2px; }
        .no-print { display: none; }
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Kas Masuk</h1>
        <p>Aplikasi KASKU - Sistem Manajemen Kas Kelas</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Nama Siswa</th>
                <th width="15%">Keterangan</th>
                <th width="10%">Metode</th>
                <th width="10%">Status</th>
                <th class="text-center" width="10%">Bukti Bayar</th>
                <th class="text-right" width="15%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $totalMasuk = 0; @endphp
            @forelse($pembayaran as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}</td>
                <td>{{ $item->siswa->name ?? 'Anonim' }}</td>
                <td>
                    @if($item->tagihan)
                        {{ $item->tagihan->nama_tagihan }}
                    @else
                        Bayar Kas
                    @endif
                </td>
                <td style="text-transform: capitalize;">{{ $item->metode }}</td>
                <td>
                    @if($item->status == 'lunas')
                        <span class="status-lunas">Lunas</span>
                        @php $totalMasuk += $item->jml_bayar; @endphp
                    @elseif($item->status == 'pending')
                        <span class="status-pending">Menunggu</span>
                    @elseif($item->status == 'ditolak')
                        <span class="status-ditolak">Ditolak</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($item->bukti_bayar)
                        <img src="{{ asset('storage/bukti_pembayaran/' . $item->bukti_bayar) }}" class="img-bukti" alt="Bukti">
                    @else
                        -
                    @endif
                </td>
                <td class="text-right">Rp {{ number_format($item->jml_bayar, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data kas masuk.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="text-right">Total Kas Masuk (Lunas)</th>
                <th class="text-right">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>