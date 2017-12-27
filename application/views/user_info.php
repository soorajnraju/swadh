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
            <h2>User Info</h2>
            <?php if (isset($query))
                $row = $query->row(); {
                ?>
                <table class="table" style="font-weight: bold">
                    <tr><td>Username</td><td><?php echo $row->email; ?></td></tr>
                    <tr><td>First Name</td><td><?php echo $row->firstname; ?></td></tr>
                    <tr><td>Last Name</td><td><?php echo $row->lastname; ?></td></tr>
                    <tr><td>Email</td><td><?php echo $row->email; ?></td></tr>
                    <tr><td>Phone</td><td><?php echo $row->phone; ?></td></tr>
                    <tr><td>Street</td><td><?php echo $row->street; ?></td></tr>
                    <tr><td>City</td><td><?php echo $row->city; ?></td></tr>
                    <tr><td>State</td><td><?php echo $row->state; ?></td></tr>
                    <tr><td>PIN</td><td><?php echo $row->pin; ?></td></tr>
                </table>
            <?php }
            if (isset($error)) {
                echo "<h2>" . $error . "</h2>";
            }
            ?>
        </div>
        <!-- Container -->
<?php require('footer.php'); ?>

    </body>

</html>