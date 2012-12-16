<div class="form-horizontal">
<?php echo form_open('languages/addlang/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('new_lang');?></legend>  
			
			<?php echo form_error('lang'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<input type="text" class="field" name="lang" value="<?php echo set_value('lang');?>" />
				</div>
			</div>
			
			<?php echo form_error('lang_short'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_lang_short');?></label>
				<div class="controls">
				<input type="text" class="field" name="lang_short" value="<?php echo set_value('lang_short');?>" />
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>