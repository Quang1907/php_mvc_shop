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
        $taxInPercent = 10;
        $price = $cartItem['price'];
        $netPrice = $price - ($price / $taxInPercent);
        $data = [
            ':title' => $cartItem['title'],
            ':quantity' => $cartItem['quantity'],
            ':price' => $netPrice,
            ':taxInPercent' => 10,
            ':orderId' => $orderId,
        ];
        $statement->execute($data);
    }
    return true;
}

function getOrderForUser($orderId, $userId)
{
    $sql = "SELECT id, orderDate, status, user_id 
    FROM ORDERS WHERE id = :orderId AND user_id = :userId LIMIT 1";
    $statement = getDB()->prepare($sql);
    if ($statement == false) {
        echo printDBErrorMessage();
        return null;
    }
    $data = [
        ':orderId' => $orderId,
        ':userId' => $userId,
    ];
    $statement->execute($data);
    if (0 == $statement->rowCount()) {
        return null;
    }
    $orderData = $statement->fetch();
    $orderData['products'] = [];
    $sql = "SELECT id, title, quantity, price, taxInPercent, order_id 
    FROM order_product WHERE order_id = :orderId";
    $statement = getDB()->prepare($sql);
    if ($statement == false) {
        echo printDBErrorMessage();
        return null;
    }
    $statement->execute([':orderId' => $orderId]);
    if (0 == $statement->rowCount()) {
        return null;
    }
    while ($row = $statement->fetch()) {
        $orderData['products'][] = $row;
    }
    return $orderData;
}
