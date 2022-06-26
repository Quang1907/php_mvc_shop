<?php

function getCurrentUserId()
{
    $userId = null;

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }
    // if (isset($_COOKIE['userId'])) {
    //     $userId = $_COOKIE['userId'];
    // }

    // session_destroy();
    // setcookie("userId", "", time() - 36000);

    return $userId;
}

function isLoggedIn()
{
    return isset($_SESSION['userId']);
}

function getUserDataForUsername($username)
{
    $sql = "SELECT id, password FROM users WHERE username = :username";
    $statement = getDB()->prepare($sql);
    if (false === $statement) {
        return [];
    }
    $statement->execute([
        ':username' => $username,
    ]);
    if (0 === $statement->rowCount()) {
        return [];
    }
    $row = $statement->fetch();
    return $row;
}
