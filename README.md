# Sandbox
Пет-проект является песочницей для практики написания сайта на чистом php. За основу был взят мой первый сайт
. На данный момент переработана только часть функционала админки. Есть много вещей которых можно улучшить, но не всё сразу...

Состав контейнера:
* Docker
* PHP 7.4
* Apache 2.4
* MySQL 8
* phpMyAdmin

<details>
    <summary>Команды для управления контейнерм</summary>
    
   Первый запуск
    
```
make start && make composer
```
 
 Остановка
    
```
make stop
```   

Старт

```
make start
```  
	
Рестарт
	
```
make restart
```

Прекращение работы контейнера

```
make stop
```

Аналог composer update

```
make composer-update
```

Аналог composer install

```
make composer-install
```

Инициализация зависимостей composer c update

```
make composer
```
	
Production composer build
	
```
   make composer-prod
```
   
</details>

Проект собран на основе докера.Для запуска ввести комманду
 
  (иначе для .htaccess нужные права не поставятся). Для остановки .
По адресу http://localhost будет доступен сайт. Админка для импорта БД http://localhost:80. Для доступа к БД используеются данные из файла .env (пользователь docker с паролем docker). Дамп БД находится в www/mysql.sql импортировать в БД docker. 
Из функционала реализован CRUD для товаров, категорий, а также страница отправляющая эхо get и post запросы.

[]:< https://github.com/iebrosalin/Pure_php_shop>