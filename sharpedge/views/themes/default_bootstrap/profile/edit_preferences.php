<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_preferences', $attributes);?>
<fieldset>
	<legend>Preferences</legend>
	
			<div class="input-group">
			<span class="input-group-addon">Timezone</span>
				<?php echo timezone_menu($fp->timezone, 'form-control');?>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon">Daylight Savings</span>
				<select name="daylight_savings" class="form-control">
				<option value="Y" <?php if($fp->daylight_savings == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N" <?php if($fp->daylight_savings == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>