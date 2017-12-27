<div class="container-fluid footer">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Swa:)dh 2017</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        cart.Set();
    });
    var cart = {
        grand_total: 0,
        Set: function ()
        {
            this.setTotal();
            this.regTotalCalc();
        },
        setTotal: function ()
        {
            this.grand_total = 0;
            $('.item_row').each(function () {
                var qty = $(this).find('.item_quantity').val() * 1;
                var price = $(this).find('.item_price').val() * 1;
                var subtotal = qty * price;
                $(this).find('.subtotal').html(subtotal + ' Rs');
                cart.grand_total += subtotal;
            });
            $('.grandtotal').html(this.grand_total);
            $('[name="total"]').val(this.grand_total);
        },
        regTotalCalc: function ()
        {
            $('.item_quantity').on('change', function () {
                cart.setTotal();
            })
        }

    }

    $(document).ready(function () {

        if (window.location.href.indexOf('recover') != -1) {
            $('#myModal').modal('show');
        }

    });
</script>