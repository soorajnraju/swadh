<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require('menu.php'); ?>
        <script>
            function proceed(username) {
                $.post("<?= base_url('Ajax/getProfile') ?>",
                        {
                            txtuser: username
                        },
                        function (data, status) {
                            $("#sq").empty();
                            $("#sq").html(data);
                        });
            }
        </script>
        <style>
            #btnProceed{
                display: inline-block;
                float: right;
                position: relative;
                top: -60px;
                line-height: 30px;
            }

            #username{
                margin-bottom: 15px;
            }
            .question{
                padding-top: 10px;
                font-weight: bold;
            }

            #sq{
                padding-bottom: 22px;
            }
            .error{
                color: red;
                font-weight: bold;
            }
            .success{
                color: green;
                font-weight: bold;
            }
        </style>
    </head>
    <body>

        <!-- Navigation -->
        <?php require('nav.php'); ?>
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
                    <form role="form" method="post" action="<?php echo base_url(); ?>login/auth">
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
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="<?php echo base_url(); ?>register" class="btn btn-lg btn-primary btn-block">Register</a>
                                </div>
                            </div>
                            <span class="button-checkbox">
                                <a href="#" class="btn btn-link pull-left" data-toggle="modal" data-target="#myModal">Forgot Password?</a>
                            </span>
                        </fieldset>
                    </form>
                    <!--modal-->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <form method="post" action="<?= base_url('login/recover') ?>">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Recover Password</h4>
                                    </div>
                                    <div class="modal-body">
                                        <span>Username:</span><input id="username" class="form-control input-lg" type="email" name="txtuser" />
                                        <button class="btn btn-primary" id="btnProceed" onclick="proceed($('#username').val())">Proceed</button>
                                        <div id="sq">
                                            <?php
                                            if (isset($pass_not_match) && $pass_not_match == 1) {
                                                echo "<span class='error'>Password not match !</span><br>";
                                            }
                                            if (isset($success_update) && $success_update == 1) {
                                                echo "<span class='success'>Password updated successfully !</span><br>";
                                            }
                                            if (isset($ans_not_match) && $ans_not_match == 1) {
                                                echo "<span class='error'>Answer was wrong !</span><br>";
                                            }
                                            ?>
                                        </div>
                                        <span>Password:</span><input class="form-control input-lg" type="password" name="txtpass" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)" style="display: block;"/>
                                        Confirm Password &nbsp; <input class="form-control input-lg" type="password" name="txtpassconf" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)" style="display: block;"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button name="submit" type="submit" class="btn btn-success">Change Password</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!--modal-->
                </div>
            </div>
        </div>
        <!-- Container -->
        <?php require('footer.php'); ?>

    </body>

</html>