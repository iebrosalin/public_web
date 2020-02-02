# Mail checker

Форма для отладки отправляемых писем с кодом аутентификации в процессе оплаты.
Форма позволяет:
- Задать почтовый ящик для отладки, но smtp сервер зафиксирован
- Отправить тестовое письмо
- Проверить наличие нового письма по заданной теме и email-отправителя
- Отправить новое пиьсмо на другой сервер, в качестве примера использовался postman-echo

От этого же работодателя сделал [другой проект][FormWebsocket] по схожей по тематике. 


## Установка

Проект собран на основе докера, поэтому ознакомьтесь с командами управления контейнером и командойдля первого запуска. Сайт доступен по адресу http://local.loc:80.

<details>
    <summary>Состав контейнера</summary>
    
* PHP-fpm latest
* Ngnix
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
  <summary>Gif демо</summary>
  
  ![gif demo][Demo]
</details>

## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[FormWebsocket]:<https://github.com/iebrosalin/public_web/tree/frontend/form_websocket>

[Demo]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/mail_check/descriptions/gif/demo.gif>

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>
