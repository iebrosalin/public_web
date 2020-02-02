# Yii2 practice

Практика за вторую половины курса WebForMySelf по Yii2 2016 года. Чистота кода не было целью курса. 

В итоге был создан прототип интернет магазина. 

<details>
    <summary>Основные темы</summary>
    
   1. Интеграция новой вёрстки
   2. Модель категорий
   3. Виджет «Меню категорий» (с кешированием)
   4. Вывод популярных товаров
   5. Вывод товаров категорий
   6. Метод для вывода метатегов
   7. Постраничная навигация
   8. Карточка товара.
   9. Обработка ошибок
   10. Поиск    
   11. Корзина
   12. Оформление заказа
   13. Отправка почты (я закоментил этот функционал, так как не сильно интересен был)
   14. Авторизация (только администраторов)
   15. Список заказов в админке
   16. Управление заказами
   17. Управление категориями
   18. Управление продуктами
   19. Установка визуального редактора
   20. Загрузка картинок
</details>



## Установка

<details>
    <summary>Конфиг сервера</summary>

Пример OpenServer Apache.
    
```
<VirtualHost *:%httpport%>

    DocumentRoot    "%hostdir%"
    ServerName      "%host%"
    ServerAlias     "%host%" %aliases%
    ScriptAlias     /cgi-bin/ "%hostdir%/cgi-bin/"
</VirtualHost>
```
</details>

Проверьте config/db.php, чтобы к БД происходило подключение.

Загрузите дамп БД, лежит в корне mysql.sql.

Данные от админки admin/12345678.

Aдминка расположена по адресу /admin
## Демо

<details>
    <summary>Корзина часть 1</summary>
    
![cart1][Cart]
</details>
<details>
    <summary>Корзина часть 1</summary>
    
![cart1][Cart2]
</details>

<details>
    <summary>Поиск</summary>
    
![search demo][SearchDemo]
</details>

<details>
    <summary>Обзор админки</summary>
    
![review admin][ReviewAdmin]
</details>



<details>
    <summary>CRUD товары</summary>
    
![crud product][CRUD_Product]
</details>



<details>
    <summary>CRUD заказы</summary>
    
![crud order][CRUD_Order]
</details>



<details>
    <summary>CRUD категории</summary>
    
![crud category][CRUD_Category]
</details>


<details>
    <summary>Демо адаптивности</summary>
    
![crud category][Adaptive]
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
</details>


## [Список всех моих проектов][ListAllMyProject]

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[Cart]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/add_cart.gif>
[Cart2]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/add_cart2.gif>
[SearchDemo]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/search_demo.gif>
[ReviewAdmin]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/review_admin.gif>
[CRUD_Product]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/crud_product_demo.gif>
[CRUD_Order]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/crud_order_demo.gif>
[CRUD_Category]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/crud_category_demo.gif>
[Adaptive]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/gif/adaptive_demo.gif>

[Screen1]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/2.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/3.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/4.png>
[Screen5]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/5.png>
[Screen6]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/6.png>
[Screen7]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/7.png>
[Screen8]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/8.png>
[Screen9]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/9.png>
[Screen10]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/10.png>
[Screen11]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/11.png>
[Screen12]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/12.png>
[Screen13]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/13.png>
[Screen14]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/14.png>
[Screen15]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/15.png>
[Screen16]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/16.png>
[Screen17]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/17.png>
[Screen18]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/18.png>
[Screen19]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/19.png>
[Screen20]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/20.png>
[Screen21]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/21.png>
[Screen22]:<https://github.com/iebrosalin/public_web/blob/backend/yii2/practice/descriptions/screens/22.png>
