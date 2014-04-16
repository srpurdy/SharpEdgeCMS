<div class="form-horizontal">
<?php echo form_open('languages/addlang/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('new_lang');?></legend>  
			
			<?php echo form_error('lang'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<input type="text" class="form-control" name="lang" value="<?php echo set_value('lang');?>" />
			</div>
			
			<?php echo form_error('lang_short'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_lang_short');?></span>
				<input type="text" class="form-control" name="lang_short" value="<?php echo set_value('lang_short');?>" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
</div>