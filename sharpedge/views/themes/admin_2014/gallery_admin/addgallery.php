<div class="form-horizontal">
<?php echo form_open('gallery_admin/addgallery/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_gallery');?></legend>
		
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value=""/>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_parent');?></span>
				<input type="text" class="form-control" name="parent_id" value="0"/>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort" value=""/>
			</div>

			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
</div>