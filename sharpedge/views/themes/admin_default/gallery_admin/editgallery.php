<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('gallery_admin/editgallery/' . $this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_gallery');?></legend>
		
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort" value="<?php echo $id->sort_id;?>"/>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>