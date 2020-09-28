<p align="center"><img src="https://i.imgur.com/84BIPpB.png" width="400"></p>

<p align="center">
<img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status">
<img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads">
<img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version">
<img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">
</p>

# Shift Management Website For Employees

Shift Management Website For Employees is tools built with Laravel and Vuejs.

## Installation


Use the package manager [composer](https://getcomposer.org/) to install.


```
composer install
php artisan key:generate
```
Use the package manager [npm](https://www.npmjs.com/package/npm) to install npm.


```
npm install
```
Use the package manager [JWT](https://jwt-auth.readthedocs.io/en/develop/quick-start/) to install.


```
php artisan jwt:secret
```
And setting.

```
php artisan migrate:fresh
php artisan db:sed
```
## Usage

You must install user information with the highest permissions. Here I use tinker

```
php artisan tinker
$user = new User();
$user['username'] = 'admin';
$user['password'] = bcrypt('admin');
$user['role_id'] = 2;
$user->save(); 
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Author
[Ngocthanh06](https://github.com/ngocthanh06)
