# Project Setup Instructions

## Prerequisites
- Ensure you are using PHP version 8.1 or greater.
- Ensure you have Node.js version 18.0 or greater installed on your computer.
- make sure you have database named `aws_products`
- make sure you are using mysql
- make sure in your database have these tables `products,categories`.
## Installation Steps

1. **Install Laravel Dependencies**
   `composer install` then run `php artisan migrate` this must be run after connected to a database.
in case these `products,categories` tables have already existed in database it will throw an error but it's ok . the error just alert warning that one of these table has existed . it's not an error so just leave it
2. **Install js Dependencies**
   `npm install`
3. **Start laravel server**
   `php artisan serve`
4. **Start vite server**
   `npm run dev`
5. **stop servers**
   `ctrl + c`