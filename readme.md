# Laravel-TestTask

This is my test project for MediaCube. I used Laravel 8 and PHP 7.4. I spent for about 10 hours on it.

# Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone git@github.com:moxemus/Laravel-TestTask.git

Switch to the repo folder

    cd Laravel-TestTask

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database seeder to fill database

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000



# What I've done

- Simple resource routing
- All needed models with some extra logic
- CRUD controllers with validation
- Migrations to recreate the database structure
- Seeders to fill all tables


# What I would like to add

- API documentation, because I don't have any fronted to show how it works
- Instead of deleting workers - make them inactive for history
- Also for history log all changes in departments and information about workers
- Add users and role-based access, because now everyone has access to any action


