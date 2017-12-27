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
                    <h1 class="page-header">Add New Product</h1>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong>Failed to add product.
                        </div>
                    <?php } ?>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>Product added successfully.
                        </div>
                    <?php } ?>

                    <form method="post" action="<?php echo base_url(); ?>product/addaction" class="form-group" enctype="multipart/form-data">
                        <table class="table">
                            <tr><th>Product Name</th><td><input class="form-control" type="text" name="txtproductname" required pattern="[a-zA-Z ]{1,49}" title="Alphabets only"/></td></tr>
                            <tr><th>Product Price</th><td><input class="form-control" type="text" name="txtproductprice" required pattern="[0-9]{1,5}" title="Numbers only"/></td></tr>
                            <tr><th>Product Image</th><td><input type="file" name="productimage" accept="image/*" required></td></tr>
                            <tr><th>Decription</th><td><textarea class="form-control" rows="30" name="txtproductdesc" required></textarea></td></tr>
				<tr><td colspan="2"><button type="submit" class="btn btn-primary">Add</button></td></tr>
			</table>
		  </form>
        </div>
      </div>
    </div>
    <!-- Container -->
        <?php require('admin_footer.php'); ?>

</body>

</html>