<?php foreach($edit_order->result() as $id):?>
<?=form_open('product_admin/edit_order/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?=$id->id?>">
	<input type="hidden" id="id" name="order_number" value="<?=$id->order_number?>">
		<fieldset>
			<legend>Edit Order</legend>
			<label for="title">Order #</label>
			<p><?=$id->order_number?></p>
			
			<?php echo form_error('total_amount'); ?>
			<label for="title">Total Amount</label>
			<input type="text" class="field" name="total_amount" value="<?=$id->total_amount?>" />(Without $ sign)<br />
			
			<label for="title">Paid?</label>
			<select name="paid">
			<option value="N"<?php if($id->paid == 'N'):?>selected="selected"<?php endif;?>>No</option>
			<option value="Y"<?php if($id->paid == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
			</select><br />
            
            <input class="submit" type="submit" value="Submit" />
		</fieldset>
<?=form_close();?>
<?php endforeach;?>