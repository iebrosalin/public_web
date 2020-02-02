# Theory yii2

Практика за первую половины курса WebForMySelf по Yii2 2016 года, вроде глава организации снимал курс. 


<details>
    <summary>Основные темы</summary>
    
   1. Контроллеры в Yii. Общий контроллер приложения
   2. Виды и шаблоны
   3. Подклоючние стилей и шаблонов. Блоки.
   4. Выполнение AJAX запроса
   5. Метаданные страницы
   6. Формы 
        - Создание форм
        - Валидация данных
        - Принятие данных из формы
   7. Работа с БД
        - Выборка данных
        - Отложенная и жадная загрузка данных
        - Запись данных в БД
        - Обновление и удаление данных в БД
   8. Виджеты
   9. Расширения 
         - Установка расширений из консоли
         - Установка расширений без composer
   10. Создание ЧПУ      
   11. Gii - генерация кода 
</details>

## Установка


<details>
    <summary>Состав контейнера</summary>
    
* PHP 7.2
* Apache 2.4
* MySQL 5.8
* phpMyAdmin
</details>


Проект собран на основе докера, поэтому ознакомьтесь с командами управления контейнером и командойдля первого запуска. По адресу http://localhost будет доступен сайт. Админка для управления БД http://localhost:8080. Для доступа к БД используеются данные из файла .env (пользователь docker с паролем docker).

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
    <summary>Состав контейнера</summary>
    
</details>

<details>
    <summary>Состав контейнера</summary>
    
</details>

<details>
    <summary>Состав контейнера</summary>
    
</details>

## [Список всех моих проектов][ListAllMyProject]

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>
