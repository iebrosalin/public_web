<?php

namespace Products;


class ConcreteProduct2 implements Product
{
    public function operation(): string
    {
        return "<button style='border: 0px; background-color: #0f0e31; color: #fff '>ConcreteProduct2</button>";
    }
}
