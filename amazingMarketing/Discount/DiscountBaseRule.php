<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

abstract class DiscountBaseRule implements DiscountRuleInterface
{
    protected $discountRate;

    public function __construct($discount)
    {
        $this->discountRate = $discount;
    }

    abstract public function calculate(Order $order);
}
