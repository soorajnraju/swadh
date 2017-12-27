<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('menu.php'); ?>
</head>
<body>

<!-- Navigation -->
<?php require('nav.php'); ?>
<!-- Container -->
<div class="container">
    <?php if (isset($status)) { ?>
        <?php if ($status == 'Credit') { ?>
            <h2>Thank you, <font color="green">Payment was success and order was placed !</font></h2><h3>Payment
                ID: <?php echo $payment_id; ?></h3>
            <p>You can manage your orders under <a href="<?= base_url('order') ?>">My Orders</a>,
                you can cancel your order at any time before we make delivery to you. Usual delivery will be done within
                2-4 Hours (depends on your location).
            </p>
            <p>Note: Swath can cancel/reject your order at anytime due to our limited stocks. Don't worry your cash will
                be got refunded to your bank account (usual refund time will be 48 Hours).</p>
        <?php } elseif ($status == 'Pending') {
            ?>
            <h2>Sorry, <font color="orange">Payment is pending</font></h2>
        <?php } else {
            ?>
            <h2>Sorry, <font color="red">Payment failed</font></h2>
        <?php } ?>
    <?php } ?>
</div>
<!-- Container -->
<?php require('footer.php'); ?>

</body>

</html>