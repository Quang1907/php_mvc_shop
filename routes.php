<?php
$title = "Trang chu";
$url = $_SERVER['REQUEST_URI']; // lay url trang
$indexPHPPosition =  strpos($url, 'index.php'); // kiem tra xem index.php nam tai vi tri so may
$baseUrl = substr($url, 0, $indexPHPPosition); //lấy ký tự trong chuỗi, 0 vị trí bắt đầu, $indexPHPPosition vị trí kết thúc

if (substr($baseUrl, -1) !== '/') {
    $baseUrl =  $baseUrl . "/";
}
define('BASE_URL', $baseUrl);
$route = null;
// $_SESSION['redirectTarget'] = $baseUrl . 'index.php';

if (false !== $indexPHPPosition) {
    $route = substr($url, $indexPHPPosition); // lấy từ vị trí số $indexPHPPosition trở đi
    $route = str_replace('index.php', '', $route); //  thay ký tự index.php bằng '' trong chuỗi route;
    // $_SESSION['redirectTarget'] = $baseUrl . 'index.php' . $route;
}

$userId = getCurrentUserId(); // tạo user ảo
$countCartItems = countProductsInCart($userId); // đếm số giỏ hàng trong user đó;

if (!$route) {
    $_SESSION['redirectTarget'] = $baseUrl . 'index.php';
    $products = getAllProduct();
    require __DIR__ . '/templates/main.php';
    exit();
}

if (strpos($route, "/cart/add/") !== false) {
    redirectIfNotLogged($route);
    $productId = basename($route);
    addProductToCart($userId, $productId);
    header("Location:" . $baseUrl . "index.php");
    exit();
}

if (strpos($route, "/cart") !== false) {
    $cartItems = getCartItemsForUserId($userId);
    $cartSum = getCartSumForUserId($userId);
    require __DIR__ . '/templates/cartPage.php';
    exit();
}

if (strpos($route, '/login') !== false) {
    if (isLoggedIn()) {
        header("Location: " . $baseUrl . 'index.php');
        exit();
    }
    // strtoupper chuyen ky tu viet thuong thanh viet hoa
    $isPost = isPost();
    $username = "";
    $password = "";
    $errors = [];
    $hasErrors  = false;
    if ($isPost) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password');
        if (!$username) {
            $errors[] = "Vui long nhap ten tai khoan";
        }
        if (!$password) {
            $errors[] = "Vui long nhap mat khau";
        }
        $userData = getUserDataForUsername($username);
        if ($username && 0 === count($userData)) {
            $errors[] = "Tai khoan hoat mau khau khong trung khop";
        }
        if ($password && isset($userData['password']) && false === password_verify($password, $userData['password'])) {
            $errors[] = "Mat khau khong dung";
        }
        if (0 === count($errors)) {
            $_SESSION['userId'] = $userData['id'];
            // moveCartProductsToAnotherUser($_COOKIE['userId'], $userData['id']);
            // setcookie('userId', $userData['id'], $baseUrl);
            $redirectTarget = $_SESSION['redirectTarget'];
            header("Location: " .   $redirectTarget);
            exit();
        }
    }
    $hasErrors = count($errors) > 0;
    require __DIR__ . '/templates/login.php';
    exit();
}

if (strpos($route, '/logout') !== false) {
    // $redirectTarget = $baseUrl . 'index.php';
    // if (isset($_SESSION['redirectTarget'])) {
    //     $redirectTarget =  $_SESSION['redirectTarget'];
    // }
    session_regenerate_id(true);
    session_destroy();
    redirectIfNotLogged();
    header("Location: " . $_SESSION['redirectTarget']);
    exit();
}

if (strpos($route, '/checkout') !== false) {
    redirectIfNotLogged($route);
    $countCartItems = getCartSumForUserId($userId);
    $recipient = '';
    $city = '';
    $street = '';
    $streetNumber = '';
    $zipCode = '';
    $deliveryAddresses = getDeliveryAddressForUser($userId);
    require_once __DIR__ . '/templates/selectDeliveryAddress.php';
    exit();
}

if (strpos($route, '/selectDeliveryAddress') !== false) {
    redirectIfNotLogged($route);
    $deliveryAddressId = basename($route);
    if (deliveryAddressBelongsToUser($deliveryAddressId, $userId)) {
        $_SESSION['deliveryAddressId'] = $deliveryAddressId;
        header('Location: ' . $baseUrl . 'index.php/selectPayment');
        exit();
    }
    header('Location: ' . $baseUrl . 'index.php/checkout');
    exit();
}

if (strpos($route, '/deliveryAddress/add') !== false) {
    redirectIfNotLogged($route);
    $recipient = '';
    $city = '';
    $street = '';
    $streetNumber = '';
    $zipCode = '';

    $recipientIsValid = false;
    $cityIsValid = false;
    $streetIsValid = false;
    $streetNumberIsValid = false;
    $zipCodeIsValid = false;

    $isPost = isPost();
    $errors = [];
    $deliveryAddresses = getDeliveryAddressForUser($userId);

    if ($isPost) {
        $recipient = filter_input(INPUT_POST, 'recipient', FILTER_SANITIZE_SPECIAL_CHARS);
        $recipient = trim($recipient);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = trim($city);
        $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
        $streetNumber = filter_input(INPUT_POST, 'streetNumber', FILTER_SANITIZE_SPECIAL_CHARS);
        $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$recipient) {
            $errors[] = 'Người nhận không được để trống';
            $recipientIsValid = true;
        }
        if (!$city) {
            $errors[] = 'Thành phố không được để trống';
            $cityIsValid = true;
        }
        if (!$street) {
            $errors[] = 'Đường phố không được để trống';
            $streetIsValid = true;
        }
        if (!$streetNumber) {
            $errors[] = 'Số đường không được để trống';
            $streetNumberIsValid = true;
        }
        if (!$zipCode) {
            $errors[] = 'Mã bưu không được để trống';
            $zipCodeIsValid = true;
        }
        if (count($errors) === 0) {
            $deliveryAddressId = saveDeliveryAddressForUser($userId, $recipient, $city, $street, $streetNumber, $zipCode);
            if ($deliveryAddressId > 0) {
                $_SESSION['deliveryAddressId'] = $deliveryAddressId;
                header('Location: ' . $baseUrl . 'index.php/selectPayment');
                exit();
            }
        }
    }
    $hasErrors = count($errors) > 0;
    $deliveryAddresses = getDeliveryAddressForUser($userId);

    require_once __DIR__ . '/templates/selectDeliveryAddress.php';
    exit();
}

if (strpos($route, '/selectPayment') !== false) {
    redirectIfNotLogged($route);
    $isPost = isPost();
    if ($isPost) {
        $_SESSION['paymentMethod'] = filter_input(INPUT_POST, 'paymentMethod', FILTER_SANITIZE_SPECIAL_CHARS);
        header('Location: ' . $baseUrl . 'index.php/completeOrder');
        exit();
    }
    require_once __DIR__ . '/templates/selectPayment.php';
    exit();
}

if (strpos($route, '/completeOrder') !== false) {
    redirectIfNotLogged($route);
    if (!isset($_SESSION['paymentMethod'])) {
        require_once __DIR__ . '/templates/selectPayment.php';
        exit();
    }

    $userId = getCurrentUserId();
    $cartItems = getCartItemsForUserId($userId);
    if (createOrder($userId, $cartItems)) {
        clearCartForUser($userId);
        require_once __DIR__ . "/templates/thankYouPage.php";
        exit();
    }
}
