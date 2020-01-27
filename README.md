# Web

В репозитории содержатся все пет-проекты из web-разработки. Большая часть  проектов посвящена разработке на PHP и немного на Js. Каждый проект имеет описание вместе с демонстрацией. Большая часть пректов появилась в результате изучения курсов, потому что учился всему сам (не у кого было учиться и надо было грести как можешь).

<details>
  <summary>Пара слов про качество кода и немного истории</summary>
  

  Web-разработка стала для меня одной из любимых сфер программирования с декабря 2017 г. До этого пробовал себя компьютерном зрении, машинном обучении - не зацепила меня магия математики. С/С++, Java, Python - языки оставшиеся для меня в прошлом, так как решаемые задачи меня не зацепили. 
  
  Коммерческой разработкой начал заниматься с мая 2018 совмещая с учёбой в вузе. В период учёбы кодил как мог, применяя в бою недавно прочитанное или что-то нарушающее принципы хорошего кода.
  
  Серъёзной разработкой с контролем качества кода я смог только в сентябре 2019 после выпуска из вуза смены пары мест работы. Full-time я работал как Flutter-разработчик в [Progressive Mobile][Pmobi] до конца 2019, где применялась Clean архитектура. 
  
  Моё мировозрение изменилось. Чочется весь свой старый код переписать, но мои знания архитектуры применимы к задачам мобильной разработки. У backend на PHP есть своя специфика помноженная на реализации с помощью конкретных инструментов. В итоге получается не самый простой вопрос требующий знания инструмента реализации и теории. Я вижу, чувствую проблемные места в коде, но хорошее и проверенное решение не могу предложить, есть только непроверенные эксперементальные решения.
  
   Стараюсь самостоятельно учиться даже если отсутвует опытный разработчик,рок-звезда, мастер, сенпай, ментор. Сейчас учу Laravel  с последующей практикой паттернов проектирования (нашёл классный курс выходящий ещё совмешающий постепенное написание нормального кода и архитектуру). Эта стратегия позволят постепенно закрыть большое количество вопросов о существующих практиках в языке и познать интересующий инструмент.
   
</details>  



<details>
  <summary>Backend</summary>
  
  Чистое PHP

  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |12.2017            |[First site][ToDo]            |-       | Mysql     |:white_check_mark:|
  |05.2018            |[Vedomost][ToDo]              |-       | Mysql     |:white_check_mark:|
  |01.2019            |[Diplom][ToDo]                |-       | Mysql     ||
  |04.2019            |[Bad SPA][ToDo]               |-       | Mysql     ||
  |07.2019            |[Sandbox][ToDo]               |-       | Mysql     ||
  |07.2019            |[Sandbox PostgreSQL][ToDo]    |+       | PostgreSQL|:white_check_mark:|
  |01.2020            |[Shvec patterns][ToDo]        |+       | -         ||
  
  Symfony
  
  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |05.2018            |[News CRUD][ToDo]             |-       | Mysql     |:white_check_mark:|

  Bitrix
  
  |месяц.год период создания |Название                      |Завершённость     |
  |--------------------------|------------------------------|------------------|
  |05.2018 - 07.2019         |[Bitrix samples][ToDo]        |:white_check_mark:|
  
  Wordpress
  
  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |01.2019            |[Wordpress samples][ToDo]     |-       | Mysql     ||

  ZF1
  
  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |02.2019            |[Theory (Попов)][ToDo]        |-       | Mysql     |:white_check_mark:|

  Laravel
  
  |месяц.год создания |Название                                           | Docker |Db         |Завершённость     |
  |-------------------|---------------------------------------------------|--------|-----------|------------------|
  |07.2019            |[Eliseev master class][EliseevLaravelMasterClass]  |+       | Mysql     ||
  |01.2020            |[Afanasyev season 1][AfanasyevSeason1]             |-       | Mysql     |:white_check_mark:|
  |01.2020            |[Afanasyev season 2][AfanasyevSeason2]             |-       | Mysql     ||
  |01.2020            |[Afanasyev patterns][AfanasyevPatterns]            |-       | Mysql     ||

  Yii2
  
  |месяц.год создания |Название                       | Docker |Db         |Завершённость     |
  |-------------------|------------------------------ |--------|-----------|------------------|
  |08.2019            |[Theory (WebForMySelf)][ToDo]  |+       | Mysql     |:white_check_mark:|
  |01.2020            |[Practice (WebForMySelf)][ToDo]|-       | Mysql     |:white_check_mark:|

</details>  

<details>
  <summary>Frontend</summary>
  
  Для меня frontend является дополнительным, но обязательным умением. В моём опыте коммерческой работе были я исполнял роль backend-разработчика, так что почти всегда я имел готовую вёрстку или существующий проект из-за чего создание чего я не концентрировался на создании уникального UI. 
  
 В ходе работы я естественно сталкивался с js, jquery, bootstrap, по мере необходимости самообразовывался и применял знания на практике для заказчика. Изучение React (в свободное время) не только открывала новые и незаменимые на сегодняшний день инструменты являющиеся стандратом де-факто, но и знакомила с архитектурами управления состояними в UI-компонентах. Так уж получилось, что [курс по React][ReactCourse], который я покупал он дополнялся постоянно, поэтому есть значительные перерывы. Курс мне понравился очень сильно, так как действительно помог понять основы React без ментора. Не знание TS - это ерунда, так как синтаксис Dart и TS схожи.
 
 В таблице представлены все мои пет-проекты, которые можно строго отнести к frontend-разработке.
  
  |месяц.год создания |Название                      | Js                       |CSS         |Завершённость     |
  |-------------------|------------------------------|--------------------------|------------|------------------|
  |02.2019            |[ToDo][ToDo]                  |React                     | Bootstrap  |:white_check_mark:|
  |02.2019            |[Star Wars wiki][StarWarsWiki]|React + HOC               | Bootstrap  |:white_check_mark:|
  |07.2019            |[Re store][ReStore]           |React + HOC + Redux       | Bootstrap  |:white_check_mark:|
  |08.2019            |[Form websocket][FormWS]      |pure js                   | Bootstrap  |:white_check_mark:|
  |01.2020            |[Sandbox build][SandboxBuild] |pure js + babel + webpack | SCSS       |:white_check_mark:|
  |01.2020            |[React hooks][ReactHooks]     |React hooks               | Bootstrap  |:white_check_mark:|

</details>   


## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[Pmobi]:<https://pmobi.ru/>



[EliseevLaravelMasterClass]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/season1>
[AfanasyevSeason1]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/season1>
[AfanasyevSeason2]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/season2>
[AfanasyevPatterns]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/patterns>

[FormWS]:<https://github.com/iebrosalin/public_web/tree/frontend/form_websocket>
[ToDo]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/todo>
[StarWarsWiki]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/star-wars-db>
[ReStore]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/re-store>
[SandboxBuild]:<https://github.com/iebrosalin/public_web/tree/frontend/sandbox-build>
[ReactHooks]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/hooks>

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>
[ReactCourse]:<https://www.udemy.com/course/pro-react-redux/>
