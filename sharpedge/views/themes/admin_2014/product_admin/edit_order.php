<?php foreach($edit_order->result() as $id):?>
<?php echo form_open('product_admin/edit_order/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
	<input type="hidden" id="id" name="order_number" value="<?php echo $id->order_number?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_order');?></legend>
			<div class="input-group">				<span class="input-group-addon"><?php echo $this->lang->line('label_order_num');?></span>
				<p class="form-control"><?php echo $id->order_number?></p>			</div>
			<?php echo form_error('total_amount'); ?>
			<div class="input-group">				<span class="input-group-addon"><?php echo $this->lang->line('label_total_amount');?></span>
				<input type="text" class="form-control" name="total_amount" value="<?php echo $id->total_amount?>" />			</div>
			<div class="input-group">				<span class="input-group-addon"><?php echo $this->lang->line('label_paid');?></span>
				<select name="paid" class="form-control">
					<option value="N"<?php if($id->paid == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
					<option value="Y"<?php if($id->paid == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_status');?></span>
				<select name="invoice_status" class="form-control">
					<option value="N"<?php if($id->invoice_status == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_not_paid');?></option>
					<option value="P"<?php if($id->invoice_status == 'P'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_paid2');?></option>
					<option value="C"<?php if($id->invoice_status == 'C'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_cancelled');?></option>
					<option value="R"<?php if($id->invoice_status == 'R'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_refunded');?></option>
				</select>
			</div>						<div class="input-group">				<span class="input-group-addon"><?php echo $this->lang->line('label_order_items');?></span>				<div>				<?php foreach($ordered_items->result() as $oi):?>				<?php echo $oi->name;?> - <?php echo $oi->price;?><br />				<?php endforeach;?>				</div>			</div>
            <input class="btn btn-primary" type="submit" value="Submit" />
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>