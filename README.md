# ToDo

Моё "Hello World!" в процессе изучения React. Приложение является todo-списком в котором можно с задачами выполнять следующие действия:

- Создавать задачи
- Выделять задачу задачу как важную (задача становится зелёной)
- Менять статус завершённости задачи по клику (задача будет перечёркнутой)  
- Удалять задачу из списка
- Искать задачи по названию
- Фильтровать задачи по статусам (сделано, не сделано)

Для управления состояними используются функциональныю компоненты, которые имеют чаще всего своё локальное состояние. Эта особенность говорит о том,что в приложении компоненты слабосвязаны между собой. В итоге состояние приложения вместе с его логикой получается достаточно фрагментированным из-за чего его расширение будет иметь свои сложности в случае усиления связей между компонентами.

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
  <summary>Скриншоты</summary>
  
  ![screen 1][Screen1]
  ![screen 2][Screen2]
  ![screen 3][Screen3]
  ![screen 4][Screen4]
  ![screen 5][Screen5]
  ![screen 6][Screen6]
  ![screen 7][Screen7]
  ![screen 8][Screen8]
</details>

## [Список всех моих проектов][ListAllMyProject]

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

License
----
MIT

[Demo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/gif/demo.gif>

[LocalhostDev]:<http://localhost:3000>
[LocalhostProduction]:<http://localhost:5000>

[Screen1]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/2.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/3.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/4.png>
[Screen5]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/5.png>
[Screen6]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/6.png>
[Screen7]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/7.png>
[Screen8]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/todo/descriptions/screens/8.png>
