<?php if ($vcate->result()):?>
<div class="form-horizontal">
<?php echo $error?>
<?php echo form_open_multipart('gallery_admin/addimage/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_image');?></legend>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>			
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_category');?></label>
				<div class="controls">
				<select name="cat_id">
				<?php foreach($vcate->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"<?php if ($catname->id == $this->uri->segment(3)):?> selected="selected" <?php endif; ?>><?php echo $catname->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value=""/>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label">Description English</label>
				<div class="controls">
				<textarea class="span7" name="desc_one" rows="20" cols="60"></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Description French</label>
				<div class="controls">
				<textarea class="span7" name="desc_two" rows="20" cols="60"></textarea>
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