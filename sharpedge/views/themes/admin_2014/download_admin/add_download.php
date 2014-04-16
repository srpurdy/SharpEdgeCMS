<div class="form-horizontal">
<?php echo $error?>
<?php if($this->config->item('enable_direct') == true):?>
<?php echo form_open_multipart($this->config->item('direct_url') . 'download_admin/add_download');?>
<?php else:?>
<?php echo form_open_multipart('download_admin/add_download');?>
<?php endif;?>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_download');?></legend>
			
			<?php echo form_error('download_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="download_name" value="<?php echo set_value('download_name');?>" />
			</div>
			
			<?php echo form_error('userfile'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_filename');?></span>		
				<input type="file" class="form-control" name="userfile" value="" />
			</div>

			<?php echo form_error('text'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_description');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('desc');
				echo form_ckeditor('desc', $textareaContent);?>
			</div>
			
			<?php echo form_error('sort_id'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo set_value('sort_id');?>" />
			</div>
	
	
			<?php echo form_error('isProduct'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_product');?></span>
				<select name="isProduct" class="form-control">
				<option value="N" <?php echo set_select('isProduct', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('isProduct', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
</div>