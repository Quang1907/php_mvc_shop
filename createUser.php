<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');

define('CONFIG_DIR', __DIR__ . '/config');
require __DIR__ . '/function/database.php';
$username = "quangcntt1";
$password = password_hash("1234", PASSWORD_DEFAULT);
$sql = "INSERT INTO users  SET 
            username = '" . $username . "',
            password = '" . $password . "';";
$statement = getDB()->exec($sql);
if (!$statement) {
    echo printDBErrorMessage();
}
