<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('download_admin/edit_download/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="download_id" value="<?php echo $id->download_id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_download');?></legend>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="download_name" value="<?php echo $id->download_name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_filename');?></label>
				<div class="controls">
				<input type="text" class="field" name="current_file" value="<?php echo $id->userfile?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_update_file');?></label>
				<div class="controls">
				<select name="update_download">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_filename');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>

			<?php echo form_error('desc'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->desc;
				echo form_ckeditor('desc', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="<?php echo $id->sort_id?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_is_product');?></label>
				<div class="controls">
				<select name="isProduct">
				<option value="N"<?php if($id->isProduct == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"<?php if($id->isProduct == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>