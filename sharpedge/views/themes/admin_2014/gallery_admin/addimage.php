<?php if ($vcate->result()):?>
<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('gallery_admin/addimage/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_image');?></legend>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>			
				<input type="file" class="form-control" name="userfile" value="" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_category');?></span>
				<select name="cat_id" class="form-control"">
				<?php foreach($vcate->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"<?php if ($catname->id == $this->uri->segment(3)):?> selected="selected" <?php endif; ?>><?php echo $catname->name?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control"" name="sort_id" value=""/>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Description English</span>
				<textarea class="form-control"" name="desc_one" rows="10" cols="60"></textarea>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">Description French</span>
				<textarea class="form-control"" name="desc_two" rows="10" cols="60"></textarea>
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
</div>
<?php else:?>
<p><?php echo $this->lang->line('label_create_a_category');?></p>
<?php endif;?>