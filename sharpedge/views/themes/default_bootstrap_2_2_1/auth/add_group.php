<div class="form-horizontal">
<?php echo form_open("user_admin/add_group/");?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_group_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<input type="text" class="field" name="description" value="" />
				</div>
			</div>

            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>

	</fieldset>
<?php echo form_close();?>
</div>