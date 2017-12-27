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
            <div class="span7">   
                <div class="widget stacked widget-table action-table">

                    <div class="widget-header">
                        <i class="icon-th-list"></i>
                        <h3>My Orders</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <?php if (!isset($error)) { ?>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Payment Id</th>
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
                                            <td><?php echo ucfirst($row->item); ?></td>
                                            <td><?php echo $row->qty; ?></td>
                                            <td><?php echo $row->date; ?></td>
                                            <td><?php echo $row->order_status; ?></td>
                                            <td>
                                                <?php if ($row->order_status == 'init') { ?>
                                                    <a href="<?php echo base_url(); ?>order/cancel/<?php echo $row->payment_id; ?>" class="btn btn-small">
                                                        <button type="button" class="btn btn-default btn-sm">
                                                            <span class="glyphicon glyphicon-remove"></span> Cancel
                                                        </button>										
                                                    </a>
                                                <?php } else {
                                                    ?>
                                                    <button type="button" class="btn btn-default btn-sm" disabled>
                                                        <span class="glyphicon glyphicon-ban-circle"></span> Can't Cancel
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else {
                            ?>
                            <h2><?php echo $error; ?></h2>
                        <?php } ?>

                    </div> <!-- /widget-content -->

                </div> <!-- /widget -->
            </div>
        </div>
        <!-- Container -->
        <?php require('footer.php'); ?>

    </body>

</html>