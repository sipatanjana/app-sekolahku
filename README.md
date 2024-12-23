# Guidenes
- Clone gitlab repo
- lakukan instalasi 
```bash
composer install
``` 
- lakukan konfigurasi database pada .env
- migration dan seeding data
```bash
php artisan migrate
php artisan db:seed
```
- instal shield pada filament
```bash
php artisan shield:generate --all
```
- jika ada prompt untuk memilih panel maka masukkan angka 0
```bash
php artisan shield:super-admin --user=1
```
- lalu lakukan serve app
```bash
php artisan shield:super-admin --user=1
```
- untuk melakukan akses panel dashboard bisa ke `{APP URL}/admin` , dan login menggunakan user yang yang sudah di lakukan seeder, secara automatis andi@andi.com akan menjadi super_admin, collection json saya sertakan pada folder root app 