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
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                <form method="post" action="<?php echo base_url(); ?>cart/checkout">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sum = 0; ?>
                        <?php
                        for ($i = 0; $i < $limit; $i++) {
                            if (isset($cart_data[$i])) {
                                $sum += $cart_data[$i]['product_price'];
                                ?>
                                <tr class="item_row">
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                                          src="<?php echo base_url(); ?>uploads/<?php echo $cart_data[$i]['filename']; ?>"
                                                                                          style="width: 72px; height: 72px;">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a
                                                            href="#"><?php echo ucfirst($cart_data[$i]['product_name']); ?></a>
                                                </h4>
                                                <input type="hidden" name="pid<?php echo $i; ?>"
                                                       value="<?php echo $cart_data[$i]['pid']; ?>"/>
                                                <input type="hidden" name="pname<?php echo $i; ?>"
                                                       value="<?php $cart_data[$i]['product_name']; ?>"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <input type="text" name="qty<?php echo $i; ?>"
                                               class="form-control item_quantity" value="1" pattern="^[1-9]\d*$"
                                               title="Numbers only, can't be zero too" required>
                                        <input type="hidden" value="<?php echo $cart_data[$i]['product_price']; ?>"
                                               class="item_price"/>
                                    </td>
                                    <td class="col-sm-1 col-md-1 text-center">
                                        <strong><?php echo $cart_data[$i]['product_price']; ?> Rs</strong></td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong class="subtotal"></strong></td>
                                    <td class="col-sm-1 col-md-1">
                                        <a href="<?php echo base_url(); ?>cart/remove/<?php echo $cart_data[$i]['pid']; ?>">
                                            <button type="button" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span> Remove
                                            </button>
                                        </a></td>
                                </tr>
                            <?php }
                        } ?>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td><h3>Total</h3></td>
                            <td class="text-right"><h3><strong class="grandtotal"><?php echo $sum; ?></strong></h3></td>
                            <input type="hidden" name="total" value="<?php echo $sum; ?>"/>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>
                            <td>
                                <a href="<?php echo base_url(); ?>">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                    </button>
                                </a></td>
                            <td>
                                <button type="submit" class="btn btn-success">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <?php
            } else {
                echo "<h2>Empty Cart</h2>";
                ?>
                <img src="<?php echo base_url(); ?>assets/images/empty_cart.png" class="img-responsive"
                     alt="empty_cart">
            <?php }
            ?>
        </div>
    </div>
</div>
<!-- Container -->
<?php require('footer.php'); ?>

</body>

</html>