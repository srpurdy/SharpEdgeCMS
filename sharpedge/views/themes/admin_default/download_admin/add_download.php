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
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="download_name" value="<?php echo set_value('download_name');?>" />
				</div>
			</div>
			
			<?php echo form_error('userfile'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_filename');?></label>		
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
				</div>
			</div>

			<?php echo form_error('text'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_description');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('desc');
				echo form_ckeditor('desc', $textareaContent);?>
				</div>
			</div>
			
			<?php echo form_error('sort_id'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="field" name="sort_id" value="<?php echo set_value('sort_id');?>" />
				</div>
			</div>
	
	
			<?php echo form_error('isProduct'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_is_product');?></label>
				<div class="controls">
				<select name="isProduct">
				<option value="N" <?php echo set_select('isProduct', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('isProduct', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
</div>
<script type="text/javascript">
// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace('message',
	{
		toolbar :
        [
			['Format', 'Source', 'Maximize', 'ShowBlocks', 'Preview'],
			['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
			['Find', 'Replace', 'SelectAll', 'SpellChecker', 'Scayt'],
			['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'],
			['NumberedList', 'BulletedList', 'Blockquote', 'CreateDiv', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Link', 'Unlink', 'Anchor'],
			['Image','Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar','Iframe'],
        ]
	});

	// Just call CKFinder.SetupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, '<?php echo site_url();?>/ckfinder_ci/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.SetupCKEditor( editor, { BasePath : '../../', RememberLastFolder : false } ) ;
}
</script>