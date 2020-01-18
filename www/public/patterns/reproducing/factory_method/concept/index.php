<?php
declare(strict_types=1);
require_once  "vendor/autoload.php";

use Creator\ConcreteCreator1;
use Creator\ConcreteCreator2;
use Creator\Creator;





/**
 * Клиентский код работает с экземпляром конкретного создателя, хотя и через его
 * базовый интерфейс. Пока клиент продолжает работать с создателем через базовый
 * интерфейс, вы можете передать ему любой подкласс создателя.
 */
function clientCode(Creator $creator)
{
    // ...
    echo "Client: I'm not aware of the creator's class, but it still works.<br/>"
        . $creator->someOperation();
    // ...
}

/**
 * Приложение выбирает тип создателя в зависимости от конфигурации или среды.
 */
echo "App: Launched with the ConcreteCreator1.<br/>";
clientCode(new ConcreteCreator1());
echo "<br/><br/>";

echo "App: Launched with the ConcreteCreator2.<br/>";
clientCode(new ConcreteCreator2());