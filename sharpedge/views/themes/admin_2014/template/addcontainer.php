<p><?php echo $this->lang->line('label_new_layout_paragraph');?></p>
<div class="form-horizontal">
<?php echo form_open('template/addcontainer/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_container');?></legend> 
		
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="container_name" value="/" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>