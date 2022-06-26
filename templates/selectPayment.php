<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
?>

<section class="container mt-3" id="selectPaymentMethod">
    <form action="index.php/selectPayment" method="post">
        <div class="form-check">
            <label class="form-check-label" for="paymentOnDelivery">
                Thanh toan khi nhan hang
            </label>
            <input class="form-check-input" type="radio" name="paymentMethod" value="paymentOnDelivery" id="paymentOnDelivery">
        </div>
        <button type="submit" class="btn btn-success">Xác nhận</button>
    </form>
</section>

<?php
require_once __DIR__ . '/inc/footer.php';
?>