<?php $stats = $this->config->load('template_config');?>
<?php $theme = $stats . $this->config->item('theme');?>
<?php $admin_theme = $stats . $this->config->item('admin_theme');?>
<?php $jui_theme = $stats . $this->config->item('j_ui_theme');?>
<div class="form-horizontal">
<?php echo form_open('configuration/template_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('template_config');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('template_theme');?></span>
				<input type="text" name="theme" class="form-control" value="<?php echo $theme;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('template_admin_theme');?></span>
				<input type="text" name="admin_theme" class="form-control" value="<?php echo $admin_theme;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('template_jui_theme');?></span>
				<input type="text" name="jquery_ui_theme" class="form-control" value="<?php echo $jui_theme;?>" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>