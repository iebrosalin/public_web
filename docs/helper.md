# Шпаргалка комманд консоли


## Установка через composer

````
composer create-project --prefer-dist laravel/laravel=версия папка
````

## Плагины для PhpStorm
- Laravel Plugin

## Пакеты без которых жизнь не мила:
- https://github.com/barryvdh/laravel-debugbar
- https://github.com/barryvdh/laravel-ide-helper

## Создание моделей 

```
php artisan make:model Model/BlogCategory -m

php artisan make:model Model/BlogPost -m<
```
## Создание БД для Laravel

````
create schema `poligon` default character set utf8mb4 collate utf8mb4_unicode_ci;
````

## Миграция 

````
php artisan migrate
````

## Создание сидеров, фабрик

```
php artisan make:seeder UserTableSeeder

php artisan make:seeder BlogCategoriesTableSeeder
```

Запуск сидов

```

php artisan db:seed
php artisan db:seed --class=UserTableSeeder
php artisan migrate:refresh --seed

```

Содание фабрики

```

php artisan make:factory BlogPostFactory --model="App\Models\BlogPost"

```

При создании новых сидов полезно делать 

```

composer dumpautoload

```

## Контроллеры

Создание

```

php artisan make:controller RestTestController --resource

```

Аутентификация (для базовой вёрстки)
```
php artisan make:auth
php artisan migrate
```

