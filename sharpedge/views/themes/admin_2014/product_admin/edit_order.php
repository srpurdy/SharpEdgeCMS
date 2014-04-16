<?php foreach($edit_order->result() as $id):?>
<?php echo form_open('product_admin/edit_order/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
	<input type="hidden" id="id" name="order_number" value="<?php echo $id->order_number?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_order');?></legend>
			<label for="title"><?php echo $this->lang->line('label_order_num');?></label>
			<p><?php echo $id->order_number?></p>
			
			<?php echo form_error('total_amount'); ?>
			<label for="title"><?php echo $this->lang->line('label_total_amount');?></label>
			<input type="text" class="field" name="total_amount" value="<?php echo $id->total_amount?>" />
			
			<label for="title"><?php echo $this->lang->line('label_paid');?></label>
			<select name="paid">
			<option value="N"<?php if($id->paid == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
			<option value="Y"<?php if($id->paid == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
			</select><br />
            
            <input class="submit" type="submit" value="Submit" />
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>