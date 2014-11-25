<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('gallery_admin/editgallery/' . $this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_gallery');?></legend>
		
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_parent');?></span>
				<input type="text" class="form-control" name="parent_id" value="<?php echo $id->parent_id?>"/>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort" value="<?php echo $id->sort_id;?>"/>
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>