# First site

Мой "Hello World!" в web-разработке. На сегодняшний день сайт выглядит ужасно. 
 Переосмысление этого проекта я делал в [Sandbox][SandboxPHP], удалось исправить некоторые недостатки и реализовать некоторые идеи. 
 Для меня проект является источником вдохновения, потому что это худшее что я писал.

<details>
    <summary>Немного истории</summary>
    
  Сайт не разрабатывался с нуля, а был взят за основу сайт из курса про создание интернет магазина года 2015 от Виктора
  Зинченко(php-start.com). В процесса его переделывания под себя я учил PHP (узнавал о существововании старых и плохих практик).
  На тот момент времени о вёрстке я знал только основые css-свойства и представление о том что блочная вёрстка на float это
  модно. Bootstrap для меня оставался загадкой.    
  
  Найдутся люди, которые скажут что код - говно. Они будут правы. Другая правда заключаетс что подобные курсы не ставят 
  цели научить писать хороший код, а предоставляют возможность войти в професию пусть и под унизительным словосочетанием
  говно-кодер. Не всем везёт со становлением на путь совершенного кода, я из тех кому не повезло.
  
  После получения автомата благодаря сайту, я через неделю раздобыл бесплатный shared-хостинг на который перенёс сайт.
  Поучился переносу, а потом какое-то время использовал хостинг как песочницу для изучения темы дипломой работы.
</details> 

## Технические подробности

<details>
    <summary>Специфика проекта</summary>
    
  * MVC 
  * Структура проекта
  * PSR-0 со своем автозагрузчиком
  * Отсутствие сторонних пакетов
  * Отсутсвие namespace
  * Генерация капчи с помощью древнего скрипта тянущая зависимость от расшерения gd
  * Взаимодействия с БД через PDO и параметризированные запросы
  * ЧПУ
  * Своя реализация роутера основанная на регулярках, массиве роутов, call_user_func
  * Регистрация маршрутов через массив в файле <code>config/routes</code>, где в виде ключ=>значение задаётся регулярное 
  выражение как ключ, а значением является url написанный стиле ZF, который и вызывается соответствующим образом.
  * Аутентификация в админку через basic auth от  Apache
  * Отсутвие валидации данных на клиентской стороне
  * Валидация данных форм на сервере присутствует
  * CRUD над основным сущностями сайта: товары, категории, пользователи, комментарии, заказы
  * Есть также у сущностей специфичные флаги, например отображение у товаров и категорий. У пользователей это флаг
   блокировки (может ли пользователь авторизоваться)
  * Есть личный кабинет у пользователя для просмотра заказов, изменения аватара и имени
  * Предусмотрена покупка товаров, комментирование
  * Административная и клиентская часть сайта дублируют друга, в своё время явно роуты не понял до конца. Хотя случалось
   мне видеть, такую многосайтовость на одном взрослом проекте
  * Пароли все хэшируются
  * Отсутвуют 404, 500 ошибки
  * С точки зрения реального интернет магазина в проекте всё плохо
  * В админке валидация до ума недоведена из-за дублирования плохого кода, плюс есть более элегантные решения
  * Мобильная версия явно нуждается в доработке
</details>


<details>
    <summary>Структуре проекта</summary>
   
   - Administrator - панель администратора 
   - Controllers - толстенькие контроллеры с бизнес логикой
   - Models - модели с запросами к БД
   - Views - отображаемые страницы html+php
   - Components содержит отдельные компоненты, где каждый решает свою специфическую задачу
   - Config - содержит файлы маршрутами и параметрами подключения к БД
   - Templates - папка со стилями
   - Uploads содержит загружаемые пользователями файлы
</details>


## Пара слов о запуске сайта  

<details>
    <summary>Конфиг сервера и доступы к БД</summary>
    Минимальный конфиг в apache 2.4 для OpenServer:
    <code>
    
        <VirtualHost *:%httpport%>    
            DocumentRoot    "%hostdir%"
            ServerName      "%host%"
            ServerAlias     "%host%" %aliases%
        
            <Directory     "%hostdir%"> 
                Require all granted
            </Directory>
        
        </VirtualHost>
        
   </code>
    
