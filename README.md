## Web Quotes seperti quora
<p>Dibuat menggunakan laravel</p>

<p>Sebelum memakai diharapkan sudah mendownload PHP, Apache, MySQL, dan NodeJS</p>
<p>Jika belum bisa download melalui link berikut ini:</p>
- [xampp](https://www.apachefriends.org/download.html) 
- [laragon](https://laragon.org/download/index.html)
- [nodejs](https://nodejs.org/en/) 

<p>Cara pakai</p>

1. Ubah file .env.example menjadi .env
2. Ubah config berikut ini yang terdapat di file .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=

   menjadi
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=web_quotes
   DB_USERNAME=root
   DB_PASSWORD=
3. Buat database di DBMS PHPMyAdmin atau DBMS lainnya. Dengan nama web_quotes
4. Lakukan migrate menggunakan php artisan:
   $php artisan migrate
5. $npm install && npm run dev
6. $composer install 
7. Web siap digunakan.
8. Masih terdapat kekurangan, tunggu update selanjutnya.
