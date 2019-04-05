<?php

namespace amazingMarketing;

use amazingMarketing\Discount\DiscountBaseRule;
use function var_dump;

class DiscountManager
{
    private $discountRules = array();

    public function __construct()
    {
        $this->discountRules = [];
    }

    public function addRule(DiscountBaseRule $rule)
    {
        $this->discountRules[] = $rule;
    }

    public function applyDiscounts(Order $order)
    {
        foreach ($this->discountRules as $rule) {
            $applyResult = true;
            while ($applyResult) {
                $applyResult = $rule->applyDiscountRule($order);
            };
        }

        var_dump($order->getOrderItems());
    }
}
