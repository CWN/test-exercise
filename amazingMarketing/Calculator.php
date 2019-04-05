<?php

namespace amazingMarketing;

class Calculator
{
    private $order;
    private $discountManager;

    public function __construct(Order $order, DiscountManager $manager)
    {
        $this->order = $order;
        $this->discountManager = $manager;
    }

    public function calculate()
    {
        $this->discountManager->applyDiscounts($this->order);
        $totalCost = 0;
        /* @var $orderItems OrderItem[] */
        $orderItems = $this->order->getOrderItems();
        foreach ($orderItems as $item) {
            $totalCost += $item->getItemCostWithDiscount();
        }

        return $totalCost;
    }
}
