<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

class DiscountRuleMainProduct extends DiscountBaseRule
{
    private $main;
    private $products;

    public function __construct($discount, $mainProduct, ...$dependedProducts)
    {
        parent::__construct($discount);
        $this->main = $mainProduct;
        $this->products = $dependedProducts;
    }

    public function applyDiscountRule(Order $order)
    {
        // TODO: Implement calculate() method.
    }
}
