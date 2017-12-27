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
                        <li><a href="<?php echo base_url(); ?>dash">Overview</a></li>
                        <li class="active"><a href="<?php echo base_url(); ?>dash/report">Reports<span class="sr-only">(current)</span></a></li>
                        <li><a href="<?php echo base_url(); ?>dash/order">Orders</a></li>
                        <li><a href="<?php echo base_url(); ?>dash/product">Product</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Reports</h1>
                </div>
            </div>
        </div>
        <!-- Container -->
        <?php require('admin_footer.php'); ?>

    </body>

</html>