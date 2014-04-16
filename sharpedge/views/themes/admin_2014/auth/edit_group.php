<div class="form-horizontal">
<?php foreach($edit_group->result() as $eg):?>
	<?php echo form_open("user_admin/edit_group/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_group');?></legend>

			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_group_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $eg->name?>" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<input type="text" class="form-control" name="description" value="<?php echo $eg->description?>" />
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />

	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>