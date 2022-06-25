<div class="col-3">
    <img src="https://placekitten.com/g/286/180" class="card-img-top" alt="products">
</div>
<div class="col-7">
    <div class="row">
        <div class="col-sm-4">
            <h6> Tên sản phẩm: </h6>
        </div>
        <div class="col-sm-4"> <?= $cartItem['title']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h6> Số lượng:</h6>
        </div>
        <div class="col-sm-4">
            <?= $cartItem['quantity']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <h6> Mô tả sản phẩm:</h6>
        </div>
        <div class="col-sm-4">
            <?= $cartItem['description']; ?>
        </div>
    </div>
</div>
<div class="col-2 text-end">
    <span class="text-danger fw-bold">
        <?= number_format($cartItem['price']) ?> VND
    </span>
</div>