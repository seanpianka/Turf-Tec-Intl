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

$stmt = $db->prepare("SELECT * FROM Product WHERE category = ? AND model = ?");
$stmt->bind_param('ss', $selected_categories[0], $_GET['product_model']);
$product = $db->execute($stmt)[0];

$template = $twig->render(
    "products/product_page.html.twig",
    array(
        "product" => $product,
        "product_categories" => $product_categories,
        "SHOP_NAME_SHORT" => SHOP_NAME_SHORT
    )
);
echo $template;
