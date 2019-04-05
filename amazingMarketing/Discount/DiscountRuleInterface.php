<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

interface DiscountRuleInterface
{
    public function applyDiscountRule(Order $order);
}
