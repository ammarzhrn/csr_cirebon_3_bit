<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek CSR Pemerintah Kabupaten Cirebon</title>
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
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Kabupaten Cirebon" class="logo">
        <h1>PEMERINTAH KABUPATEN CIREBON</h1>
        <div class="subtitle">Daftar Proyek Corporate Social Responsibility (CSR)</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Lokasi</th>
                <th>Jumlah Mitra</th>
                <th>Tgl Mulai</th>
                <th>Tgl Akhir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyeks as $index => $proyek)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $proyek->nama_proyek }}</td>
                    <td>Kec. {{ $proyek->lokasi }}</td>
                    <td>{{ $proyek->jumlah_mitra ?? 'N/A' }}</td>
                    <td>{{ $proyek->tgl_awal ? date('d/m/Y', strtotime($proyek->tgl_awal)) : 'N/A' }}</td>
                    <td>{{ $proyek->tgl_akhir ? date('d/m/Y', strtotime($proyek->tgl_akhir)) : 'N/A' }}</td>
                    <td>{{ ucfirst($proyek->status) }}</td>
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