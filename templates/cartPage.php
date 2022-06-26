<?php
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/navbar.php'
?>
<section class="container mt-5" id="cartItems">
    <div class="row">
        <h2>Giỏ Hàng</h2>
    </div>
    <div class="row border-bottom">
        <div class="col-12 text-end">
            <span>Price</span>
        </div>
    </div>
    <?php foreach ($cartItems as $cartItem) : ?>
        <div class="row border-bottom border-2 py-2">
            <?php include __DIR__ . '/cartItem.php'; ?>
        </div>
    <?php endforeach; ?>
    <div class="row text-end">
        <span>Tổng <?= $countCartItems; ?> sản phẩm: <span class="fw-bold"><?= $cartSum; ?> VND</span></span>
    </div>
    <div class=" row">
        <?php if ($countCartItems > 0) : ?>
            <a href="index.php/checkout" class="btn btn-primary col-12">Thanh Toán</a>
        <?php else : ?>
            <a href="index.php/checkout" class="btn btn-primary disabled col-12">Thanh Toán</a>
            <div class="float-end mt-3">
                <a href="index.php" class="btn btn-success col-3 float-end">Trở lại trang chủ</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.php' ?>