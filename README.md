# Sandbox
Пет-проект является песочницей для практики написания сайта на чистом php. За основу был взят [мой первый сайт][FirstSite]. На данный момент переработана только часть функционала админки. Есть много вещей которых можно улучшить, но не всё сразу... 
Пока приостановил проект, так как нужно подучить общепризнанные практики.

<details>
    <summary>Вещи которые удалось улучшить из первого сайта</summary>
    
   1. Использование composer
   2. Соблюдение PSR-1, PSR-4, PSR-12
   3. Добавил в код немного SOLID
   4. 404, 500 ошибки, пока
   5. Добавил docker
   6. Обновил дизайн
   7. Изменил view, теперь отдалённо напоминает взрослые фреймворки
   8. Добвил форму c эхо GET и POST запросами для проверки входных данных и тестирования санитизации
   9. Автоимпорт БД. Тестовая БД проимпортируется, если её нет или там нет таблиц
   10. Добавил вывод найденных таблид в БД на домашней странице
</details>


Проект собран на основе докера, поэтому ознакомьтесь с командами управления контейнером и командойдля первого запуска. По адресу http://localhost будет доступен сайт. Админка для управления БД http://localhost:8080. Для доступа к БД используеются данные из файла .env (пользователь docker с паролем docker).

<details>
    <summary>Состав контейнера</summary>
    
* PHP 7.4
* Apache 2.4
* MySQL 8
* phpMyAdmin
</details>


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


## Демо

<details>
    <summary>CRUD продуктов</summary>
    
    
</details>


<details>
    <summary>CRUD категорий</summary>
    
    
</details>

<details>
    <summary>Форма тестирования санитизации</summary>
    
    
</details>


<details>
    <summary>Ошибки</summary>
    
    
</details>
 

[FirstSite]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/first_site>
[]:<>
