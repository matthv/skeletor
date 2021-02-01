SKELETOR
=============

A light admin skeleton for Laravel 5. 

[W.I.P] This repo is actually in beta version.

![skeletor](https://i.imgur.com/0LmFEeS.png)

# Installation

```
composer require 'matthv/skeletor'
```
That's all, thanks Laravel auto discovery !


# Requirements

- Laravel >=7

# Configuration

## migration & seed

```
php artisan migrate && php artisan db:seed --class="Matthv\Skeletor\Database\Seeds\AdminsTableSeeder"
```

## publish assets
```
php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider" --tag=public
```
## Use
Now you can go to : http://localhost:8000/admin
And connect to : http://localhost:8000/admin/login with :
```
email: admin@skeletor.com
password: admin
```
You can change this credentials to : http://localhost:8000/admin/account (click on the avatar)

#### Create your own controller

- documentation soon
All controller use a [formbuilder (kristijanhusak/laravel-form-builder)](https://github.com/kristijanhusak/laravel-form-builder)

#### Filters

- documentation soon

## Customize & override

You can publish 
- routes and add yours
```
php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider" --tag=custom_routes
```
- personalize config
```
php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider" --tag=config
```
- change views
```
php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider" --tag=views
```
- update i18N
```
php artisan vendor:publish --provider="Matthv\Skeletor\SkeletorServiceProvider" --tag=lang
```
        

  
![connexion](https://i.imgur.com/Qsvhk8R.png)
![example](https://i.imgur.com/U1bQ6OJ.png)

