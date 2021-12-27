# money sa test
 

## Table of Contents
1.  [About](#about)
2.  [Technologies](#technologies)
3.  [Installing](#installing)
4.  [Usage](#usage)
5.  [Testing](#testing)
6.  [License](#license)

## About

This test implemets a simple forum

## Technologies

Laravel 8.*<br>
TALL Stack (Tailwind - Alpine.js - Laravel - Livewire)


## Installing

To install run this command:

```bash
composer install
```

```bash
npm run dev
```

```bash
php artisan migrate:fresh --seed
```

Now you can configure testing environment file to be able to run test script.

1. Create testing DB<br>
2. Update .env.testing file in your root application folder and change DB connection parameter</li>

## Usage
After installation you have to run the following command:<br>

```bash
php artisan serve
```
and visit

http://localhost:8000/

This command run a local web server

To login with administrator account use:<br>
Login: info@christiancocco.com<br>
Password: password<br><br>

To create a standar user you have to follow the registration procedure.

## Testing

To launch the Unit Test run this command:
```bash
php artisan test --filter=Post --stop-on-failure
```

## License

This software is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

