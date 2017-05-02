<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

$template = $twig->render(
    "frontpage/contact.html.twig", array(
        "product_categories" => $product_categories,
    )
);
echo $template;
