<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php foreach($get_forum_profile as $fp):?>
<?php echo form_open_multipart('profile/edit_settings', $attributes);?>
<fieldset>
	<legend><?php echo $this->lang->line('label_admin_menu_settings');?></legend>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_display_signatures');?></span>
				<select name="display_signatures" class="form-control">
				<option value="Y"<?php if($fp->display_signatures == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->display_signatures == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_display_avatars');?></span>
				<select name="display_avatars" class="form-control">
				<option value="Y"<?php if($fp->display_avatars == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->display_avatars == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon">G<?php echo $this->lang->line('label_comment_notify');?></span>
				<select name="comment_notify" class="form-control">
				<option value="Y"<?php if($fp->comment_notify == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->comment_notify == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_admin_emails');?></span>
				<select name="admin_notify" class="form-control">
				<option value="Y"<?php if($fp->admin_notify == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->admin_notify == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_article_emails');?></span>
				<select name="post_notify" class="form-control">
				<option value="Y"<?php if($fp->post_notify == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($fp->post_notify == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>