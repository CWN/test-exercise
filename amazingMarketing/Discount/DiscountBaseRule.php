<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

abstract class DiscountBaseRule implements DiscountRuleInterface
{
    protected $discountRate;
    protected $uniqueDiscountID;

    public function __construct($discount)
    {
        $this->discountRate = $discount;
        $this->uniqueDiscountID = \get_class($this);
    }

    abstract public function applyDiscountRule(Order $order);
}
