<?php
/*
 * Постановка тестовой задачи
 *
 * Есть продукты A, B, C, D, E, F, G, H, I, J, K, L, M. Каждый продукт стоит определенную сумму.
 * Есть набор правил расчета итоговой суммы:
 * 1. Если одновременно выбраны А и B, то их суммарная стоимость уменьшается на 10% (для каждой пары А и B)
 * 2. Если одновременно выбраны D и E, то их суммарная стоимость уменьшается на 6% (для каждой пары D и E)
 * 3. Если одновременно выбраны E, F, G, то их суммарная стоимость уменьшается на 3% (для каждой тройки E, F, G)
 * 4. Если одновременно выбраны А и один из [K, L, M], то стоимость выбранного продукта уменьшается на 5%
 * 5. Если пользователь выбрал одновременно 3 продукта, он получает скидку 5% от суммы заказа
 * 6. Если пользователь выбрал одновременно 4 продукта, он получает скидку 10% от суммы заказа
 * 7. Если пользователь выбрал одновременно 5 продуктов, он получает скидку 20% от суммы заказа
 * 8. Описанные скидки 5,6,7 не суммируются, применяется только одна из них
 * 9. Продукты A и C не участвуют в скидках 5,6,7
 * 10. Каждый товар может участвовать только в одной скидке. Скидки применяются последовательно в порядке описанном выше.
 *
 * Обязательные требования:
 *
 * Необходимо написать программу на PHP, которая, имея на входе набор продуктов (один продукт может встречаться несколько раз) рассчитывала суммарную
 * их стоимость.
 *
 * Программу необходимо написать максимально просто и максимально гибко. Учесть, что список продуктов практически не будет меняться, также как и
 * типы скидок. В то время как правила скидок (какие типы скидок к каким продуктам) будут меняться регулярно.
 *
 * Все параметры задаются в программе статически (пользовательский ввод обрабатывать не нужно).
 *
 * Оценивается подход к решению задачи.
 * Тщательное тестирование решения проводить не требуется.
 * Скрипты обязательно должны выполнять принципы SOLID.
 *
 * Необходимо использовать стандарты кодирования PSR http://www.php-fig.org/
 *
 */

namespace amazingMarketing;

use amazingMarketing\Discount\DiscountRuleMainProduct;
use amazingMarketing\Discount\DiscountRuleTotalSumWithExcludedProducts;
use amazingMarketing\Discount\DiscountRuleUnited;
use function ord;
use function print_r;

include_once __DIR__ . '/autoloader.php';
spl_autoload_register(function ($class) {
    loadClassByPrefix($class, 'amazingMarketing\\', __DIR__ . '/');
});

$aProduct = new Product('A', 1000);
$bProduct = new Product('B', 100);
$cProduct = new Product('C', 10);
$dProduct = new Product('D', 100);
$eProduct = new Product('E', 100);
$fProduct = new Product('F', 100);
$gProduct = new Product('G', 100);
$hProduct = new Product('H', 100);
$iProduct = new Product('I', 100);
$kProduct = new Product('K', 100);
$lProduct = new Product('L', 100);
$mProduct = new Product('M', 100);

$discountManager = new DiscountManager();
$discountManager->addRule(new DiscountRuleUnited(10, $aProduct, $bProduct));
$discountManager->addRule(new DiscountRuleUnited(6, $dProduct, $eProduct));
$discountManager->addRule(new DiscountRuleUnited(3, $eProduct, $fProduct, $gProduct));
$discountManager->addRule(new DiscountRuleMainProduct(5, $aProduct, $kProduct, $lProduct, $mProduct));
$discountManager->addRule(new DiscountRuleTotalSumWithExcludedProducts(5, 3, $aProduct, $cProduct));
$discountManager->addRule(new DiscountRuleTotalSumWithExcludedProducts(10, 4, $aProduct, $cProduct));
$discountManager->addRule(new DiscountRuleTotalSumWithExcludedProducts(20, 5, $aProduct, $cProduct));

$order = new Order();
$order->addToCart($aProduct);
$order->addToCart($bProduct);
$order->addToCart($dProduct);
$order->addToCart($fProduct);
$order->addToCart($lProduct);
$order->addToCart($eProduct);
$order->addToCart($gProduct);
$order->addToCart($kProduct);
$order->addToCart($cProduct);
$order->addToCart($hProduct);
$order->addToCart($mProduct);
$order->addToCart($iProduct);

$calculator = new Calculator($order, $discountManager);

echo $calculator->calculate() . "\n";
