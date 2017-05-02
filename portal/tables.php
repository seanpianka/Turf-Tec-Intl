<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/auth.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/products.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/twig.php');

function set_columns_hidden($table, $keywords)
{
    if (!$table || !$keywords) { return null; }

    for ($i = 0; $i < count($table['data']); ++$i)
    {

    }

    return $table;
}

$tables = array();

for ($i = 0; $i < count())


$template = $twig->render(
    "admin/portal_tables.html.twig",
    array(
        "product_categories" => $product_categories,
        "tables" => $tables
    )
);
echo $template;
