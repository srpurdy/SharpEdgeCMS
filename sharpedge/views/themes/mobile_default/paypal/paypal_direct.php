<script type="text/javascript">
$(document).ready(function() {
          $('#paypal_form').trigger('click');
  })
</script>
<?php
$url = $paypal_array['paypal_url'];
$email = $paypal_array['paypal_email'];
$order_number = $paypal_array['order_number'];
$total_amount = $paypal_array['total_purchase_amount'];
?>
<p>You will be directed to paypal in a moment. If you are not re-directed automatically click the paypal button below.</p>
<form action="<?php echo $url?>" name="paypal" method="post"> 
<input type="hidden" name="rm" value="2" />
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="currency_code" value="CAD" />
<input type="hidden" name="quantity" value="1" />
<input type="hidden" name="business" value="<?php echo $email?>" />
<input type="hidden" name="return" value="<?php echo site_url();?>/paypal/paid/<?php echo $order_number?>" />
<input type="hidden" name="cancel_return" value="<?php echo site_url();?>/paypal" />
<input type="hidden" name="notify_url" value="<?php echo site_url();?>/paypal/ipn/<?php echo $order_number?>" />
<input type="hidden" name="custom" value="<?php echo $order_number?>" />
<input type="hidden" name="item_name" value="<?php echo $order_number?>" />
<input type="hidden" name="item_number" value="9999" />
<input type="hidden" name="amount" value="<?php echo $total_amount?>" />
<input type="image" name="add" id="paypal_form" src="https://www.paypal.com/en_US/i/btn/x-click-but03.gif" /></form>
