<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;
use amazingMarketing\Product;

class DiscountRuleUnited extends DiscountBaseRule
{
    private $unitedProducts = array();

    public function __construct($discount, Product ...$products)
    {
        parent::__construct($discount);
        foreach ($products as $product) {
            $this->unitedProducts[] = $product;
        }
    }

    public function calculate(Order $order)
    {
        // TODO: Implement calculate() method.
    }
}