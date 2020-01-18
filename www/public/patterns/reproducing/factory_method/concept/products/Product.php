<?php

namespace Products;

/**
 * Интерфейс Продукта объявляет операции, которые должны выполнять все
 * конкретные продукты.
 */
interface Product {
    public function operation(): string;
}