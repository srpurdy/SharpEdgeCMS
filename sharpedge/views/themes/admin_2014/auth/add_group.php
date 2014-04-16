<div class="form-horizontal">
<?php echo form_open("user_admin/add_group/");?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_group_name');?></span>
				<input type="text" class="form-control" name="name" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<input type="text" class="form-control" name="description" value="" />
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />

	</fieldset>
<?php echo form_close();?>
</div>