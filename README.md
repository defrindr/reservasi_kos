# Reservasi Kos

## Instalasi

1. clone project
   ```sh
   git clone https://github.com/defrindr/reservasi_kos.git
   ```
2. install composer
   ```sh
   composer install
   ```
3. buat database baru dari phpmyadmin
4. copy paste file .env.example ke .env
   ```sh
   cp .env.example .env
   ```
5. atur database di .env file
6. generate key
   ```sh
   php artisan key:generate
   ```
7. Storage link
   ```sh
   php artisan storage:link
   ```
8. jalankan migration
   ```sh
   php artisan migrate:fresh --seed
   ```
9.  jalankan project
   ```sh
   php artisan serve
   ```

## Akun

| Role    | Email             | Password |
| ------- | ----------------- | -------- |
| Penyewa | penyewa@gmail.com | password |
| Admin   | test@example.com  | password |