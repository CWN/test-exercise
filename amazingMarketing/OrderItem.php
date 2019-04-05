<?php

namespace amazingMarketing;

class OrderItem
{
    private $discountUniqueID;
    private $discountRate;
    private $resultPrice;
    private $product;

    public function __construct(Product $product)
    {
        $this->isDiscounted = false;
        $this->discountUniqueID = '';
        $this->resultPrice = $product->getPrice();
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

    public function isDiscountApplied()
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