<p><?php echo $this->lang->line('label_new_layout_paragraph');?></p>
<div class="form-horizontal">
<?php echo form_open('template/addcontainer/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_container');?></legend> 
		
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="container_name" value="/" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>