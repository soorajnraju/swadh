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
                <li><a href="<?php echo base_url(); ?>dash/order">Orders</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>dash/product">Product<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Product</h1>
            <a href="<?php echo base_url(); ?>product/add">
                <button class="btn btn-success">Add New</button>
            </a>
            <?php if (isset($query)) { ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($query->result() as $row) { ?>
                        <tr>
                            <td><?php echo $row->pid; ?></td>
                            <td><?php echo ucfirst($row->product_name); ?></td>
                            <td><?php echo $row->product_price; ?></td>
                            <td><a href="<?php echo base_url(); ?>product/edit/<?php echo $row->pid; ?>">edit</a>, <a
                                        href="<?php echo base_url(); ?>product/remove/<?php echo $row->pid; ?>">delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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