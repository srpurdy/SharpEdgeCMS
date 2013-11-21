<div class="form-horizontal">
<?php foreach($edit_group->result() as $eg):?>
	<?php echo form_open("user_admin/edit_group/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_group');?></legend>

			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_group_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $eg->name?>" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<input type="text" class="field" name="description" value="<?php echo $eg->description?>" />
				</div>
			</div>

            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>

	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>