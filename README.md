
# SIMPERDES (Sistem Informasi Peraturan Desa)

Sistem Informasi Manajemen Peraturan Desa (SIMPERDES) adalah sebuah sistem yang digunakan untuk mengelola dan mengatur peraturan-peraturan di tingkat desa.




## How to set up a project

First, we are going to install Node Module and Vendor files.

```bash
  npm install
```
```bash
  composer install
```

To setup your .env, kindly duplicate your .env.example file and rename the duplicated file to .env.
For this project, I'm using phpMyAdmin Database. On your .env file, locate this block of code below.

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=db_simperdes
  DB_USERNAME=root
  DB_PASSWORD=
```
To finalize this everything, run the following commands on your terminal.

```bash
  npm run dev

  php artisan key:generate

  php artisan migrate

  php artisan db:seed

  php artisan server
```