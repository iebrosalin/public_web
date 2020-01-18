<?php
namespace Products;


/**
 * Конкретные Продукты предоставляют различные реализации интерфейса Продукта.
 */
class ConcreteProduct1 implements Product
{
    public function operation(): string
    {
        return "<button style='border: 0px; background-color: wheat; color: black'>ConcreteProduct1</button>";
    }
}