<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require('menu.php'); ?>
    </head>
	
    <body>

        <!-- Navigation -->
        <?php require('nav.php'); ?>
        <!-- Container -->
        <div class="container search-container">
            <form method="post" action="<?php echo base_url(); ?>search/find">
                <div class="row">
                    <div class="col-md-6 search-main">
                        <h2>Product Search</h2>
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input name="txtsearch" type="text" class="form-control input-lg" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-lg" type="button">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php if (isset($query)) { ?>
                <hr>
                <?php $i = 1; ?>
                <?php foreach ($query->result() as $row) { ?>
                    <div class="row search">
                        <div class="col-md-12">
                            <h3><?php echo $i; ?>. <a href="<?php echo base_url(); ?>product/view/<?php echo $row->pid; ?>"><?php echo ucfirst($row->product_name); ?> </a></h3>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
            <?php }
            if (isset($error)) {
                echo "<h2 class='error'>" . $error . "</h2>";
            }
            ?>

        </div>
        <!-- Container -->
<?php require('footer.php'); ?>

    </body>

</html>