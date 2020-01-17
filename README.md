# Re store (Redux store)

На примере примитивного интернет магазина, где предлагается собрать корзину из 2-ух товаров, показывается использование паттерна Redux. Централизованное управление состоянием приложения являются основной идей пет-проекта. Состояние всего приложения и логика приложения переносятся в reducers (объект хранящий другие reducer, специализирующиеся на решении задач своей предметной области). По итогу вместо вызова привычной функции с setState, происходит отправление экшена (события) в нужный reducer с входными параметрами, а потом получение готового состояния и его применение.

Технические особенности:

- Redux для централизованного управления состоянием приложения
- Примение middleware с помощью Redux Thunk
- Применение HOC
- Есть симуляция Exception 

По итогу получилось небольшое, но уже более совершенное приложения с точки  зрения архитектура и запаса прочности на будущее. К сожалению на сегодняшний день Redux+HOC является не единственным актуальным паттерном для управления состояниями. Есть альтернатива в виде [React hooks][ReactHooks], она ничем не хуже просто позволяет отойти от обёрток HOC. 

<details>
  <summary>Запуск production-версии</summary>
   
   ```bash
   npm install && npm run build && npm install -g serve && serve -s build
   ```
   
   Откройте в браузере [localhost:5000][LocalhostProduction] и наслаждайтесь.
</details>

<details>
  <summary>Запуск dev-версии</summary>
    
    ```bash
       npm install && npm run start
    ```
    
   Откройте в браузере [localhost:3000][LocalhostDev] и наслаждайтесь.
</details>

### Демонстрационный материал


 <details>
  <summary>Gif demo</summary>
  
  ![demo][Demo]
 </details> 

 <details>
  <summary>Gif adaptive demo</summary>
  
  ![adaptive demo][AdaptiveDemo]
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
 </details> 
 
## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[ReactHooks]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/README.md>

[LocalhostDev]:<http://localhost:3000>
[LocalhostProduction]:<http://localhost:5000>

[Demo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/gif/demo.gif>
[AdaptiveDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/gif/adaptive_demo.gif>

[Screen1]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/2.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/3.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/4.png>
[Screen5]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/5.png>
[Screen6]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/6.png>
[Screen7]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/re-store/descriptions/screens/7.png>
