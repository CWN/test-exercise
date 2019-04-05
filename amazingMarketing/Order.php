<?php

namespace amazingMarketing;

class Order
{
    private $productList = array();

    public function __construct()
    {
        $this->productList = [];
    }

    public function addToCart(Product $product)
    {
        $this->productList = $product;
    }

    public function getProductList()
    {
        return $this->productList;
    }
}
