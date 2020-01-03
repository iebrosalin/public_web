# Form websocket

Небольшая форма с применением websocket. Сделанная летом 2019 в период поиска работы.
## Небольшая история
По словам руководителя. Она нужна была для разработки страницы эквайринга (как минимум для отладки API занимающегося оплатой). Прототип формы я сделал быстро, отправил. Потом через пару дней я
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
npm install && node index.js
```
В последний раз тестировал на node.js v13.5.0.
## Демо
<details>
  <summary>Gif демо</summary>
  
  ![gif demo][GifDemo]
</details>
<details>
  <summary>Скриншоты</summary>
  
  ![first step screenshot][FirstStep]
  
  ![second step screenshot][SecondStep]
  
  ![third step screenshot][ThirdStep]
  
  ![fourth step screenshot][FourthStep]
</details>

License
----
MIT

**Free Software, Hell Yeah!**


[GifDemo]:<https://github.com/iebrosalin/web/blob/backend/pure_php/form_websocket/descriptions/demo.gif>
[FirstStep]:<https://github.com/iebrosalin/web/blob/backend/pure_php/form_websocket/descriptions/first_step.png>
[SecondStep]:<https://github.com/iebrosalin/web/blob/backend/pure_php/form_websocket/descriptions/second_step.png>
[ThirdStep]:<https://github.com/iebrosalin/web/blob/backend/pure_php/form_websocket/descriptions/third_step.png>
[FourthStep]:<https://github.com/iebrosalin/web/blob/backend/pure_php/form_websocket/descriptions/fourth_step.png>
[localhost]:<http://localhost:3000>
