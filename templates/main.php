<?php
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/navbar.php'
?>
<section class="container mt-5" id="products">
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-sm-3 mt-3">
                <?php include 'card.php' ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/inc/footer.php' ?>