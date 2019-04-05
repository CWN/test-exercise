<?php

namespace amazingMarketing;

class OrderItem
{
    private $discountUniqueID;
    private $discountRate;
    private $product;

    public function __construct(Product $product)
    {
        $this->discountUniqueID = '';
        $this->discountRate = 0;
        $this->product = $product;
    }

    public function setDiscountRate($rate, $discontUniqueID)
    {
        $this->discountRate = $rate;
        $this->discountUniqueID = $discontUniqueID;
    }

    public function getDiscountUniqueID()
    {
        return $this->discountUniqueID;
    }

    public function isDiscounted()
    {
        return isset($this->discountUniqueID) && !empty($this->discountUniqueID);
    }

    public function getItemCostWithDiscount()
    {
        return $this->product->getPrice() * (1 - $this->discountRate / 100);
    }

    public function getProduct()
    {
        return $this->product;
    }
}