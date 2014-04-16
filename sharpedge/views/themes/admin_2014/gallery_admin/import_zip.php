<?php if ($vcate->result()):?>
<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('gallery_admin/import_zip/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_import_zip');?></legend>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_zip_file');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_gallery_category');?></span>
				<select name="cat_id" class="form-control">
				<?php foreach($vcate->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
		
			<input class="btn btn-primary" type="submit" value="Submit" />
		
	</fieldset>
<?php echo form_close();?>
</div>
<?php else:?>
<p><?php echo $this->lang->line('label_create_a_category');?></p>
<?php endif;?>