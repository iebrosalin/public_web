# Web

В репозитории содержатся все пет-проекты из web-разработки. Большая часть  проектов посвящена разработке на PHP и немного на Js. Каждый проект имеет описание вместе с демонстрацией. Большая часть проектов появилась в результате изучения курсов, потому что учился всему сам (не у кого было учиться на работе и надо было код в продакшн заливать).

<details>
  <summary>Пара слов про качество кода и немного истории</summary>
  
  Web-разработка стала для меня одной из любимых сфер программирования с декабря 2017 г. До этого пробовал себя компьютерном зрении, машинном обучении - не зацепило. С/С++, Java, Python - языки с которыми я сталкивался в ходе поиска. 
  
  Коммерческой разработкой начал заниматься с мая 2018 совмещая с учёбой в вузе. В период учёбы кодил как мог, применяя в бою недавно прочитанное или что-то нарушающее принципы хорошего кода.
  
  Серьёзной разработкой с контролем качества кода я смог только в сентябре 2019 после выпуска из вуза смены пары мест работы. Full-time я работал как Flutter-разработчик в [Progressive Mobile][Pmobi] до конца 2019, где применялась Clean архитектура. 
  
  После работы в [Progressive Mobile][Pmobi] моё мировоззрение на код изменилось. У меня получилось сделать шажок к чистому коду, который вряд ли бы я самостоятельно смог сделать.
  
   Стараюсь самостоятельно учиться даже если отсутствует опытный разработчик,рок-звезда, мастер, сенпай, ментор. Сейчас учу Laravel  с последующей практикой паттернов проектирования (нашёл классный курс выходящий ещё совмещающий постепенное написание нормального кода и архитектуру). Эта стратегия позволят постепенно закрыть большое количество вопросов о существующих практиках в языке и познать интересующий инструмент.
</details>  

<details>
  <summary>Backend</summary>
  
 #### Чистое PHP

  |месяц.год создания |Название                                    | Docker |Db         |Завершённость     |
  |-------------------|--------------------------------------------|--------|-----------|------------------|
  |12.2017            |[First site][PurePHPFirstSite]              |-       | MySQL     |:white_check_mark:|
  |05.2018            |[Vedomost][PurePHPVedomost]                 |-       | MySQL     |:white_check_mark:|
  |04.2019            |[Bad SPA][BadSPA]                           |-       | MySQL     |:skull_and_crossbones:|
  |07.2019            |[Sandbox][PurePHPSandbox]                   |+       | MySQL     |:white_check_mark:|
  |07.2019            |[Sandbox PostgreSQL][HandbookPostgresql]    |+       | PostgreSQL|:white_check_mark:|
  |08.2019            |[Mail checker][MailCheck]                   |+       | -         |:white_check_mark:|
  |01.2020            |[Shvec patterns][ShvecTheory]               |+       | -         ||
  |01.2020            |[Drafts][Drafts]                            |-       | -         ||
  
 #### Symfony
  
  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |05.2018            |[News CRUD][SymphonyNewsCrud] |-       | MySQL     |:white_check_mark:|

 #### Bitrix
  
  |месяц.год период создания |Название                      |Завершённость     |
  |--------------------------|------------------------------|------------------|
  |02.2019                   |[Bitrix samples][Bitrix]      |:white_check_mark:|

 #### ZF1
  
  |месяц.год создания |Название                      | Docker |Db         |Завершённость     |
  |-------------------|------------------------------|--------|-----------|------------------|
  |02.2019            |[Theory][ZfTherory]           |-       | MySQL     |:white_check_mark:|

####  Laravel
  
  |месяц.год создания |Название                                           | Docker |Db         |Завершённость     |
  |-------------------|---------------------------------------------------|--------|-----------|------------------|
  |07.2019            |[Eliseev master class][EliseevLaravelMasterClass]  |+       |PostgreSQL|:skull_and_crossbones:|
  |01.2020            |[Afanasyev season 1][AfanasyevSeason1]             |-       | MySQL     |:white_check_mark:|
  |01.2020            |[Afanasyev season 2][AfanasyevSeason2]             |-       | MySQL     ||
  |01.2020            |[Afanasyev patterns][AfanasyevPatterns]            |-       | MySQL     ||

