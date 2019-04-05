<?php

namespace amazingMarketing\Discount;

use amazingMarketing\Order;
use amazingMarketing\OrderItem;
use amazingMarketing\Product;

class DiscountRuleTotalSumWithExcludedProducts extends DiscountBaseRule
{
    private $itemsCount;
    private $excludedProducts = array();

    public function __construct($discount, $count, Product ...$excludedProducts)
    {
        parent::__construct($discount);

        $this->itemsCount = $count;
        $this->excludedProducts = [];
        foreach ($excludedProducts as $product) {
            $this->excludedProducts[] = $product->getName();
        }
    }

    public function applyDiscountRule(Order $order)
    {
        /* @var $items OrderItem[] */
        $items = $order->getOrderItems();
        $itemNeedToApply = array();
        $itemNeedToReApply = array();

        foreach ($items as $index => $item) {
            $uniqueRuleID = $item->getDiscountUniqueID();
            if (!empty($uniqueRuleID) && ($uniqueRuleID !== $this->uniqueDiscountID)) {
                continue;
            }

            if (\in_array($item->getProduct()->getName(), $this->excludedProducts)) {
                continue;
            }

            if ($uniqueRuleID == $this->uniqueDiscountID) {
                $itemNeedToReApply[] = $index;
            } else {
                $itemNeedToApply[] = $index;
            }
        }

        if (\count($itemNeedToReApply) >= $this->itemsCount) {
            return false;
        }
        $itemNeedToApply = \array_merge($itemNeedToReApply, $itemNeedToApply);

        $result = false;
        if (\count($itemNeedToApply) >= $this->itemsCount) {
            $result = true;
            for ($i = 0; $i < $this->itemsCount; $i++) {
                $items[$itemNeedToApply[$i]]->setDiscountRate($this->discountRate, $this->uniqueDiscountID);
            }
        }

        return $result;
    }
}
