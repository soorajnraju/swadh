<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Swa:)dh</a>
        </div>

        <?php if (isset($_SESSION['admin'])) { ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!--Navbar Account-->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> 
                            <strong><?php echo $_SESSION['admin']; ?></strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu" style="min-width: 180px">
                            <!--                        <li>
                                                        <div class="navbar-login" style="padding:15px;">
                                                            <div class="text-center">
                                                                                                    <div class="">
                                                                                                            <a href="#" class="btn btn-primary btn-block btn-sm">Settings</a>
                                                                                                    </div>
                                                                                            </div>
                                                                                    </div>
                                                    </li>
                                                    <li class="divider"></li>-->
                            <li>
                                <div class="navbar-login navbar-login-session" style="padding:15px;">
                                    <a href="<?php echo base_url(); ?>admin/terminate" class="btn btn-danger btn-block">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--Navnar Account-->
            </div><!-- /.navbar-collapse -->
        <?php } ?>
    </div><!-- /.container-->
</nav>
