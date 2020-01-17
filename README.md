# Sandbox build

Подготовка среды для сборки проекта является обязательным умением для всех кто работает с современным js.

В проекте продемонстрирована сборка проекта являющейся демонстрацией нескольких случайных пар картинок. Взаимодействие состоит следующих шагов:

1. Пользователь загружает страницу, происходит генерация последовательности пар картинок с отображением лоадера
2. После окончания генерации последовательности показывается несколько пар картинок
3. По окончанию демонстрации пользователя об этом уведомляется. Для начала новой демонстрации предлагается обновить страницу

Технические особенности:

- Babel
- Browserlist
- Npm-scripts
- Webpack + плагины
  - babel-loader
  - css-loader
  - file-loader
  - html-webpack-plugin (выводится в футере дата сборки)
  - mini-css-extract-plugin
  - node-sass
  - sass-loader
  - style-loader
- Dev/production конфигурации
- Webpack-dev-server


<details>
  <summary>Запуск production-версии</summary>
   
   ```bash
   npm install && npm run build && npm i serve && serve dist
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

## Демонстрационный материал

<details>
  <summary>Gif demo</summary>
  
  ![demo][Demo]
</details>

<details>
  <summary>Демонстрация адаптивности</summary>
  
  ![adaptive demo][AdaptiveDemo]
</details>


<details>
  <summary>Скриншоты</summary>
  
  ![scren 1][Screen1]
  ![scren 2][Screen2]
  ![scren 3][Screen3]
  ![scren 4][Screen4]
</details>


## [Список всех моих проектов][ListAllMyProject]

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[LocalhostDev]:<http://localhost:3000>
[LocalhostProduction]:<http://localhost:5000>

[Demo]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/gif/demo.gif>
[AdaptiveDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/gif/adaptive_demo.gif>

[Screen1]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/screens/1.png>
[Screen2]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/screens/2.png>
[Screen3]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/screens/3.png>
[Screen4]:<https://github.com/iebrosalin/public_web/blob/frontend/sandbox-build/descriptions/screens/4.png>
