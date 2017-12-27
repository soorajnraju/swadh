<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require('menu.php'); ?>
    </head>
    <body>

        <!-- Navigation -->
        <?php require('nav.php'); ?>
        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <?php if ($query->num_rows() > 0) { ?>
                        <div class="thumbnail">
                            <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $query->row()->filename ?>" alt="<?php echo $query->row()->product_name; ?>" width="800" height="300">
                            <div class="caption-full product-view">
                                <h4 class="pull-right"><?php echo $query->row()->product_price; ?> Rs</h4>
                                <h4><a href="#"><?php echo ucfirst($query->row()->product_name); ?></a>
                                </h4>
                                <p><?php echo $query->row()->product_desc; ?></p>
                                <br><button type="button" class="btn btn-primary" onclick="post('<?php echo base_url(); ?>cart/add/', {pid: '<?php echo $query->row()->pid; ?>'});">Add to cart</button>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo "<h2>Product not available</h2>";
                    }
                    ?>
                </div>

            </div>

        </div>
        <!-- /.container -->
<?php require('footer.php'); ?>
        <script>
            function post(path, params, method) {
                method = method || "post"; // Set method to post by default if not specified.

                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", path);

                for (var key in params) {
                    if (params.hasOwnProperty(key)) {
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);

                        form.appendChild(hiddenField);
                    }
                }

                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </body>

</html>