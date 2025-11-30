–––––––––––––––––––––––––––––––––––––

Sistem Absensi QR Code (Laravel)

Sistem Absensi berbasis QR Code menggunakan Laravel 12.
Guru menghasilkan QR, siswa melakukan scan untuk absensi harian.

==================================================

FITUR

Backend (SELESAI)

Role: admin, guru, siswa

Guru generate QR Code dengan masa berlaku

Siswa scan QR untuk absen

Validasi QR:

QR valid

QR masih aktif

QR belum kedaluwarsa

Siswa belum absen di hari yang sama

Absensi tersimpan otomatis ke database

Seeder lengkap (Admin, Guru, Siswa)

==================================================

AKUN DUMMY (SEEDER)

Admin
Email: admin@absensi.test

Password: password

Guru
Email: guru@absensi.test

Password: password

Siswa
Email: siswa@absensi.test

Password: password

==================================================

CARA SETUP PROJECT

Clone repository

git clone https://github.com/AuuAhMales/sistem_absensi_qr.git

cd sistem_absensi_qr

Install dependency

composer install

Setup environment

copy .env.example .env
php artisan key:generate

Edit .env bagian database sesuai laptop masing-masing

DB_DATABASE=sistem_absensi_qr
DB_USERNAME=root
DB_PASSWORD=

Migrasi dan seeder

php artisan migrate:fresh --seed

Jalankan server

php artisan serve

Akses di browser
http://127.0.0.1:8000

==================================================

DEV LOGIN (UNTUK DEVELOPMENT)

Tanpa frontend, bisa login langsung via URL:

/dev-login/admin
/dev-login/guru
/dev-login/siswa

Contoh:
/dev-login/guru

==================================================

API ENDPOINT

Generate QR (Guru)

Method: GET
URL: /guru/qr

Response:
token dan waktu expired QR

Scan QR (Siswa)

Method: POST
URL: /absen/scan

Body (JSON):
token dari QR

Respon sukses:
Absensi berhasil

Respon gagal:

QR tidak valid

QR kedaluwarsa

QR tidak aktif

Sudah absen hari ini

Catatan:
Absensi hanya bisa dilakukan 1x per hari.

==================================================

STRUKTUR DATABASE

users
peran
guru
siswa
qr_token
absensi

==================================================

PEMBAGIAN TUGAS TIM

Backend:

Database

QR generation

Absensi logic

Validasi QR

Frontend:

UI login

Scan QR via kamera

Kirim token ke endpoint /absen/scan

Tampilkan hasil absensi ke user

==================================================

STATUS PROYEK

Backend: SELESAI (100%)
Frontend: MENYUSUL

==================================================

CATATAN

Setelah clone dan migrate, sistem backend sudah langsung bisa dipakai.
Frontend tinggal konsumsi endpoint yang sudah ada.

–––––––––––––––––––––––––––––––––––––
