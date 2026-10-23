# Sistem Informasi Manajemen Mahasiswa UMB
Sistem Informasi Manajemen Mahasiswa Per Program Studi Universitas Muhammadiyah Bengkulu.

## Fitur Utama
- **Dashboard**: Statistik ringkasan data mahasiswa, prodi, dan fakultas.
- **Manajemen Mahasiswa**: CRUD data mahasiswa lengkap (NPM, Nama, JK, TTL, Alamat, dll).
- **Manajemen Akademik**: Pengelolaan data Fakultas dan Program Studi.
- **Laporan**: Rekapitulasi jumlah mahasiswa per program studi (siap cetak).
- **Audit Log**: Mencatat setiap aktivitas pengguna di sistem.
- **Keamanan**: Login multi-role (Admin & Operator) dengan password terenkripsi.

## Teknologi
- PHP 7.4+ / 8.x
- MySQL Database
- Bootstrap 5 (UI Framework)
- Bootstrap Icons

## Instalasi Lokal (XAMPP)
1. Pindahkan folder `sistemmahasiswa` ke direktori `C:\xampp\htdocs\`.
2. Buka XAMPP Control Panel dan aktifkan **Apache** dan **MySQL**.
3. Buka browser dan akses `http://localhost/phpmyadmin/`.
4. Buat database baru dengan nama `db_sistemmahasiswa`.
5. Import file `database.sql` ke database tersebut.
6. Akses aplikasi melalui `http://localhost/sistemmahasiswa/`.
7. **Login Default**:
   - Username: `admin`
   - Password: `admin123`

## Hosting Online (InfinityFree)
1. Daftar akun di [InfinityFree](https://infinityfree.net/).
2. Buat akun hosting baru dan buka **Control Panel**.
3. Cari menu **MySQL Databases** dan buat database baru.
4. Buka **phpMyAdmin** di InfinityFree dan import file `database.sql`.
5. Edit file `config.php` di folder proyek:
   - Ganti `$host` dengan MySQL Hostname dari InfinityFree.
   - Ganti `$user` dengan MySQL Username.
   - Ganti `$pass` dengan Password akun InfinityFree.
   - Ganti `$db` dengan Nama Database yang dibuat.
   - Ganti `BASE_URL` dengan alamat website Anda.
6. Upload semua file proyek ke folder `htdocs` menggunakan **Online File Manager** atau FTP client (seperti FileZilla).
7. Akses website melalui URL yang diberikan InfinityFree.

---
&copy; 2026 Universitas Muhammadiyah Bengkulu
