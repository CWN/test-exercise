<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

class DiscountRuleTotalSumWithExcludedProducts extends DiscountBaseRule
{
    private $itemsCount;
    private $excludedProducts = array();

    public function __construct($discount, $count, ...$excludedProducts)
    {
        parent::__construct($discount);

        $this->itemsCount = $count;
        $this->excludedProducts = [];
        foreach ($excludedProducts as $product) {
            $this->excludedProducts[] = $product;
        }
    }

    public function applyDiscountRule(Order $order)
    {
        // TODO: Implement calculate() method.
    }
}
