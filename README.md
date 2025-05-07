![image](https://github.com/user-attachments/assets/ab3f0e33-a457-4c45-8bf3-9b0ee34adb6f)

## Sounds of Éire 
### ✍️ Authors

Fanie Bugenne<br>
Matthew Tomkins

### Home Page
![image](https://github.com/user-attachments/assets/1acc7cd9-31e2-429d-bf45-c1546b6b1514)
### Festivals Page - See all the festivals in Ireland. Search, sort and filter by preference.
![image](https://github.com/user-attachments/assets/86fa0940-2147-4862-900d-abfb7f667aca)
### Map Page - Find where all the action is happening
![image](https://github.com/user-attachments/assets/a63b0458-b1a9-48d3-8c13-85978dd052de)
### Calender Page - Check the dates for all the events
![image](https://github.com/user-attachments/assets/7f3212d9-51e8-4e07-b30c-f70ff2090b7e)
### Contact Page - Get in touch with Admins
![image](https://github.com/user-attachments/assets/711899d2-5c34-418b-900d-164aa52bcc8d)
### Festival Info - See all the details and talk with others in the comments
![image](https://github.com/user-attachments/assets/4d5b2c8b-61a8-44e5-9d02-39ceea06946b)
### Save Festivals to your Favorites!
![image](https://github.com/user-attachments/assets/cbf1fc63-7391-4512-a229-04fecb9d7e0f)
### Full administrator control
![image](https://github.com/user-attachments/assets/c8dac473-ddce-479e-b1f5-9ee50ab325f4)

## Requirements
•	PHP 7.3 or higher <br>
•	Node 18.20.6 or higher <br>

## 🚀 Usage <br>
To run the program locally <br>
```
git clone https://github.com/Fanfaneee/SSD_CA3_Fanie_Matthew.git

composer install
composer update
composer install

php artisan cache:clear 
php artisan config:clear
php artisan serve
php artisan storage:link
npm run dev
```

## ℹ️ Before Starting <br>
Create a database <br>
```
mysql
create database ssd_ca3_fanie_matthew;
exit;
```

Setup your database credentials in the .env file <br>
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ssd_ca3_fanie_matthew
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
