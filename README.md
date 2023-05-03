
## Instalasi

Untuk menginstal Aplikasi, Anda akan ingin mengkloning atau mengunduh repo ini:

```
git clone https://github.com/Noorwahid717/spmb.git project_name
```

Selanjutnya, kita dapat menginstal Wave dengan ini **4 Langkah Sederhana**:

### 1. Buat database baru

Kita perlu menggunakan database MySQL selama instalasi.Untuk tahap berikut, Anda harus membuat database baru dan mempertahankan kredensial.

```sql
CREATE DATABASE spmb;
CREATE USER 'spmb'@'localhost' IDENTIFIED BY 'spmb_password';
GRANT ALL PRIVILEGES ON spmb.* TO 'spmb'@'localhost';
```

### 2. Salin file `.env.example`

Kita perlu menentukan variabel lingkungan kita untuk aplikasi kita.Anda akan melihat file bernama `.env.example`, Anda harus menduplikasi file itu dan mengganti nama menjadi` .env`.

Kemudian, buka file `.env` dan perbarui *db_database *, *db_username *, dan *db_password *di bidang yang sesuai.Anda juga ingin memperbarui * app_url * ke URL aplikasi Anda.

```bash
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spmb
DB_USERNAME=root
DB_PASSWORD=
```


### 3. Tambahkan dependensi komposer

Pertama, Anda harus memastikan bahwa server web Anda memiliki ekstensi PHP yang diperlukan diinstal:

> [Persyaratan PHP Laravel](https://laravel.com/docs/9.x/deployment#server-requirements)

Setelah itu, kita perlu menginstal semua dependensi komposer melalui perintah berikut:
```PHP
composer install
```

### 4. Jalankan migrasi dan seeds

Kita harus memigrasikan skema basis data kita ke dalam basis data kita, yang dapat kita capai dengan menjalankan perintah berikut:
```php
php artisan migrate
```
<br>
Akhirnya, kita perlu menyemai basis data kita dengan perintah berikut:

```php
php artisan db:seed
```
<br>

🎉 Dan itu saja!Anda sekarang akan dapat mengunjungi URL Anda dan melihat aplikasi gelombang Anda dan berjalan.

## Watch, Learn, and Build

We've also got a full video series on how you can setup, build, and configure Wave. 🍿 You can watch first few videos for free, and additional videos will require a [DevDojo Pro](https://devdojo.com/pro) subscription. By subscribing to a [DevDojo Pro](https://devdojo.com/pro) subscription you will also be supporting the ongoing development of this project. It's a win win! 🙌

[Click here to watch the Wave Video Series](https://devdojo.com/course/wave).


## Documentation

Checkout the [official documentation here](https://wave.devdojo.com/docs).
