<?php

require_once('query.php');

$result = $db->query("SELECT DISTINCT category FROM Product;");

$product_categories = array();
for ($i = 0; $i < count($result); ++$i)
{
    array_push($product_categories, array(
        $result[$i]['category'], ucwords(str_replace('_', ' ', $result[$i]['category']))
    ));
}
