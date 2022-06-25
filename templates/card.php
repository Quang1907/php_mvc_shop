<div class="card p-2">
    <div class="card-title">
        <?= $product['title'] ?>
    </div>
    <img src="https://placekitten.com/g/286/180" class="card-img-top" alt="products">
    <div class="card-body">
        <?= $product['description'] ?>
        <hr>
        <?= $product['price'] ?>
    </div>
    <div class="card-footer">
        <a href="/shop/index.php/cart/add/<?= $product['id'] ?>" class="btn btn-primary btn-sm">Details</a>
        <a href="/shop/index.php/cart/add/<?= $product['id'] ?>" class="btn btn-success btn-sm">Add Cart</a>
    </div>
</div>