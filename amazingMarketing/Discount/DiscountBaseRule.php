<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;
use function get_class;

abstract class DiscountBaseRule implements DiscountRuleInterface
{
    protected $discountRate;
    protected $uniqueDiscountID;

    public function __construct($discount)
    {
        $this->discountRate = $discount;
        $this->uniqueDiscountID = get_class($this);
    }

    abstract public function applyDiscountRule(Order $order);
}
