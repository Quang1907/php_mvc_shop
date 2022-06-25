<form action="index.php/deliveryAddress/add" method="post">
    <div class="card mt-5">
        <div class="card-header text-center">
            <h2>THÊM THÔNG TIN NHẬN HÀNG</h2>
        </div>
        <div class="card-body">
            <?php if (isset($hasErrors) && $hasErrors > 0) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $errorsMessage) : ?>
                        <strong><?= $errorsMessage ?></strong><br>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label for="recipient" class="form-label">Người nhận</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="recipient" id="recipient" value="<?= escape($recipient) ?>" class="form-control <?= $recipientIsValid ? ' is-invalid' : '' ?>" placeholder="Recipient">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label for="city" class="form-label">Thành phố</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="city" id="city" value="<?= escape($city) ?>" class=" form-control <?= $cityIsValid ? ' is-invalid' : '' ?>" placeholder=" City">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label for="street" class="form-label">Đường phố</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="street" id="street" value="<?= escape($street) ?>" class="form-control <?= $streetIsValid ? ' is-invalid' : '' ?>" placeholder=" Street">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label for="zipCode" class="form-label">Số đường</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" name="streetNumber" id="streetNumber" value="<?= escape($streetNumber) ?>" class="form-control <?= $streetNumberIsValid ? ' is-invalid' : '' ?>" placeholder=" streetNumber">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label for="zipCode" class="form-label">Mã bưu</label>
                </div>
                <div class="col-sm-10">
                    <input type="number" name="zipCode" id="zipCode" value="<?= escape($zipCode) ?>" class="form-control <?= $zipCodeIsValid ? ' is-invalid' : '' ?>" value=" <?= $zipCode ?>" placeholder="zipCode">
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success float-end">Xác nhận</button>
        </div>
    </div>
</form>