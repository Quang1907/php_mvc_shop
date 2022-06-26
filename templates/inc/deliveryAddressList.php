<div class="row">
    <?php foreach ($deliveryAddresses  as $deliveryAddress) : ?>
        <div class="col-3  mt-3">
            <div class="card">
                <div class="card-body">
                    <strong class="recipient">Nguoi nhan hang: <?= $deliveryAddress['recipient'] ?></strong>
                    <p class="street">Dia chi: <?= $deliveryAddress['streetNumber'] ?> <?= $deliveryAddress['street'] ?></p>
                    <p class="street">Ma buu: <?= $deliveryAddress['zipCode'] ?></p>
                    <a href="index.php/selectDeliveryAddress/<?= $deliveryAddress['id'] ?>" class="card-link">Chon dia chi nay</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>