<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;
use amazingMarketing\OrderItem;
use amazingMarketing\Product;
use function in_array;
use function pg_fetch_row;
use function reset;

class DiscountRuleMainProduct extends DiscountBaseRule
{
    private $mainName;
    private $products;

    public function __construct($discount, Product $mainProduct, Product ...$dependedProducts)
    {
        parent::__construct($discount);
        $this->mainName = $mainProduct->getName();
        foreach ($dependedProducts as $product) {
            $this->products[] = $product->getName();
        }
    }

    public function applyDiscountRule(Order $order)
    {
        /* @var $items OrderItem[] */
        $items = $order->getOrderItems();
        $item_exists = false;
        foreach ($items as $item) {
            if ($this->mainName === $item->getProduct()->getName()) {
                $item_exists = true;
                break;
            }
        }

        if (!$item_exists) {
            return false;
        }

        $item_exists = false;

        foreach ($items as $item) {
            $current_name = $item->getProduct()->getName();
            if (in_array($current_name, $this->products) && !$item->isDiscounted()) {
                $item->setDiscountRate($this->discountRate, $this->uniqueDiscountID);
                $item_exists = true;
            }
        }

        return $item_exists;
    }
}
