# laravel-finance-form
 Aplikasi untuk generate invoice finance sederhana
 
## Requirement
- PHP 7.4 | 8.0.2
- Composer 2.1^
- Internet, karena menggunakan composer dan untuk mengunduh dependency yang diperlukan saat install

## Cara Install dan run project
- Clone Project ini 
- start webserver dan mysql server
- buat database mysql
- copy env.example menjadi .env, lalu edit konfigurasi .env nya, seperti nama database, username, password
- buka terminal dan masuk ke folder project lalu run
```
composer install
```
- kemudian run 
```
php artisan key:generate
```
- selanjutnya run 
```
php artisan migrate --seed
```
- pastikan tidak ada error, lalu untuk menjalankan project run
```
php artisan serve
```
- lalu buka url 127.0.0.1:8000 di browser
- done

### Default Admin Login
```
email = admin@finance.form
password = 12345678
```

### Default User Login
```
email = user@finance.form
password = 12345678
```

### Default Supervisor Login
```
email = supervisor@finance.form
password = 12345678
```