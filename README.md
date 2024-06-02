# Project Setup Instructions

## Prerequisites
- Ensure you are using PHP version 8.1 or greater. if not go to `https://www.php.net/downloads.php` to download it first
- Ensure you have Node.js version 18.0 or greater installed on your computer. if not go to `https://nodejs.org/en` to download it first
- make sure you have database named `aws_products`
- make sure you are using mysql if not go to `https://laragon.org/download/index.html` to download it.
- make sure in your database have these tables `products,categories`.
- make sure you have composer installed in your computer if not go to `https://getcomposer.org/` to install it first
## Installation Steps

1. **Install Laravel Dependencies**
   -make a file in the root of the project named .env then copy all content from file .env.example into .env
   -first run `composer install` then run `php artisan migrate` this must be run after connected to a database.the database name is `aws_products`.
-> make sure mysql server is running on your computer.
-> to connect to a database in laravel go to .env find this code 
   `DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aws_products // replace this to an actual database name
   DB_USERNAME=root // database user name . the user that for logging into your database
   DB_PASSWORD=  //keep it blank if don't require password
   `
->then run `php artisan migrate`
->in case these `products,categories` tables have already existed in database it will throw an error but it's ok . the error just alert warning that one of these table has existed . it's not an error so just leave it
2. **Install js Dependencies**
   `npm install`
3. **Start laravel server**
   -> for those who clone this repo has to run this command `php artisan key:generate` before running bellow command
   `php artisan serve`
4. **Start vite server**
   `npm run dev`
5. **stop servers**
   `ctrl + c`