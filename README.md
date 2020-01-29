# Symphony_news_crud_panel дата написания 08.05.2018

Был написан тестовый сайт для хранения, добавления новостей.
 Использовались Symfony 3.4, Propel 2, Bootstrap, Twig, OpenServer. Основные функции доступные на сайте: поиск по характеристикам новости (только полное совпадение), CRUD функции.
  Присутствуют фейковые даные для тестирования функционала (fixture).
  

## Установка

Конфиг Apache сервера из OpenServer

```
<VirtualHost *:%httpport%>

    DocumentRoot    "%hostdir%/web"
    ServerName      "%host%"
    ServerAlias     "%host%" %aliases%
    ScriptAlias     /cgi-bin/ "%hostdir%/cgi-bin/"

</VirtualHost>
```

Установите пакеты: 
```php
composer install
```
 

Предполагается что БД будет называться news, а таблица article.

Заполнение БД фейковыми данными делается командой :

```php
php  bin/console propel:fixtures:load
```

