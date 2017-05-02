<?php

require_once('includes/auth.php');
require_once('includes/products.php');
require_once('vendor/autoload.php');

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);

$template = $twig->render(
    "frontpage/index.html.twig",
    array(
        "product_categories" => $product_categories
    )
);
echo $template;
