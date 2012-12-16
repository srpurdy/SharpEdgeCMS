<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('slideshow_admin/new_image/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_image');?></legend>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label">Description English</label>
				<div class="controls">
				<textarea class="span5" name="desc_one" rows="20" cols="60"></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Description French</label>
				<div class="controls">
				<textarea class="span5" name="desc_two" rows="20" cols="60"></textarea>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>