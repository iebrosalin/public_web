## Handbook PostrgreSQL

Проект появился в результате изучения книги "PostrgreSQL для начинающих", которую получил на митапе 2018 от Олега Бартынова. Оформил всё как лендинг, с группировкой запросов по главам. Интерактив отсутвует

Сайт доступен по адресу https://localhost:80, а админка для управления БД https://localhost:8080

<details>
    <summary>Состав контейнера</summary>
    
* PHP-fpm latest
* Ngnix
* Postgresql 10
* Adminer
</details>


<details>
    <summary>Команды для управления контейнерм</summary>
    
   Первый запуск
    
```
make start
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
  <summary>Книга</summary>
  
![handbook postgresql][HandbookPostgreSQL]  
</details>  

<details>
  <summary>Демо</summary>
  
![demo][Demo]
</details> 


## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[HandbookPostgreSQL]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/handbook_postgresql/descriptions/gif/handbook_postgresql.jpg>
[Demo]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/handbook_postgresql/descriptions/gif/demo.gif>
