## <p align="center"> <a href="https://filamentphp.com" target="_blank"> <img src="https://img.shields.io/badge/Filament-Admin-blue?style=flat-square&logo=laravel" width="400" alt="Filament Admin Badge"> </a> </p>

# Kindly Reminder
Since the project hasn't been hosted yet and there is no dummy data provided, the first thing you need to do is add data through the Admin Page at 127.0.0.1/admin/login.
(Instructions for adding an admin role are provided below.)

# Laravel Project Setup

Step-by-step guide to set up and run this Laravel project locally.

## Installation

# 1. Install Composer dependencies
composer install

# 2. Copy the .env file
cp .env.example .env

# 3. Generate Laravel application key
php artisan key:generate

# 4. Configure your database in the .env file
DB_DATABASE, 

DB_USERNAME, 

DB_PASSWORD accordingly

# 5. Run database migrations
php artisan migrate

# 6. Run database seeders
php artisan db:seed

# 7. Create storage symlink
php artisan storage:link

# 8. (Optional) Clear cache if needed
php artisan config:clear
php artisan cache:clear

# 9. Start the Laravel development server
php artisan serve

## Adding Admin user
php artisan make:filament-user

#REMINDER
##If the image won't load with errors on console, just copied your localhost path and change it in env
