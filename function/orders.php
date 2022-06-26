<?php

function createOrder($userId, $cartItems, $status = "paymentOnDelivery")
{
    $sql = 'INSERT INTO ORDERS SET status = :status, user_id = :userId';
    $statement = getDB()->prepare($sql);
    $data = [
        ':userId' => $userId,
        ':status' => $status,
    ];
    $statement->execute($data);
    $orderId = getDB()->lastInsertId();

    $sql = 'INSERT INTO ORDER_PRODUCT SET 
        title = :title, quantity = :quantity, price = :price, taxInPercent = :taxInPercent, order_id = :orderId
    ';
    $statement = getDB()->prepare($sql);
    foreach ($cartItems as $cartItem) {
        $taxInPercent = 19;
        $price = $cartItem['price'];
        $netPrice = 100 - ($taxInPercent / 100) * $price;
        $data = [
            ':title' => $cartItem['title'],
            ':quantity' => $cartItem['quantity'],
            ':price' => $netPrice,
            ':taxInPercent' => 19,
            ':orderId' => $orderId,
        ];
        $statement->execute($data);
    }
    return true;
}
