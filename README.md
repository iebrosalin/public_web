# News CRUD panel

Как-то дали тестовое задание в 05.2018. Заключалось оно в написании CRUD панели c использованием следующих средств:

 - Symfony 3.4
 - Propel 2
 - Bootstrap
 - Twig
 - OpenServer
 - Composer
 
 С этим проектом есть своя маленькая история.

<details>
  <summary>Немного истории</summary>
 
На момент получения задания все средства из списка выше были для меня новы, кроме Bootstrap. Задание выполнил за 2 недели (1 неделю у меня отобрал Propel), а последующее собеседование провалил, но не из-за задания точно. 

В процессе выполнения задания всё прекрасно гуглилось, находилось. Курсы, видео, статьи не были проблемой. Ко всему используемому инструменту у меня не было притензий, кроме Propel.

Самым не приятным в проекте был Propel, так как я потратил неделю на генерацию моделей (эта операция обычно занимает максимум 10 минут в зависимости от сложности модели и желаемых фикстур), я впервые так сильно не взлюбил какой-то инструмент разработки (прям несовместимость какая-то чудовищная). В период написания было видно, что сообщество Propel ослабело, потому что проиграло войну за orm по-умолчанию в Symfony. В следствии чего материал по нему успел протухнуть, курсы или видеоролики по нему не записывали (Doctrine победил в 3-ьей версии Symfony), а опыта работы с подобным у меня не было. 
</details> 

## Установка

<details>
 <summary>Сервер и БД</summary>
 
 1. Конфиг Apache сервера из OpenServer
 
 ```
 <VirtualHost *:%httpport%>
   DocumentRoot    "%hostdir%/web"
   ServerName      "%host%"
   ServerAlias     "%host%" %aliases%
   ScriptAlias     /cgi-bin/ "%hostdir%/cgi-bin/"
 </VirtualHost>
 ```
 
2. Данные для подключения к БД проверьте в app/config/config.yml (c строки 47 нужные данные) 
</details> 


<details>
 <summary>Команды из CLI для первого запуска</summary>
 
1.Установите пакеты: 
```php
composer install
```
2. Импортируйте sql dump из app/propel/sql/news.sql (предполагается что БД будет называться news, а таблица article с определёнными полями).

3. Заполнение БД фейковыми данными делается командой :

```php
php  bin/console propel:fixtures:load
```

</details> 

После выполнения иструкций сайт будет готов к работе.

 
 ## Демо
 
 <details>
 <summary>Главная страница</summary>
 
![index demo][IndexDemo] 
</details> 

 <details>
 <summary>Демо модели новости</summary>
 
![edit deletedetail news][EditDeleteDetailNews] 
</details> 

 <details>
 <summary>Демо поиска</summary>
 
 Поиск упрощённый, по полному совпадению.
 
![search demo][SearchDemo] 
</details> 


 <details>
 <summary>Страницы ошибок</summary>
 
![error demo][ErrorDemo] 
</details> 

 <details>
 <summary>Демо адаптивности макета</summary>
 
![adaprive demo][AdapativeDemo] 
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
</details> 

## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>


[IndexDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/index_demo.gif>
[EditDeleteDetailProduct]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/edit_delete_detail_demo.gif>
[SearchDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/search_demo.gif>
[ErrorDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/demo_error.gif>
[AdapativeDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/adaprive_demo.gif>

[Screen1]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/2.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/3.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/4.png>
[Screen5]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/5.png>
[Screen6]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/6.png>
[Screen7]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/7.png>
[Screen8]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/8.png>
[Screen9]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/9.png>
[Screen10]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/screens/10.png>
