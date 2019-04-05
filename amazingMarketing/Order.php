<?php

namespace amazingMarketing;

class Order
{
    private $orderItems = array();
    private $originalCost;

    public function __construct()
    {
        $this->orderItems = [];
        $this->originalCost = 0;
        $this->totalSumDiscountRate = 0;
        $this->totalCost = 0;
    }

    public function addToCart(Product $product)
    {
        $this->orderItems[] = new OrderItem($product);
        $this->originalCost += $product->getPrice();
    }

    public function getCostWithoutDiscount()
    {
        return $this->originalCost;
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }
}
