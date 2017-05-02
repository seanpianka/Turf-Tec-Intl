<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

$template = $twig->render(
    "products/product_shop.html.twig",
    array(
        "product_categories" => $product_categories
    )
);
echo $template;
