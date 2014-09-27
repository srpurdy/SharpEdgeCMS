<div class="form-horizontal">
<?php echo form_open_multipart('product_admin/new_shipping/' . $this->uri->segment(3));?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_shipping');?></legend>
			<input type="hidden" name="product_id" value="<?php echo $this->uri->segment(3);?>" />
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_price');?></span>
				<input type="text" class="form-control" name="price" value="" />
			</div>
            
            <input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
</div>