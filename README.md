# Symphony_news_crud_panel дата написания 08.

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
 
В общем что ни одного знакомого слова из списка требуемых технологий на тот момент времени в нём не было. Задание выполнил за 2 недели (1 неделю у меня отобрал Propel), а последующее собеседование провалил, но не из-за задания точно. 

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
 
![][] 
</details> 



[IndexDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/index_demo.gif>
[EditDeleteDetailProduct]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/edit_delete_detail_demo.gif>
[SearchDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/search_demo.gif>
[ErrorDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/demo_error.gif>
[AdapativeDemo]:<https://github.com/iebrosalin/public_web/blob/backend/symphony/news_crud_panel/descriptions/gif/adaprive_demo.gif>

[]:<>
