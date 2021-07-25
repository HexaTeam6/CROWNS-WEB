<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

run:
```shell
    composer install
    npm install
    npm run dev
    php artisan migrate:fresh
    php artisan db:seed
```

### Seeder akun admin
bila melakukan seed, maka akan ada akun khusus admin
```shell
username: crowns-admin
email   : crowns-admin-email.@gmail.com
password: crowns-admin-password-is-so-long
```

dashboard: https://www.creative-tim.com/product/argon-dashboard
auth: https://laravel.com/docs/8.x/passport

### List Status
```shell
Status pesanan:
1 -> Baru insert pesanan kosong
2 -> Sudah isi detail
3 -> Sudah isi lokasi penjemputan
4 -> Sudah upload bukti bayar
5 -> Pesanan selesai

Status bayar:
1 -> Baru insert pembayaran kosong
2 -> Penjahit sudah isi harga
3 -> Pembeli sudah upload bukti bayar, tunggu di acc admin
4 -> Sudah di acc, kalau ditolak balik ke 2

Status tawar:
1 -> Pembeli bisa menawar
2 -> Menunggu jawaban penjahit
3 -> Tawaran diterima, kalau ditolak balik ke 1

1.1.0
2.1.0
3.1.0  3.2.0  3.2.1  3.2.2
4.2.0  4.2.1  4.2.3  (pembayaran ditolak)
4.3.0  4.3.1  4.3.3  (pembayaran belum diacc)
4.4.0  4.4.1  4.4.3  (sudah bayar dan masih dikerjakan)
5.4.0  5.4.1  5.4.3
```