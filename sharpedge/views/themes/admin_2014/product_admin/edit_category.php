<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('product_admin/edit_category/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_category');?></legend>
			
			<?php echo form_error('category_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="category_name" value="<?php echo $id->category_name?>" />
			</div>	
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_filename');?></span>
				<input type="text" class="form-control" name="current_file" value="<?php echo $id->userfile?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_update_image');?></span>
				<select name="update_image" class="form-control">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_parent');?></span>
				<input type="text" class="form-control" name="parent_id" value="<?php echo $id->parent_id?>" />
			</div>
			
			<?php echo form_error('desc'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->desc;
				echo form_ckeditor('desc', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id;?>" />
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>