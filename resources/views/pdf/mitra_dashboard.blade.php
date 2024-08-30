<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mitra CSR Pemerintah Kabupaten Cirebon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        h1 {
            color: #1a5f7a;
            font-size: 22px;
            margin: 10px 0;
        }
        h2 {
            color: #1a5f7a;
            font-size: 18px;
            margin: 20px 0 10px;
        }
        .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #1a5f7a;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .page-number {
            text-align: right;
            font-size: 10px;
            color: #666;
            margin-top: 10px;
        }
        .summary-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #1a5f7a;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Kabupaten Cirebon" class="logo">
        <h1>PEMERINTAH KABUPATEN CIREBON</h1>
        <div class="subtitle">Dashboard Mitra Corporate Social Responsibility (CSR)</div>
    </div>

    <div class="summary-box">
        <div class="summary-title">Ringkasan Laporan</div>
        <p>Total Laporan: {{ $laporans->count() }}</p>
        <p>Total Realisasi: {{ App\Helpers\FormatHelperFull::formatRupiahFull($laporans->sum('realisasi')) }}</p>
    </div>

    <h2>Daftar Laporan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Laporan</th>
                <th>Realisasi</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
            <tr>
                <td>{{ $laporan->id }}</td>
                <td>{{ $laporan->judul_laporan }}</td>
                <td>{{ App\Helpers\FormatHelperFull::formatRupiahFull($laporan->realisasi) }}</td>
                <td>{{ $laporan->tanggal }}</td>
                <td>{{ $laporan->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Data Statistik</h2>
    
    <h2>Persentase Realisasi per Sektor</h2>
    <table>
        <thead>
            <tr>
                <th>Sektor</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chartData['categories'] as $index => $category)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $chartData['pieData'][$index] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Jumlah Laporan per Sektor</h2>
    <table>
        <thead>
            <tr>
                <th>Sektor</th>
                <th>Jumlah Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chartData['categories'] as $index => $category)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $chartData['dataJumlah'][$index] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini diterbitkan oleh Pemerintah Kabupaten Cirebon</p>
        <p>Alamat: Jl. Sunan Kalijaga No.7, Sumber, Kec. Sumber, Kabupaten Cirebon, Jawa Barat 45611</p>
        <p>Telepon: (0231) 321197 | Email: pemkab@cirebonkab.go.id</p>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Arial");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>