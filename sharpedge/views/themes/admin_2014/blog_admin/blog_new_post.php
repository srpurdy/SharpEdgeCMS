<?php
$datestring = "Y-m-d H:i:s";
$time = time();
$date = gmdate($datestring, $time);
?>
<div class="form-horizontal">
<?php echo form_open_multipart('blog_admin/new_blog_post');?>
	<input type="hidden" id="id" name="date" value="<?php echo $date?>">
	<input type="hidden" id="author_id" name="author_id" value="<?php echo $this->session->userdata('user_id');?>">
	<?php $get_user = $this->ion_auth_model->get_user_name($this->session->userdata('user_id'));?>
	<?php foreach($get_user->result() as $gu):?>
	<?php endforeach;?>
	<input type="hidden" value="<?php echo $gu->first_name . ' ' . $gu->last_name?>" name="postedby"/>
		<fieldset>
			<legend><?php echo $this->lang->line('label_new_post');?></legend>
			
			<div class="col-md-8">
			<?php echo form_error('name'); ?>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_text');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo form_ckeditor('text', $textareaContent);?>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short);?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
				<select name="active" class="form-control">
				<option value="Y" <?php echo set_select('active', 'Y', TRUE);?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('active', 'N');?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			</div>
			
			<div class="col-md-4">
			<div class="input-group pull-left">
				<input class="btn btn-lg btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			<div class="clearfix"></div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_add_image');?></span>
				<select name="add_image" class="form-control">
				<option value="Y" <?php echo set_select('add_image', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('add_image', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="file" class="form-control" name="userfile" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon input-lg"><?php echo $this->lang->line('label_categories');?></span>
				<select class="form-control" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id?>"><?php echo $catname->blog_cat?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_display');?></span>
				<select name="gallery_display" class="form-control">
				<option value="Y" <?php echo set_select('gallery_display', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php echo set_select('gallery_display', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_cat');?></span>
				<select name="gallery_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($get_galleries->result() as $gg):?>
				<option value="<?=$gg->id?>" <?php echo set_select('gallery_id', $gg->id);?>><?=$gg->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
		</fieldset>
<?php echo form_close();?>
</div>