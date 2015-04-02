<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_preferences', $attributes);?>
<fieldset>
	<legend><?php echo $this->lang->line('label_preferences');?></legend>
	
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_timezone');?></span>
				<?php echo timezone_menu($fp->timezone, 'form-control');?>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_daylight_savings');?></span>
				<select name="daylight_savings" class="form-control">
				<option value="Y" <?php if($fp->daylight_savings == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php if($fp->daylight_savings == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>