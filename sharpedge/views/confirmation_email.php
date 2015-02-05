<html>
<body>
<div style="width:760px;border:5px solid #DDD; padding:20px;">
<h1>Thank you for your purchase</h1>
<h2>Order Summary</h2>
<p>Order #: <?php echo $order_number;?></p>
<?php foreach($ppipn->result() as $pp):?>
<p>Paypal Transaction ID: <?php echo $pp->txn_id;?>
<?php endforeach;?>
<table cellspacing="10">
<thead>
<tr>
<th>Item Name</th>
<th>Price</th>
<th>Qty</th>
</tr>
</thead>
<tbody>
<?php foreach($items->result() as $i):?>
<tr>
<td><?php echo $i->name;?></td>
<td>$<?php echo $i->price;?></td>
<td><?php echo $i->qty;?></td>
</tr>
<?php endforeach;?>
<tr>
<td>Total</td>
<td>$<?php echo $i->total_amount;?></td>
<td></td>
</tr>
</tbody>
</table>
<p>If you have question regarding your order, feel free to contact us</p>
</div>
</body>
</html>