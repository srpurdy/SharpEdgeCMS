<div class="form-horizontal">
<?php echo form_open('slideshow_admin/new_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_images');?></span>
				<select class="form-control" name="images[]" size=10 multiple>
				<?php foreach($images->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->userfile?></option>
				<?php endforeach; ?>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>