<div class="form-horizontal">
<?php foreach($edit_image->result() as $id ):?>
<?php echo form_open('gallery_admin/editimage/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_image');?></legend>
			<input type="hidden" id="id" name="photo_id" value="<?php echo $this->uri->segment(4)?>">

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="text" class="form-control" name="userfile" value="<?php echo $id->userfile?>" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_category');?></span>
				<select id="catid" class="form-control" name="cat_id">
				<?php foreach($vcate->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>" <?php if ($id->cat_id == $catname->id):?> selected="selected"<?php endif; ?>><?php echo $catname->name?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id?>"/>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Description English</span>
				<textarea class="form-control" name="desc_one" rows="10" cols="60"><?php echo $id->desc_one?></textarea>
			</div>

			<div class="input-group">
				<span class="input-group-addon">Description French</span>
				<textarea class="form-control" name="desc_two" rows="10" cols="60"><?php echo $id->desc_two?></textarea>
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>