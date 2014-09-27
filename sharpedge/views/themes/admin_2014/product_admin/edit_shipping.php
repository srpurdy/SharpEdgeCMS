<?php foreach($query->result() as $id):?>
<div class="form-horizontal">
<?php echo form_open_multipart('product_admin/edit_shipping/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_shipping');?></legend>
			<input type="hidden" name="product_id" value="<?php echo $this->uri->segment(3);?>" />
			<input type="hidden" name="id" value="<?php echo $this->uri->segment(4);?>" />
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_price');?></span>
				<input type="text" class="form-control" name="price" value="<?php echo $id->price;?>" />
			</div>
            
            <input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
</div>
<?php endforeach;?>