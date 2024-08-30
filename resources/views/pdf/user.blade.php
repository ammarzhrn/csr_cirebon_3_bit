<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
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
            width: 100px;
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
        <div class="subtitle">Daftar Pengguna Sistem</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Mitra</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summaries as $index => $summary)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $summary->nama }}</td>
                <td>{{ $summary->nama_mitra }}</td>
                <td>{{ $summary->email }}</td>
                <td>{{ $summary->no_telp }}</td>
                <td>{{ $summary->alamat }}</td>
                <td>{{ ucfirst($summary->user->level) }}</td>
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