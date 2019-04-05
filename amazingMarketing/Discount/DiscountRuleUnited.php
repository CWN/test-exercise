<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;
use amazingMarketing\OrderItem;
use amazingMarketing\Product;

class DiscountRuleUnited extends DiscountBaseRule
{
    private $unitedProducts = array();

    public function __construct($discount, Product ...$products)
    {
        parent::__construct($discount);
        foreach ($products as $product) {
            $this->unitedProducts[$product->getName()] = -1;
        }
    }

    private function clearState()
    {
        foreach ($this->unitedProducts as $key => $value) {
            $this->unitedProducts[$key] = -1;
        }
    }

    public function applyDiscountRule(Order $order)
    {
        $this->clearState();
        /* @var $items OrderItem[] */
        $items = $order->getOrderItems();

        foreach ($items as $index => $item) {
            if ($item->isDiscounted()) {
                continue;
            }

            $productName = $item->getProduct()->getName();
            if (isset($this->unitedProducts[$productName]) && (-1 === $this->unitedProducts[$productName])) {
                $this->unitedProducts[$productName] = $index;
            }
        }

        $result = true;
        foreach ($this->unitedProducts as $name => $index) {
            $result = $result && (-1 !== $index);
        }

        if ($result) {
            foreach ($this->unitedProducts as $name => $index) {
                $items[$index]->setDiscountRate($this->discountRate, $this->uniqueDiscountID);
            }
        }

        return $result;
    }
}
