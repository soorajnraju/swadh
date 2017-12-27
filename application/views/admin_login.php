<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require('menu.php'); ?>
    </head>
    <body>

        <!-- Navigation -->
        <?php require('admin_nav.php'); ?>
        <!-- Container -->
        <div class="container">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <strong>Login Failed</strong> Username or Password is incorrect
                </div>
            <?php } ?>
            <?php if (isset($warning)) { ?>
                <div class="alert alert-warning">
                    <strong>Fields are empty !</strong> Username or Password can't leave empty
                </div>
            <?php } ?>
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form role="form" method="post" action="<?php echo base_url(); ?>admin/auth">
                        <fieldset>
                            <h2>Please Sign In</h2>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <input type="email" name="txtuser" id="email" class="form-control input-lg" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" name="txtpass" id="password" class="form-control input-lg" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- Container -->
        <?php require('footer.php'); ?>

    </body>

</html>