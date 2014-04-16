<?php if ($vcate->result()):?>
<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('gallery_admin/import_zip/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_import_zip');?></legend>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_zip_file');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_gallery_category');?></label>
				<div class="controls">
				<select name="cat_id">
				<?php foreach($vcate->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
		
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		
	</fieldset>
<?php echo form_close();?>
</div>
<?php else:?>
<p><?php echo $this->lang->line('label_create_a_category');?></p>
<?php endif;?>