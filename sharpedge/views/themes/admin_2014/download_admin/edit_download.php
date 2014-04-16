<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('download_admin/edit_download/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="download_id" value="<?php echo $id->download_id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_download');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="download_name" value="<?php echo $id->download_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_filename');?></span>
				<input type="text" class="form-control" name="current_file" value="<?php echo $id->userfile?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_update_file');?></span>
				<select name="update_download" class="form-control">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_filename');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>

			<?php echo form_error('desc'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->desc;
				echo form_ckeditor('desc', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_product');?></span>
				<select name="isProduct" class="form-control">
				<option value="N"<?php if($id->isProduct == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->isProduct == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>