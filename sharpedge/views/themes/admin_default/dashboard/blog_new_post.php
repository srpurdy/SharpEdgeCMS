<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
<style type="text/css">
.control-group{margin-top:3px !important;margin-bottom:3px !important;}
.form-actions{margin-top:3px !important;margin-bottom:3px !important;}
</style>
<div style="width:90%;margin-left:25px;">
<div>
<?php echo form_open_multipart('dashboard/add_news');?>
	<input type="hidden" id="id" name="date" value="<?php echo $date?>">
	<input type="hidden" id="id" name="add_image" value="N">
	<input type="hidden" id="id" name="gallery_display" value="N">
	<input type="hidden" id="id" name="active" value="Y">
	<?php $get_user = $this->ion_auth_model->get_user_name($this->session->userdata('user_id'));?>
	<?php foreach($get_user->result() as $gu):?>
	<?php endforeach;?>
	<input type="hidden" value="<?php echo $gu->first_name . ' ' . $gu->last_name?>" name="postedby"/>
		<fieldset>
			
			<div class="control-group">
			<?php echo form_error('name'); ?>
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="span6" name="name" value="<?php echo set_value('name');?>" />
				</div>
			</div>

			<div class="control-group">
			<?php echo form_error('text'); ?>
			<label class="control-label"><?php echo $this->lang->line('label_text');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo form_ckeditor('text', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_categories');?></label>
				<div class="controls">
				<select class="span6" name="tags[]" size=4 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->blog_cat?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang" class="span6">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

            <input class="btn" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
</div>
</div>