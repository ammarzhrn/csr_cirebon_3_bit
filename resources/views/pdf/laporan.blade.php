<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemerintah Kabupaten Cirebon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 150px; // Mengubah ukuran dari 100px menjadi 150px
            height: auto;
        }
        h1 {
            color: #1a5f7a;
            font-size: 24px;
            margin: 10px 0;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #1a5f7a;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Kabupaten Cirebon" class="logo">
        <h1>PEMERINTAH KABUPATEN CIREBON</h1>
        <div class="subtitle">Laporan Kegiatan Corporate Social Responsibility</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Kegiatan</th>
                <th>Lokasi</th>
                <th>Realisasi Anggaran</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $index => $laporan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->judul_laporan }}</td>
                    <td>{{ $laporan->proyek->lokasi ?? 'Tidak ada lokasi' }}</td>
                    <td>Rp {{ number_format($laporan->realisasi, 0, ',', '.') }}</td>
                    <td>{{ $laporan->proyek->tgl_awal ?? 'Belum ada tanggal' }}</td>
                    <td>{{ ucfirst($laporan->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini diterbitkan oleh Pemerintah Kabupaten Cirebon</p>
        <p>Alamat: Jl. Sunan Kalijaga No.7, Sumber, Kec. Sumber, Kabupaten Cirebon, Jawa Barat 45611</p>
        <p>Telepon: (0231) 321197 | Email: pemkab@cirebonkab.go.id</p>
    </div>
</body>
</html>
