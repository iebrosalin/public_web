# Star wars wiki

Вторым приложением в рамках изучения React стала упрощённая википедия по вселенной "Звёздные войны". Основной функционал приложения:

- Переходы между страницами (routing)
- Отображение случайной планеты
- Просмотр детальной информации о персонажах, планетах, короблях
- Места где много свободного вследствии непродуманности дизайна имеют рекламную заглушку

Демонстрируется случай усиления связи между компонентами, дабы избавится от фрагментации логики управления и состояний как в [предудщем проекте (todo)][ToDo] было приято решение собрать состояние в один компонент App и передавать по дереву компонентов нужные состояния и callback его изменения. 

Технические особенности:

- Взаимодействие с REST API [swapi.co][SwapiCo],с fetch вместо ajax
- Использование методов жизненного цикла
- Применение паттерна HOC для повышения переиспользования кода
- Применение Context API, что позволило упростить передачу параметров компонентам

По итогу получилось более сложное приложение чем список дел. У приложения есть глобальный недостаток мешающий усложняющее будущую разработку - это фрагментация логики и цепочки передачи параметров.

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
  <summary>Gif demo desctop version</summary>
  
  ![desctop demo][DesctopDemo]
 </details> 
 
 <details>
  <summary>Gif demo mobile version</summary>
  
  ![mobile demo][MobileDemo]
 </details> 

 <details>
  <summary>Screenshots desctop version</summary>
  
  ![desctop loader welcome][DesctopLoaderWelcome]
  ![desctop welcome][DesctopWelcome]
  ![desctop loader starships][DesctopLoaderStarships]
  ![desctop list starships][DesctopListStarships]
  ![detail starship][DetailStarship]
  ![desctop loader lists][DesctopLoaderLists]
  ![desctop detail people][DesctopDetailPeople]
  ![desctop error][DesctopError]
 </details> 

 <details>
  <summary>Screenshots mobile version</summary>
  
  ![mobile welcome][MobileWelcome]
  ![mobile loader welcome][MobileLoaderWelcome]
  ![mobile list loader][MobileListLoader]
  ![mobile list peoples][MobileListPeoples]
  ![mobile detail planet][MobileDetailPlanet]
  ![mobile list starships][MobileListStarships]
  ![mobile detail starsheep][MobileDetailStarship]
  ![mobile error][MobileError]
 </details> 

## [Список всех моих проектов][ListAllMyProject]

License
----
MIT

[ListAllMyProject]:<https://github.com/iebrosalin/all_public_projects>

[ToDo]:<https://github.com/iebrosalin/public_web/tree/frontend/react/bura/todo>
[SwapiCo]:<https://swapi.co>

[LocalhostDev]:<http://localhost:3000>
[LocalhostProduction]:<http://localhost:5000>

[DesctopDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/gif/adaptive/desctop/desctop_demo.gif>
[MobileDemo]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/gif/adaptive/phone/phone_demo.gif>

[DesctopWelcome]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_welcome.png>
[DesctopLoaderWelcome]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_loader_welcome.png>
[DesctopLoaderStarships]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_loader_starships.png>
[DesctopListStarships]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_list_starships.png>
[DetailStarship]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_detail_starship.png>
[DesctopLoaderLists]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_loader_lists.png>
[DesctopDetailPeople]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_detail_people.png>
[DesctopError]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/desctop/desctop_error.png>

[MobileWelcome]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_welcome.png>
[MobileLoaderWelcome]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_loader_welcome.png>
[MobileListLoader]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_loader_lists.png>
[MobileListPeoples]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_list_peoples.png>
[MobileDetailPeople]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_detail_people.png>
[MobileDetailPlanet]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_detail_planet.png>
[MobileListStarships]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_list_starships.png>
[MobileDetailStarship]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_detail_starship.png>
[MobileError]:<https://github.com/iebrosalin/public_web/blob/frontend/react/bura/star-wars-db/descriptions/screens/adaptive/phone/phone_error.png>
