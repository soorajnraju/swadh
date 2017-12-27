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
                    <h1 class="page-header">Edit Product</h1>
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong>Failed to update product.
                        </div>
                    <?php } ?>

                    <?php if (isset($success)) { ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>Product updated successfully.
                        </div>
                    <?php } ?>
                    <?php if (isset($row)) { ?>
                        <form method="post" action="<?php echo base_url(); ?>product/editaction" class="form-group" enctype="multipart/form-data">
                            <table class="table">
                                <input type="hidden" name="pid" value="<?php echo $row->pid; ?>"/>
                                <tr><th>Product Name</th><td><input class="form-control" type="text" value="<?php echo $row->product_name; ?>" name="txtproductname" required pattern="[a-zA-Z ]{1,49}" title="Alphabets only"/></td></tr>
                                <tr><th>Product Price</th><td><input class="form-control" type="text" value="<?php echo $row->product_price; ?>" name="txtproductprice" required pattern="[0-9]{1,5}" title="Numbers only"/></td></tr>
                                <tr><th>Product Image</th><td><input type="file" name="productimage" accept="image/*"></td></tr>
                                <tr><th>Decription</th><td><textarea class="form-control" rows="30" name="txtproductdesc" required><?php echo $row->product_desc; ?></textarea></td></tr>
    				<tr><td colspan="2"><button type="submit" class="btn btn-primary">Update</button></td></tr>
    			</table>
    		  </form>
                    <?php } ?>
        </div>
      </div>
    </div>
    <!-- Container -->
        <?php require('admin_footer.php'); ?>

</body>

</html>