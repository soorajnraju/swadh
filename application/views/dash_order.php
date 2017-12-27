<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('admin_menu.php'); ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#start").datepicker();
        });
        $(function () {
            $("#end").datepicker();
        });
    </script>
</head>
<body>

<!-- Navigation -->
<?php require('admin_nav.php'); ?>
<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="<?php echo base_url(); ?>dash">Overview</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>dash/order">Orders<span
                                class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo base_url(); ?>dash/product">Product</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Orders</h1>
            <form method="post" action="<?php echo base_url(); ?>dash/orderAction">
                <table class="table">
                    <tr>
                        <td>Start-Date(yyyy/mm/dd)</td>
                        <td><input type="text" id="start" name="start_date" required
                                   pattern="(?:(?:0[1-9]|1[0-2])[\/\\-. ]?(?:0[1-9]|[12][0-9])|(?:(?:0[13-9]|1[0-2])[\/\\-. ]?30)|(?:(?:0[13578]|1[02])[\/\\-. ]?31))[\/\\-. ]?(?:19|20)[0-9]{2}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>End-Date(yyyy/mm/dd)</td>
                        <td><input type="text" id="end" name="end_date" required
                                   pattern="(?:(?:0[1-9]|1[0-2])[\/\\-. ]?(?:0[1-9]|[12][0-9])|(?:(?:0[13-9]|1[0-2])[\/\\-. ]?30)|(?:(?:0[13578]|1[02])[\/\\-. ]?31))[\/\\-. ]?(?:19|20)[0-9]{2}"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-default" type="submit">Get Orders</button>
                        </td>
                    </tr>
                </table>
            </form>
            <hr>
            <!--orderlist-->
            <?php if (isset($query)) { ?>
                <h2 class="sub-header">Orders</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Payment ID</th>
                            <th>Username</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($query->result() as $row) { ?>
                            <tr>
                                <td><?php echo $row->order_id; ?></td>
                                <td><?php echo $row->payment_id; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>user/view/<?php echo base64_encode($row->username); ?>"><?php echo $row->username; ?></a>
                                </td>
                                <td><?php echo $row->item; ?></td>
                                <td><?php echo $row->qty; ?></td>
                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->order_status; ?></td>
                                <td><?php if ($row->order_status == 'init') { ?><a
                                        href="<?php echo base_url(); ?>order/approve/<?php echo $row->payment_id; ?>">
                                            <button>Approve</button></a><a
                                            href="<?php echo base_url(); ?>order/reject/<?php echo $row->payment_id; ?>">
                                            <button>Reject</button></a><?php } ?>
                                    <?php if ($row->order_status == 'approved') { ?><a
                                        href="<?php echo base_url(); ?>order/delivered/<?php echo $row->payment_id; ?>">
                                            <button>Delivered?</button></a><a
                                            href="<?php echo base_url(); ?>order/reject/<?php echo $row->payment_id; ?>">
                                            <button>Reject</button></a><?php } ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }
            if (isset($error)) {
                echo "<h2>" . $error . "</h2>";
            } ?>
            <!--orderlist-->
        </div>
    </div>
</div>
<!-- Container -->
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>

</html>