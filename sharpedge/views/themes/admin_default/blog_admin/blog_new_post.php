<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
<div class="form-horizontal">
<?php echo form_open_multipart('blog_admin/new_blog_post');?>
	<input type="hidden" id="id" name="date" value="<?php echo $date?>">
	<?php $get_user = $this->ion_auth_model->get_user_name($this->session->userdata('user_id'));?>
	<?php foreach($get_user->result() as $gu):?>
	<?php endforeach;?>
	<input type="hidden" value="<?php echo $gu->first_name . ' ' . $gu->last_name?>" name="postedby"/>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_post');?></legend>
			
			<div class="control-group">
			<?php echo form_error('name'); ?>
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="span10" name="name" value="<?php echo set_value('name');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_add_image');?></label>
				<div class="controls">
				<select name="add_image">
				<option value="Y" <?php echo set_select('add_image', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('add_image', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile" value="" />
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
				<select class="field" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->blog_cat?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_display');?></label>
				<div class="controls">
				<select name="gallery_display">
				<option value="Y" <?php echo set_select('gallery_display', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('gallery_display', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_cat');?></label>
				<div class="controls">
				<select name="gallery_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($get_galleries->result() as $gg):?>
				<option value="<?=$gg->id?>" <?php echo set_select('gallery_id', $gg->id);?>><?=$gg->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_active');?></label>
				<div class="controls">
				<select name="active">
				<option value="Y" <?php echo set_select('active', 'Y', TRUE);?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('active', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
            <div class="form-actions">
            <input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
		</fieldset>
<?php echo form_close();?>
</div>