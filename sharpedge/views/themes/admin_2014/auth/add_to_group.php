<div class="form-horizontal">
<?php echo form_open("user_admin/add_to_group/".$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_to_group');?></legend>
      
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_group');?></span>
				<select name="group_id" class="form-control">
				<?php foreach($groups->result() as $gr):?>
				<option value="<?php echo $gr->id?>"><?php echo $gr->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_user');?></span>
				<select name="user_id" class="form-control">
				<?php foreach($users as $us):?>
				<option value="<?php echo $us->id?>"><?php echo $us->first_name?> <?php echo $us->last_name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />

	</fieldset>
<?php echo form_close();?>
</div>