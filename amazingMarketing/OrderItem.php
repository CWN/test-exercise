<?php

namespace amazingMarketing;

class OrderItem
{
    private $isDiscounted = false;
    private $discountRate;
    private $resultPrice;
    private $product;

    public function __construct(Product $product)
    {
        $this->isDiscounted = false;
        $this->discountRate = 0;
        $this->resultPrice = $product->getPrice();
        $this->product = $product;
    }

    public function setDiscountRate($rate)
    {
        $this->discountRate = $rate;
        $this->isDiscounted = true;
    }

    public function isDiscountApplied()
    {
        return $this->isDiscounted;
    }
}