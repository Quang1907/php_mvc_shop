<?php
function getAllProduct()
{
    $sql = 'select id,title,description, price from products';
    $result = getDB()->query($sql);
    if (!$result) {
        return [];
    };
    $products = [];
    while ($row = $result->fetch()) {
        $products[] = $row;
    }
    return $products;
}
