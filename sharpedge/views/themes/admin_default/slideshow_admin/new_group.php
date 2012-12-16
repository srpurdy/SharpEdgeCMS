<div class="form-horizontal">
<?php echo form_open('slideshow_admin/new_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_images');?></label>
				<div class="controls">
				<select class="field" class="field" name="images[]" size=10 multiple>
				<?php foreach($images->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->userfile?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>