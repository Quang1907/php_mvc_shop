<?php

function getDeliveryAddressForUser($userId)
{
    $sql = 'SELECT id, recipient, city, street, streetNumber, zipCode
    FROM delivery_address where user_id = :userId';
    $statement = getDB()->prepare($sql);
    if (false === $statement) {
        return [];
    }
    $addresses = [];
    $statement->execute([':userId' => $userId]);
    while ($row = $statement->fetch()) {
        $addresses[] = $row;
    }
    return $addresses;
}


function saveDeliveryAddressForUser($userId, $recipient, $city, $street, $streetNumber, $zipCode)
{
    $sql = 'INSERT INTO delivery_address SET user_id = :userId, recipient = :recipient, city = :city, street = :street, streetNumber = :streetNumber , zipCode = :zipCode';
    $statement = getDB()->prepare($sql);
    $data = [
        ':userId' => $userId,
        ':recipient' => $recipient,
        ':city' => $city,
        ':street' => $street,
        ':streetNumber' => $streetNumber,
        ':zipCode' => $zipCode,
    ];
    return $statement->execute($data);
}

function deliveryAddressBelongsToUser()
{
}
