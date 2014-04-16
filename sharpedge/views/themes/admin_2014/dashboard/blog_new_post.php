<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
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
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>

			<?php echo form_error('text'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_text');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo form_ckeditor('text', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_categories');?></span>
				<select class="form-control" name="tags[]" size=4 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->blog_cat?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>

            <input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>