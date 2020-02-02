# Laravel season 1

  [Автор в курсе][LaravelCourse] предлагает постепенно писать блог на Laravel и познавать чистый код. Курс все ещё выходит. Курс имеет пару продолжений: [2-ой сезон (c 51 серии)][LaravelCourse] и [спин-оф на тему паттернов][PatternCourse](иначе фундамент будет заложен слишком хрупкий по мнению автора) между 1-ым и 2-ым сезоном.

<details>
    <summary>Темы сезона</summary>
- Работа с БД и наполнение тестоыми данными
    - В зависимости от БД хак возможно придётся использовать общепризнанный костыл в сообществе
    - Seeds
    - Factory
    - Faker
    - Миграции
    - Soft delete
- Контроллеры
    - Добавление, группировка роутов
    - Получае параметры методами с последующей обработкой
    - Свои request для облегчения логики контроллера
    - Obervers
    - Рефакторинг контроллеров для уменьшения концентрации бизнес логики путём добавления в flow observers, repositories, свои request с валидацией
- Модель (Eloquent, Collection)
    - CRUD операции
    - Фильтры, пагинация и подобные дополнительные параметры в запросах
    - Аксессоры
    - Ленивая, жадная подгрузка
    - Распространнённые методы для работы с коллекциями
    - Добавления репозиториев а базовую архитектуру
    - Carbon немного использовался
- Blade
    - Базовые возможности: управляющих конструкций, разбиение шаблона на части
- CLI
    - Впервую очередь миграции, сиды, генерация и нужных классов: контроллеров, моделей и т.д...
- Обновление Laravel, что подразумевает знакомство с основными breaking changes
</details>

## Установка

Конфигурация у меня совпадает с той что используется в курсе.


<details>
    <summary>Пара советов</summary>
  
1. Конфигурация web-server должна смотреть иметь корневую папку public. 

2. Конфигурация для БД задаётся в файле .env.

3. Так как я работал MariaDB, то был использован соответствующий костыль.

4. Наполнение Db фикстурами делается следующей командой:

```
php artisan migrate:refresh --seed
```
</details>    

## Демо

<details>
    <summary>Клиентская часть</summary>

![client posts][ClientPosts]
</details>    

<details>
    <summary>Страница постов в админке</summary>

![admin index posts][AdminIndexPosts]
</details>   

<details>
    <summary>CRUD постов в админке</summary>

![admin crud posts][AdminCRUDPosts]
</details>   

<details>
    <summary>CRUD категорий в админке</summary>

![admin crud category][AdminCRUDCategory]
</details>   

## [Список всех моих проектов][ListAllMyProject]

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[LaravelCourse]:<https://www.youtube.com/watch?v=e0L2hQ88LSg&list=PLoonZ8wII66iP0fJPHhkLXa3k7CMef9ak>
[PatternCourse]:<https://www.youtube.com/watch?v=0SXIxi-RpZw>

[ClientPosts]:<https://github.com/iebrosalin/public_web/blob/backend/laravel/afanasyev/season1/descriptions/gif/client_posts.gif>
[AdminIndexPosts]:<https://github.com/iebrosalin/public_web/blob/backend/laravel/afanasyev/season1/descriptions/gif/admins_index_posts.gif>
[AdminCRUDPosts]:<https://github.com/iebrosalin/public_web/blob/backend/laravel/afanasyev/season1/descriptions/gif/admins_crud_posts.gif>
[AdminCRUDCategory]:<https://github.com/iebrosalin/public_web/blob/backend/laravel/afanasyev/season1/descriptions/gif/admins_crud_category.gif>
