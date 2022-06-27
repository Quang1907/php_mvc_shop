<?php
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/navbar.php'
?>
<div class="pdf container">
    <section id="companyLogo" class="row"></section>
    <section id="companyDetails" class="row">
        <?= COMPANY_NAME ?> | <?= COMPANY_STREET ?> | <?= COMPANY_CITY ?> | <?= COMPANY_ZIP ?>
    </section>
    <section id="invoiceAddress" class="row"></section>
    <section id="invoiceDetails" class="row"></section>
    <section id="invoiceHeader" class="row"></section>
    <section class="container mt-5" id="invoice">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ten san pham</th>
                        <th>So luong</th>
                        <th>Gia</th>
                        <th>GTGT (VAT)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderData['products'] as $order) : ?>
                        <tr>
                            <td scope="row"> <?= $order['title'] ?></td>
                            <td> <?= $order['quantity'] ?></td>
                            <td><?= $order['price'] ?></td>
                            <td> <?= $order['taxInPercent'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <section id="sum" class="row"></section>
    <section id="invoiceDetailsFooter" class="row"></section>
    <section id="footer" class="row"></section>
</div>
<?php include __DIR__ . '/inc/footer.php' ?>