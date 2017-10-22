<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');


$frontpage_products = array();
$result = $db->query("SELECT * FROM Product ORDER BY RAND() LIMIT 3");
for ($i = 0; $i < count($result); ++$i)
{
    array_push($frontpage_products, $result[$i]);
}

$template = $twig->render(
    "products/product_shop.html.twig",
    array(
        "product_categories" => $product_categories,
        "frontpage_products" => $frontpage_products,
        "SHOP_NAME_SHORT" => SHOP_NAME_SHORT,
    )
);
echo $template;
