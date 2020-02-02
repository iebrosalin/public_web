# Form websocket

Небольшая форма с применением websocket. Сделанная летом 2019 в период поиска работы. От этого же работодателя сделал [другой проект][MailCheck], но схожей по тематике. 
## Небольшая история
По словам руководителя. Форма нужна была для разработки страницы эквайринга (как минимум для отладки API занимающегося оплатой). Прототип формы я сделал быстро, отправил. Потом через пару дней я
 получил предложение о работе (другой работодатель) от которого не хотел отказываться.
 
Заполнение формы (валидацию, масок от меня не требовали) состоит из 3-ух шагов: 
  - Заполнение данных, потом показывается лоадер, 
  - Ввод некого проверочного кода (вводится что угодно),
  - Сообщение об успешном заполнении формы

## Технологическая ремарка
Node.js - это не моя прихоть, впервый раз на ноде писал.

## Установка
Введите команду в терминале из корня проекта и открывайте [localhost:3000][localhost]
```bash
npm install && npm run start
```
В последний раз тестировал на node.js v13.5.0.
## Демо

<details>
  <summary>Gif демо</summary>
  
  ![gif demo][GifDemo]
</details>

<details>
  <summary>Gif демо адаптивности</summary>
  
  ![gif adaptive demo][GifAdaptiveDemo]
</details>

<details>
  <summary>Скриншоты</summary>
  
  ![first step screenshot][FirstStep]
  
  ![second step screenshot][SecondStep]
  
  ![third step screenshot][ThirdStep]
  
  ![fourth step screenshot][FourthStep]
</details>

<details>
  <summary>Скриншоты демо адаптивности</summary>
  
  ![xl][XL]
  
  ![lg][LG]
  
  ![md][MD]
  
  ![xs][XS]
</details>

## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[MailCheck]:<https://github.com/iebrosalin/public_web/tree/backend/pure_php/mail_check>

[GifDemo]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/form_websocket/descriptions/demo.gif>
[GifAdaptiveDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/form_websocket/descriptions/adaptive_demo.gif>

[FirstStep]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/form_websocket/descriptions/first_step.png>
[SecondStep]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/form_websocket/descriptions/second_step.png>
[ThirdStep]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/form_websocket/descriptions/third_step.png>
[FourthStep]:<https://github.com/iebrosalin/public_web/blob/backend/pure_php/form_websocket/descriptions/fourth_step.png>

[XL]:<https://github.com/iebrosalin/public_web/blob/frontend/form_websocket/descriptions/xl.png>
[LG]:<https://github.com/iebrosalin/public_web/blob/frontend/form_websocket/descriptions/lg.png>
[MD]:<https://github.com/iebrosalin/public_web/blob/frontend/form_websocket/descriptions/md.png>
[XS]:<https://github.com/iebrosalin/public_web/blob/frontend/form_websocket/descriptions/xs.png>

[localhost]:<http://localhost:3000>
