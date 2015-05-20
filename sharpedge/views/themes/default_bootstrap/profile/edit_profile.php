<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_avatar');?>
<fieldset>
	<legend><?php echo $this->lang->line('label_avatar');?></legend>
	
			<div class="input-group">
				<img src="<?php echo base_url();?><?php echo $this->config->item('ava_upload_directory');?>/<?php echo $fp->avatar?>" alt="Current Image" />
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_avatar');?></span>
				<input type="file" class="form-control" name="avatar" value="" />
			</div>
			<small>
				Current File: <?php echo $fp->avatar?><br />
				Max Size: <?php echo $this->config->item('ava_max_file_size');?>KB<br />
				Max Dimensions: <?php echo $this->config->item('ava_max_width');?>x<?php echo $this->config->item('ava_max_height');?>
			</small>
			<br />	
			<div class="form-actions">
			<input class="btn btn-success" type="submit" value="Upload" />
			</div><br />
</fieldset>
<?php echo form_close();?>

<?php echo form_open_multipart('profile/edit_profile', $attributes);?>
<fieldset>
	<legend><?php echo $this->lang->line('label_profile');?></legend>
	
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_website');?></span>
				<input type="text" class="form-control" name="website" value="<?php echo $fp->website?>" />
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_display_nickname');?></span>
				<select name="display_name" class="form-control">
				<option value="Y"<?php if($fp->display_name == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->display_name == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				<?php echo form_error('display_name'); ?>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_nickname');?></span>
				<input type="text" class="form-control" name="nickname" value="<?php echo $fp->nickname?>" />
				<?php echo form_error('nickname'); ?>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_location');?></span>
				<input type="text" class="form-control" name="location" value="<?php echo $fp->location?>" />
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_interests');?></span>
				<input type="text" class="form-control" name="intrests" value="<?php echo $fp->intrests?>" />
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_occupation');?></span>
				<input type="text" class="form-control" name="occupation" value="<?php echo $fp->occupation?>" />
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_signature');?></span>
				<textarea class="form-control" name="signature" rows="5"><?php echo $fp->signature?></textarea>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>