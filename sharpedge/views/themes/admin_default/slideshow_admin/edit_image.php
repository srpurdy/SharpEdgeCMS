<div class="form-horizontal">
<?php foreach($edit_image->result() as $id ):?>
<?php echo form_open('slideshow_admin/edit_image/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_image');?></legend>
			
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="text" class="field" name="userfile" value="<?php echo $id->userfile?>" />
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="<?php echo $id->sort_id?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Description English</label>
				<div class="controls">
				<textarea class="span5" name="desc_one" rows="20" cols="60"><?php echo $id->desc_one?></textarea>
				</div>
			</div>
		
			<div class="control-group">
			<label class="control-label">Description French</label>
				<div class="controls">
				<textarea class="span5" name="desc_two" rows="20" cols="60"><?php echo $id->desc_two?></textarea>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>