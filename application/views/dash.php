<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('admin_menu.php'); ?>
</head>
<body>

<!-- Navigation -->
<?php require('admin_nav.php'); ?>
<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="<?php echo base_url(); ?>dash">Overview <span
                                class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo base_url(); ?>dash/order">Orders</a></li>
                <li><a href="<?php echo base_url(); ?>dash/product">Product</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>

            <!--          <div class="row placeholders">
                        <div class="col-xs-6 col-sm-3 placeholder">
                          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                                      <h4>Total Payments</h4>
                          <span class="text-muted">Something else</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                          <h4>Pending Orders</h4>
                          <span class="text-muted">Something else</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                          <h4>Total Products</h4>
                          <span class="text-muted">Something else</span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
                          <h4>Total Users</h4>
                          <span class="text-muted">Something else</span>
                        </div>
                      </div>-->

            <h2 class="sub-header">Orders (Last 50)</h2>
            <?php if (isset($query)) { ?>
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
                                <td><?php echo ucfirst($row->item); ?></td>
                                <td><?php echo $row->qty; ?></td>
                                <td><?php echo $row->date; ?></td>
                                <td><?php echo $row->order_status; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }
            if (isset($error)) {
                echo "<h2>" . $error . "</h2>";
            } ?>
        </div>
    </div>
</div>
<!-- Container -->
<?php require('admin_footer.php'); ?>

</body>

</html>