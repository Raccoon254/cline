<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel Template

Laravel template is an extension of the Laravel framework. It is a template that is used to create a new Laravel project
with the following features:

- Authentication
- Tailwind CSS
- DaisyUI
- Laravel Livewire

## Installation

clone the repository

```bash
git clone https://github.com/Raccoon254/laraveltemplate.git [your project name]
```

Install composer dependencies

```bash
composer install
```

Install npm dependencies

```bash
npm install
```

Create a copy of your .env file

```bash
cp .env.example .env
```

Configure your .env file
Set the application key

```bash
php artisan key:generate
```

Run the database migrations

```bash
php artisan migrate
```

Serve the application

```bash
npm run start
```

## Database

MariaDB is used as the database for this project. Create a database and update the .env file with the database name,
username and password.

```env
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
