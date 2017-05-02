<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

$loader = new Twig_Loader_Filesystem('../templates/');
$twig = new Twig_Environment($loader);

$template = $twig->render(
    "frontpage/contact.html.twig", array(
        "product_categories" => $product_categories,
    )
);
echo $template;
