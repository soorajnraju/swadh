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

                    <div class="row carousel-holder">

                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img class="slide-image" src="<?php echo base_url(); ?>assets/images/banner1.jpg" alt="achappam">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="<?php echo base_url(); ?>assets/images/banner2.jpg" alt="chips">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="<?php echo base_url(); ?>assets/images/banner3.jpg" alt="vattayappam">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <?php
                        if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                                ?>
                                <div class="col-xs-12 col-sm-4 col-lg-4 col-md-4 product">
                                    <div class="thumbnail">
                                        <a href="<?php echo base_url(); ?>product/view/<?php echo $row->pid; ?>"><img src="<?php echo base_url(); ?>uploads/<?php echo $row->filename ?>" alt="<?php $row->product_name ?>" height="150" width="320"></a>
                                        <div class="caption">
                                            <h4 class="pull-right"><?php echo $row->product_price; ?> Rs</h4>
                                            <h4><a href="<?php echo base_url(); ?>product/view/<?php echo $row->pid; ?>"><?php echo ucfirst($row->product_name); ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<h2>No data available</h2>";
                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>
        <!-- /.container -->
        <?php require('footer.php'); ?>

    </body>

</html>
