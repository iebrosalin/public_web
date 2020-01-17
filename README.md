# React hooks

В проекте собраны примеры использования хуков. В последующем будущем я смогу на их базе отрефакторить уже существующие пет-проекты.

2019 год для React был прекрасным, так как вышли в реализ вышла фича как хуки. Разве что только из чайника не говорили об этом. Основная идея заключается в эксплуатации функциональных компонентов и применении хуков для управления жизненным циклом компонента. На практике по мере роста сложности функциональности получается комбинацияиз хуков использующие друг друга в зависимости от того изменилась ли какая-то переменная или произошёл unmount компонента. Следствие действия хука называют аффектом (внешним влиянием).

В проекте рассмотрено несколько хуков:

- useState на примере изменения стилей у блока страницы
- useEffect для имитации исчезающего уведомления
- useEffect для загрузки имени персонажа по его id из [swapi.co][SwapiCo]
  - useCallback для отслеживания изменения функции
  - useMemo для отслеживания изменения переменной 

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
  <summary>Full gif demo</summary>
  
  ![full demo][FullDemo]
</details>  

<details>
  <summary>useState gif demo</summary>
  
  ![useState demo][UseStateDemo]
</details>  

<details>
  <summary>useEffect notification gif demo</summary>
  
  ![useEffect notification demo][UseEffectNotification]
</details>  

<details>
  <summary>useEffect person name gif demo</summary>
  
  ![useEffect person name demo][UseEffectPersonName]
</details>  

<details>
  <summary>Скриншоты</summary>
  
  ![screen 1][Screens1]
  ![screen 2][Screens2]
  ![screen 3][Screens3]
  ![screen 4][Screens4]
  ![screen 5][Screens5]
  ![screen 6][Screens6]
</details>  


## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[SwapiCo]:<https://swapi.co>

[FullDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/gif/full_demo.gif>
[UseStateDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/gif/useState_demo.gif>
[UseEffectNotification]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/gif/useEffect_notification_demo.gif>
[UseEffectPersonName]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/gif/useEffect_person_name_demo.gif>

[Screens1]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/1.png>
[Screens2]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/2.png>
[Screens3]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/3.png>
[Screens4]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/4.png>
[Screens5]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/5.png>
[Screens6]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/hooks/descriptions/screens/6.png>
