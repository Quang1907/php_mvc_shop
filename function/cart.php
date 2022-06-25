<?php
function addProductToCart(int $userId, int $productId, int $quantity = 1)
{
    if (null === $userId) {
        return [];
    }
    $sql = "INSERT INTO cart 
    set quantity = :quantity, user_id = :userId, product_id = :productId 
    ON DUPLICATE KEY UPDATE quantity = quantity + 1
    ";
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


function moveCartProductsToAnotherUser($sourceUserId, $targetUserId)
{
    $sql = "UPDATE cart SET user_id = :targetUserId WHERE user_id = :sourceUserId";
    $statement = getDB()->prepare($sql);
    if (false === $statement) {
        return null;
    }
    return  $statement->execute([
        ':targetUserId' => $targetUserId,
        ':sourceUserId' => $sourceUserId,
    ]);
}
