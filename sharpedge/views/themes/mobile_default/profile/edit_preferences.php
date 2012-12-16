<?$attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_preferences', $attributes);?>
<fieldset>
	<legend>Preferences</legend>
	
			<div class="control-group">
			<label class="control-label">Timezone</label>
				<div class="controls">
				<?php echo timezone_menu($fp->timezone);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Daylight Savings</label>
				<div class="controls">
				<select name="daylight_savings">
				<option value="Y" <?php if($fp->daylight_savings == 'Y'):?>selected="selected"<?php endif;?>>Yes</option>
				<option value="N" <?php if($fp->daylight_savings == 'N'):?>selected="selected"<?php endif;?>>No</option>
				</select>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>