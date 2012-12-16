<div class="form-horizontal">
<?php foreach($edit_group->result() as $id):?>
<?php echo form_open('widget_admin/edit_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
		
			<input type="hidden" class="field" value="<?php echo $id->id?>" name="id" />
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" value="<?php echo $id->name?>" name="name" />
				</div>
			</div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>