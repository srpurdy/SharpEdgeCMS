<div class="form-horizontal">
<?php echo form_open("user_admin/add_to_group/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_to_group');?></legend>
      
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_group');?></label>
				<div class="controls">
				<select name="group_id">
				<?php foreach($groups->result() as $gr):?>
				<option value="<?php echo $gr->id?>"><?php echo $gr->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_user');?></label>
				<div class="controls">
				<select name="user_id">
				<?php foreach($users as $us):?>
				<option value="<?php echo $us->id?>"><?php echo $us->first_name?> <?php echo $us->last_name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>

	</fieldset>
<?php echo form_close();?>
</div>