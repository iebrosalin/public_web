<?php
declare(strict_types=1);


namespace Creator;

use Products\ConcreteProduct2 as ConcreteProduct2;
use Products\Product as Product;


class ConcreteCreator2 extends Creator
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();
    }
}