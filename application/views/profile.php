<!DOCTYPE html>
<html lang="en">

    <head>
        <?php require('menu.php'); ?>
    </head>
    <body>

        <!-- Navigation -->
        <?php require('nav.php'); ?>
        <!-- Container -->
        <div class="container">
            <?php if (isset($error)) { ?>	
                <div class="alert alert-danger">
                    <strong>Failed</strong> <?php echo $error; ?>
                </div>
            <?php } ?>
            <?php if (isset($success)) { ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> <?php echo $success; ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <?php if (isset($row)) { ?>
                        <form role="form" method="post" action="<?php echo base_url(); ?>register/updateAction">
                            <h2>Profile</h2>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->firstname; ?>" name="txtfname" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1" required required="" pattern="[a-zA-Z ]{1,49}" title="Alphabets only, with no space">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="<?php echo $row->lastname; ?>" name="txtlname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2" required required="" pattern="[a-zA-Z ]{1,49}" title="Alphabets only, with no space">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" value="<?php echo $row->email; ?>" name="txtemail" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required readonly>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="txtpass" value="<?= $row->password; ?>" id="password" class="form-control input-lg" placeholder="Password" tabindex="5" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="txtpassconf" value="<?= $row->password; ?>" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?= $row->sq ?>" name="txtsq" id="sq" class="form-control input-lg" placeholder="Security Question" tabindex="4" required pattern="^[A-Za-z -]+$" title="Alphabets and space only">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?= $row->ans ?>" name="txtans" id="ans" class="form-control input-lg" placeholder="Answer" tabindex="4" required pattern="^[A-Za-z -]+$" title="Alphabets and space only">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $row->phone; ?>" name="txtphone" id="phone" class="form-control input-lg" placeholder="Phone" tabindex="4" required pattern="[0-9]{10,10}" title="Mobile phone number with 10 digits">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $row->street; ?>" name="txtstreet" id="street" class="form-control input-lg" placeholder="Street" tabindex="4" required pattern="[a-zA-Z]{1,49}" title="Alphabets only">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $row->city; ?>" name="txtcity" id="city" class="form-control input-lg" placeholder="City" tabindex="4" required pattern="[a-zA-Z]{1,49}" title="Alphabets only">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $row->state; ?>" name="txtstate" id="state" class="form-control input-lg" placeholder="State" tabindex="4" required pattern="[a-zA-Z]{1,49}" title="Alphabets only">
                            </div>
                            <div class="form-group">
                                <input type="text" value="<?php echo $row->pin; ?>" name="txtpin" id="pin" class="form-control input-lg" placeholder="Pin" tabindex="4" required pattern="[0-9]{6,6}" title="6 digit PIN">
                            </div>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-md-6"><input type="submit" value="Update" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Container -->
        <?php require('footer.php'); ?>

    </body>

</html>