####  Yii2
  
  |месяц.год создания |Название                       | Docker |Db         |Завершённость     |
  |-------------------|------------------------------ |--------|-----------|------------------|
  |08.2019            |[Theory][Yii2Theory]           |+       | MySQL     |:white_check_mark:|
  |01.2020            |[Practice][Yii2Practice]       |-       | MySQL     |:white_check_mark:|

</details>  

<details>
  <summary>Frontend</summary>
  
  Для меня frontend является дополнительным, но важным умением. В коммерческой разработке я исполнял роль backend-разработчика, так что почти всегда я имел готовую вёрстку или существующий проект из-за чего frontend-разработке уделял меньше внимания. 
  
 В ходе работы я естественно сталкивался с Js, jQuery, Bootstrap, по мере необходимости учился и применял знания на практике для заказчика. Изучение React (в свободное время) не только открывала новые и незаменимые на сегодняшний день инструменты являющиеся стандартом де-факто, но и знакомила с архитектурами управления состояниями в UI-компонентах. Так уж получилось, что [курс по React][ReactCourse], который я покупал он дополнялся постоянно, поэтому есть значительные перерывы. Курс мне понравился очень сильно.
 
 В таблице представлены все мои пет-проекты, которые можно строго отнести к frontend-разработке.
  
  |месяц.год создания |Название                      | Js                       |CSS         |Завершённость     |
  |-------------------|------------------------------|--------------------------|------------|------------------|
  |02.2019            |[ToDo][ToDo]                  |React                     | Bootstrap  |:white_check_mark:|
  |02.2019            |[Star Wars wiki][StarWarsWiki]|React + HOC               | Bootstrap  |:white_check_mark:|
  |07.2019            |[Re store][ReStore]           |React + HOC + Redux       | Bootstrap  |:white_check_mark:|
  |08.2019            |[Form websocket][FormWS]      |pure js                   | Bootstrap  |:white_check_mark:|
  |01.2020            |[Sandbox build][SandboxBuild] |pure js + babel + Webpack | SCSS       |:white_check_mark:|
  |01.2020            |[React hooks][ReactHooks]     |React hooks               | Bootstrap  |:white_check_mark:|

</details>   


## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[Pmobi]:<https://pmobi.ru/>

[PurePHPFirstSite]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/first_site>
[PurePHPVedomost]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/vedomost>
[BadSPA]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/bad_spa>
[PurePHPSandbox]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/sandbox>
[MailCheck]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/mail_check>
[HandbookPostgresql]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/handbook_postgresql>
[ShvecTheory]:<https://github.com/iebrosalin/public_web/tree/backend/theory/shvec>
[Drafts]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/drafts>

[EliseevLaravelMasterClass]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/eliseev>
[AfanasyevSeason1]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/season1>
[AfanasyevSeason2]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/season2>
[AfanasyevPatterns]:<https://github.com/iebrosalin/public_web/tree/backend/laravel/afanasyev/patterns>

[Yii2Theory]:<https://github.com/iebrosalin/public_web/tree/backend/yii2/theory>
[Yii2Practice]:<https://github.com/iebrosalin/public_web/tree/backend/yii2/practice>

[ZfTherory]:<https://github.com/iebrosalin/public_web/tree/backend/zf/theory>

[Bitrix]:<https://github.com/iebrosalin/public_web/tree/backend/bitrix>
[SymphonyNewsCrud]:<https://github.com/iebrosalin/public_web/tree/backend/symphony/news_crud_panel>

[FormWS]:<https://github.com/iebrosalin/public_web/tree/frontend/form_websocket>
[ToDo]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/todo>
[StarWarsWiki]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/star-wars-db>
[ReStore]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/re-store>
[SandboxBuild]:<https://github.com/iebrosalin/public_web/tree/frontend/sandbox-build>
[ReactHooks]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/hooks>

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>
[ReactCourse]:<https://www.udemy.com/course/pro-react-redux/>
