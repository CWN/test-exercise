<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;

interface DiscountRuleInterface
{
    public function calculate(Order $order);
}
