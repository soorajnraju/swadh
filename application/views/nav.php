<?php
if (isset($_SESSION['cart']))
    $count_cart = count($_SESSION['cart']);
else
    $count_cart = 0;
?>
<nav class="navbar navbar-default navbar-fixed-top my-nav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand swadh" href="<?php echo base_url(); ?>">Swa:)dh</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav indie">
                <li><a href="<?php echo base_url(); ?>search">Products</a></li>
                <li><a href="<?php echo base_url(); ?>about">About</a></li>
                <li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
            </ul>
            <?php if (!isset($_SESSION['user'])) { ?>
                <!--Login-->
                <form class="navbar-form navbar-right" role="search" method="post" action="<?php echo base_url(); ?>login/auth">
                    <div class="form-group">
                        <input type="email" class="form-control" name="txtuser" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="txtpass" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                    <a class="btn btn-info" href="<?php echo base_url(); ?>register">SignUp</a>
                </form>
                <!--End Login-->
            <?php } else { ?>
                <!--Navbar Account-->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            <strong><?php echo $_SESSION['user']; ?></strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu" style="min-width: 170px">
                            <li>
                                <div class="navbar-login" style="padding:15px;">
                                    <div class="text-center">
                                        <!--
                                                <span class="glyphicon glyphicon-user icon-size"></span>
                                                <p class=""><strong>Full Name</strong></p>
                                        -->
                                        <p class=" small"><?php echo $_SESSION['user']; ?></p>
                                        <div class="">
                                            <a href="<?php echo base_url(); ?>register/update" class="btn btn-primary btn-block btn-sm">Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="" style="padding:15px;">
                                    <a href="<?php echo base_url(); ?>order" class="btn btn-primary btn-block btn-sm">My Orders</a>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session" style="padding:15px;">
                                    <a href="<?php echo base_url(); ?>login/terminate" class="btn btn-danger btn-block">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--Navnar Account-->
            <?php } ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>cart/view"> <span class="glyphicon glyphicon-shopping-cart"></span> <?php echo $count_cart; ?> - Items</a>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
