<?php
$title = "Checkout";
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
?>

<section class="container" id="selectDeliveryAddress">
    <?php require_once __DIR__ . '/inc/deliveryAddressList.php'; ?>
</section>

<section class="container" id="newDeliveryAddress">
    <?php require_once __DIR__ . '/inc/deliveryAddressForm.php'; ?>
</section>


<?php require_once __DIR__ . '/inc/footer.php'; ?>