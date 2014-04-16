<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('upload/do_upload'); ?>
	<fieldset>
	
		<legend></legend>
	
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_file');?></span>
				<input type="file" name="userfile" size="20" class="form-control" value="" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
	
	</fieldset>
<?php echo form_close();?>
</div>