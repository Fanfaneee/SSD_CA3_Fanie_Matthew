## Sounds of Éire - Matthew Tomkins/Fanie Bugenne
```


```

## Requirements
•	PHP 7.3 or higher <br>
•	Node 18.20.6 or higher <br>

## Usage <br>
To run the program locally <br>
```
git clone https://github.com/Fanfaneee/SSD_CA3_Fanie_Matthew.git

composer install
composer update
composer install

php artisan cache:clear 
php artisan config:clear
php artisan serve
npm run dev
```

## Before starting <br>
Create a database <br>
```
mysql
create database laravelblog;
exit;
```

Setup your database credentials in the .env file <br>
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelblog
DB_USERNAME=root
DB_PASSWORD=
```

Refresh the database migrations (this will drop all existing tables and re-run all migrations)
```
php artisan migrate:fresh
```

Grant yourself Admin
```
Create a user in register
Edit access level to 1 in phpmyadmin in users so see admin features
```
