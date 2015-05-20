<?php
$url = $paypal_array['paypal_url'];
$email = $paypal_array['paypal_email'];
$order_number = $paypal_array['order_number'];
$total_amount = $paypal_array['total_purchase_amount'];
?>
<?php $i = 1;?>
<p>You will be directed to paypal in a moment. If you are not re-directed automatically click the paypal button below.</p>
<?php foreach($order_items->result() as $oi):?>
<?php $get_currency = $this->db
	->where('product_id', $oi->product_id)
	->select('currency')
	->from('products')
	->get();
?>
<?php foreach($get_currency->result() as $gc):?>
<?php $main_currency = $gc->currency;?>
<?php endforeach;?>
<?php break;?>
<?php endforeach;?>
<form action="<?php echo $url?>" name="paypal" method="post"> 
<input type="hidden" name="upload" value="1">
<input type="hidden" name="cmd" value="_cart" />
<input type="hidden" name="business" value="<?php echo $email?>" />
<input type="hidden" name="return" value="<?php echo site_url();?>/paypal/paid/<?php echo $order_number?>" />
<input type="hidden" name="cancel_return" value="<?php echo site_url();?>/paypal" />
<input type="hidden" name="notify_url" value="<?php echo site_url();?>/paypal/ipn/<?php echo $order_number?>" />
<input type="hidden" name="custom" value="<?php echo $order_number?>" />
<?php foreach($order_items->result() as $oi):?>
<?php $get_currency = $this->db
	->where('product_id', $oi->product_id)
	->select('currency')
	->from('products')
	->get();
?>
<?php foreach($get_currency->result() as $gc):?>
<?php if($main_currency == $gc->currency):?>
<input type="hidden" name="currency_code" value="<?php echo $gc->currency;?>" />
<?php endif;?>
<?php endforeach;?>
<?php if($main_currency == $gc->currency):?>
<input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $oi->name?>" />
<input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo $oi->price?>" />
<input type="hidden" name="quantity_<?php echo $i;?>" value="<?php echo $oi->qty?>" />
<?php $i++;?>
<?php else:?>
<?php endif;?>
<?php endforeach;?>
<input type="image" name="submit" id="paypal_form" src="https://www.paypal.com/en_US/i/btn/x-click-but03.gif" /></form>