</details>

<details>
    <summary>Импорт БД и доступы</summary>
    
   Не забудьте проверить данные о подключении к БД в файле <code>config/db_params</code>. Импортируйте файл mysite.sql.
   Чтобы зайти в панель администратора зайдите на /admin логин admin пароль 12345678
   Логин тестового пользователя test@mail.ru пароль test1234
</details>

## Демо

<details>
    <summary>Демо шопинга</summary>
 
![shoping non auth gif][ShopingNonAuthGif]
</details>

<details>
    <summary>Оформление заказа без куков</summary>
 
![order with auth gif][OrderWithAuthGif]
</details>

<details>
    <summary>Оформление заказа с сохранёнными куками</summary>
 
![order with auth cookie gif][OrderWithAuthCookieGif]
</details>

<details>
    <summary>Редактирование профиля демо</summary>
 
![edit user gif][EditUserGif]
</details>

<details>
    <summary>Демо админки</summary>
 
![review admin gif][ReviewAdminGif]
</details>

<details>
    <summary>Демо создания/редактирования продукта</summary>
 
![create edit product gif][CreateEditProductGif]
</details>

<details>
    <summary>Демо удаления продукта</summary>
 
![delete product gif][DeleteProductGif]
</details>


<details>
    <summary>Демо управления заказами</summary>
 
![create edit delete order][CreateEditDeleteOrder]
</details>

<details>
    <summary>Демо управления категориями</summary>
 
![category demo gif][CategoryDemoGif]
</details>


<details>
    <summary>Регистрация пользователя демо</summary>
 
![register user gif][RegisterUserGif]
</details>

<details>
    <summary>Поиск комментариев админке демо</summary>
 
![search comment][SearchComment]
</details>

<details>
    <summary>Скриншоты</summary>
  
 ![screen 1][Screen1]
 ![screen 2][Screen2]
 ![screen 3][Screen3]
 ![screen 4][Screen4]
 ![screen 5][Screen5]
 ![screen 6][Screen6]
 ![screen 7][Screen7]
 ![screen 8][Screen8]
 ![screen 9][Screen9]
 ![screen 10][Screen10]
 ![screen 11][Screen11]
 ![screen 12][Screen12]
 ![screen 13][Screen13]
 ![screen 14][Screen14]
 ![screen 15][Screen15]
 ![screen 16][Screen16]
 ![screen 17][Screen17]
 ![screen 18][Screen18]
 ![screen 19][Screen19]
 ![screen 20][Screen20]
 ![screen 21][Screen21]
 ![screen 22][Screen22]
 ![screen 23][Screen23]
 ![screen 24][Screen24]
 ![screen 25][Screen25]
 ![screen 26][Screen26]
 ![screen 27][Screen27]
 ![screen 28][Screen28]
 ![screen 29][Screen29]
 ![screen 30][Screen30]
 ![screen 31][Screen31]
 ![screen 32][Screen32]
 ![screen 33][Screen33]
</details>

## [Список всех моих проектов][ListAllMyProject]

[SandboxPHP]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/sandbox>

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[ShopingNonAuthGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/shopping_non_auth.gif>
[OrderWithAuthGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/order_with_auth.gif>
[OrderWithAuthCookieGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/order_with_auth_cookie.gif>
[EditUserGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/edite_user.gif>
[CommentGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/comment.gif>
[ReviewAdminGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/review_admin.gif>
[CreateEditProductGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/create_edit_product.gif>
[DeleteProductGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/delete_product.gif>
[CreateEditDeleteOrder]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/create_edit_delete_order.gif>
[CategoryDemoGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/category_demo.gif>
[RegisterUserGif]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/register_user.gif>
[SearchComment]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/gif/search_comment.gif>


[Screen1]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen5]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen6]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen7]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen8]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen9]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen10]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen11]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen12]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen13]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen14]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen15]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen16]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen17]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen18]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen19]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen20]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen21]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen22]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen23]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen24]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen25]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen26]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen27]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen28]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen29]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen30]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen31]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen32]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
[Screen33]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/first_site/descriptions/screens/1.png>
