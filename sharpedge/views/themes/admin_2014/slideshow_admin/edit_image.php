<div class="form-horizontal">
<?php foreach($edit_image->result() as $id ):?>
<?php echo form_open('slideshow_admin/edit_image/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_image');?></legend>
			
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="text" class="form-control" name="userfile" value="<?php echo $id->userfile?>" />
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">Description English</span>
				<textarea class="form-control" name="desc_one" rows="5" cols="60"><?php echo $id->desc_one?></textarea>
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">Description French</span>
				<textarea class="form-control" name="desc_two" rows="5" cols="60"><?php echo $id->desc_two?></textarea>
			</div>

			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>