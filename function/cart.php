<?php
function addProductToCart(int $userId, int $productId, int $quantity = 1)
{
    if (null === $userId) {
        return [];
    }
    $check = "SELECT count(id) FROM cart WHERE user_id ='" . $userId . "' and product_id = '" . $productId . "'";
    $statement = getDB()->query($check)->fetchColumn();
    if ($statement == 0) {
        $sql = "INSERT INTO cart 
        set quantity = :quantity, user_id = :userId, product_id = :productId";
    } else {
        $sql = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :userId AND product_id = :productId";
    }
    // $sql = "INSERT INTO cart 
    // set quantity = :quantity, user_id = :userId, product_id = :productId 
    // ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
    $statement = getDB()->prepare($sql);
    $data = [
        ':userId' => $userId,
        ':productId' => $productId,
        ':quantity' => $quantity,
    ];
    return $statement->execute($data);
}

function countProductsInCart($userId)
{
    if (null === $userId) return 0;
    $sql = 'SELECT COUNT(id) FROM cart WHERE user_id = ' . $userId;
    $cartResults = getDB()->query($sql);
    if ($cartResults === false) {
        var_dump(printDBErrorMessage());
        return  0;
    }
    $countCartItems = $cartResults->fetchColumn();
    return $countCartItems;
}

function getCartItemsForUserId($userId)
{
    if (null === $userId) {
        return [];
    }
    $sql = 'SELECT product_id, title, quantity, description, price
        FROM cart
        JOIN products on(cart.product_id = products.id)
        where user_id = ' . $userId;
    $result = getDB()->query($sql);
    if ($result === false) {
        return [];
    }
    $found = [];
    while ($row = $result->fetch()) {
        $found[] = $row;
    }
    return $found;
}


function getCartSumForUserId($userId)
{
    if (null === $userId) {
        return 0;
    }
    $sql = 'SELECT SUM(price * quantity) 
            from cart 
            join products  on(cart.product_id = products.id)
            where user_id=' . $userId;
    $result = getDB()->query($sql);
    if ($result === false) {
        return 0;
    }
    $result  = number_format($result->fetchColumn());
    return $result;
}

function deleteProductInCartForUserId($userId, $productId)
{
    $sql = 'DELETE FROM cart WHERE user_id = :userId and product_id = :producId';
    $statement = getDB()->prepare($sql);
    if ($statement === false) {
        return [];
    }
    $data = [
        ':userId' => $userId,
        ':productId' => $productId,
    ];

    return $statement->execute($data);
}

function clearCartForUser($userId)
{
    $sql = "DELETE FROM CART WHERE user_id = :userId";
    $statement = getDB()->prepare($sql);
    $statement->execute([':userId' => $userId]);
}
