<?php

namespace amazingMarketing;

use amazingMarketing\Discount\DiscountBaseRule;

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
}
