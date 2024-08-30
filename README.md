# 🚀 Website CSR Pemerintah Kabupaten Cirebon

Proyek ini merupakan hasil karya tim 3-bit dalam rangka mengikuti lomba pembuatan website CSR (Corporate Social Responsibility) untuk Pemerintah Kabupaten Cirebon yang diselenggarakan oleh SMK Dev. Website ini bertujuan untuk memfasilitasi dan mempromosikan program-program CSR di Kabupaten Cirebon, meningkatkan transparansi, dan mendorong partisipasi masyarakat dalam pembangunan daerah.

## 📋 Daftar Isi
- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Prasyarat](#️-prasyarat)
- [🚀 Instalasi](#-instalasi)
- [💻 Penggunaan](#-penggunaan)
- [⚙️ Konfigurasi](#️-konfigurasi)
- [🤝 Kontribusi](#-kontribusi)
- [📄 Lisensi](#-lisensi)
- [👨‍💻 Kreator](#-kreator)

## ✨ Fitur Utama

- 🌟 Dashboard Interaktif: Visualisasi data CSR yang mudah dipahami
- 🚀 Manajemen Program CSR: Sistem untuk mengelola dan melacak program-program CSR
- 💡 Forum Diskusi: Wadah interaksi antara pemerintah, perusahaan, dan masyarakat
- 📊 Laporan Transparan: Penyajian laporan CSR yang transparan dan mudah diakses

## 🛠️ Prasyarat

Sebelum memulai, pastikan sistem Anda memenuhi prasyarat berikut:

- [Node.js](https://nodejs.org/) (versi 14.x atau lebih baru)
- [npm](https://www.npmjs.com/) (biasanya terinstal bersama Node.js)
- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [Apache](https://httpd.apache.org/) (pastikan sudah terkonfigurasi dan berjalan)
- [ApexCharts](https://apexcharts.com/) (akan diinstal melalui npm)

## 🚀 Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda:

1. Clone repositori ini:
   ```bash
   git clone https://github.com/username/csr-cirebon.git
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd csr-cirebon
   ```

3. Instal dependensi PHP menggunakan Composer:
   ```bash
   composer install
   ```

4. Instal dependensi JavaScript menggunakan npm:
   ```bash
   npm install
   ```

5. Instal ApexCharts jika belum terinstal:
   ```bash
   npm install apexcharts
   ```

6. Salin file konfigurasi:
   ```bash
   cp .env.example .env
   ```

7. Edit file `.env` dan sesuaikan dengan pengaturan lokal Anda.

8. Pastikan Apache sudah berjalan dan konfigurasi virtual host sudah benar.

## 💻 Penggunaan

Untuk menjalankan proyek dalam mode pengembangan:

```storage link
php artisan storage:link
```

```inisialisasi php
php artisan ser
```

```menjalankan npm
npm run dev
```

Buka [http://localhost:3000](http://localhost:3000) di browser Anda untuk melihat aplikasi berjalan.

## ⚙️ Konfigurasi

Proyek ini menggunakan file `.env` untuk konfigurasi. Berikut adalah beberapa variabel penting yang perlu Anda atur:

- `API_KEY`: Kunci API untuk layanan eksternal
- `DATABASE_URL`: URL koneksi database
- `PORT`: Port server (default: 3000)

Untuk informasi lebih lanjut tentang konfigurasi, lihat [dokumentasi konfigurasi](docs/configuration.md).

## 🤝 Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Jika Anda ingin berkontribusi, silakan ikuti langkah-langkah berikut:

1. Fork repositori ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -am 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request baru

Untuk informasi lebih lanjut, silakan baca [CONTRIBUTING.md](CONTRIBUTING.md).

## 📄 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT. Lihat file [LICENSE.md](LICENSE.md) untuk detail lebih lanjut.

## 👨‍💻 Kreator

Proyek ini dibuat dengan ❤️ oleh tim 3-bit dari SMK Dev:

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/rizqiirkhamm">
        <img src="https://github.com/rizqiirkhamm.png" width="100px;" alt="Rizqi Irkham Maulana"/><br />
        <sub><b>Rizqi Irkham Maulana</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/ammarzhrn">
        <img src="https://github.com/ammarzhrn.png" width="100px;" alt="Ammar Zahran Syafiq"/><br />
        <sub><b>Ammar Zahran Syafiq</b></sub>
      </a>
    </td>
    <td align="center">
      <a href="https://github.com/kenbigail">
        <img src="https://github.com/kenbigail.png" width="100px;" alt="Keenan Abigail"/><br />
        <sub><b>Keenan Abigail</b></sub>
      </a>
    </td>
  </tr>
</table>

---

<p align="center">
  Dibuat dengan 💖 dan ☕ oleh tim 3-bit untuk lomba SMK Dev
</p>
