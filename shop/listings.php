<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

$valid_category = false;
foreach($product_categories as $category)
{
    if (!isset($_GET['category'])) { header('Location: /shop/'); }
    if ($_GET['category'] == $category[0])
    {
        $selected_categories = $category;
        $valid_category = true;
        break;
    }
}
if (!$valid_category) { header('Location: /'); }

$stmt = $db->prepare("SELECT * FROM Product WHERE category = ?;");
$stmt->bind_param('s', $selected_categories[0]);
$products = subgroup_array($db->execute($stmt), 3);


$template = $twig->render(
    "products/product_listings.html.twig",
    array(
        "products" => $products,
        "product_categories" => $product_categories,
        "category" => $selected_categories
    )
);
echo $template;
