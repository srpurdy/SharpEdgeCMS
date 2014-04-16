<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('slideshow_admin/new_image/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_image');?></legend>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon">Description English</span>
				<textarea class="form-control" name="desc_one" rows="5" cols="60"></textarea>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">Description French</span>
				<textarea class="form-control" name="desc_two" rows="5" cols="60"></textarea>
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>