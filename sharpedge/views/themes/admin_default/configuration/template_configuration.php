<?php $stats = $this->config->load('template_config');?>
<?php $theme = $stats . $this->config->item('theme');?>
<?php $admin_theme = $stats . $this->config->item('admin_theme');?>
<?php $mobile_theme = $stats . $this->config->item('mobile_theme');?>
<?php $mobile_support = $stats . $this->config->item('mobile_support');?>
<?php $mobile_debug = $stats . $this->config->item('mobile_debug');?>
<?php $jui_theme = $stats . $this->config->item('j_ui_theme');?>
<div class="form-horizontal">
<?php echo form_open('configuration/template_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('template_config');?></legend>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_theme');?></label>
				<div class="controls">
				<input type="text" name="theme" value="<?php echo $theme;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_admin_theme');?></label>
				<div class="controls">
				<input type="text" name="admin_theme" value="<?php echo $admin_theme;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_mobile_theme');?></label>
				<div class="controls">
				<input type="text" name="mobile_theme" value="<?php echo $mobile_theme;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_jui_theme');?></label>
				<div class="controls">
				<input type="text" name="jquery_ui_theme" value="<?php echo $jui_theme;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_mobile_support');?></label>
				<div class="controls">
				<select name="mobile_support">
				<option value="true"<?php if($mobile_support == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($mobile_support == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('template_mobile_debug');?></label>
				<div class="controls">
				<select name="mobile_debug">
				<option value="true"<?php if($mobile_debug == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($mobile_debug == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>