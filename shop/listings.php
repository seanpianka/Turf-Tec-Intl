<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/utils.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

$options = ['view_per_page' => '',
            'page_num' => 1,
            'max_page_num' => 1,
            'sort_by' => '',
            'show_out_of_stock' => False];

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

// Items to be viewed per page
if (!isset($_GET['per'])) 
{ 
    $options['view_per_page'] = "";
}
else
{
    $options['view_per_page'] = $_GET['per'];
}

$stmt = $db->prepare("SELECT * FROM Product WHERE category = ?;");
$stmt->bind_param('s', $selected_categories[0]);
$products = subgroup_array($db->execute($stmt), 3);
$pages = subgroup_array($products, $view_per_page);

$options['max_page_num'] = count($pages);

if (!isset($_GET['page_num'])) 
{ 
    $page_num = 1;
}
else
{
    $page_num = (int)($_GET['page_num']);

    // Bound the page number
    if ($page_num < 1) 
    { 
        $page_num = 1; 
    }
    else if ($page_num > $max_page_num)
    {
        $page_num = $max_page_num;
    }
}

if (!isset($_GET['sort'])) 
{ 
    $sort_by = "";
}
else
{
    // alphabetic, price
    $sort_by = $_GET['sort'];
}

if (!isset($_GET['ins'])) 
{ 
    $in_stock = "";
}
else
{
    // alphabetic, price
    $sort_by = $_GET['sort'];
}

$template = $twig->render(
    "products/product_listings.html.twig",
    array(
        "products" => $products,
        "product_categories" => $product_categories,
        "category" => $selected_categories,
        "SHOP_NAME_SHORT" => SHOP_NAME_SHORT,
    )
);
echo $template;
