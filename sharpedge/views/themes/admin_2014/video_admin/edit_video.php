<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('video_admin/edit_video/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="video_id" value="<?php echo $id->video_id?>">
	<input type="hidden" id="id" name="url_name" value="<?php echo $id->url_name?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_video');?></legend>
			
			<?php echo form_error('name');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_vid');?></span>
				<input type="text" class="form-control" name="vid" value="<?php echo $id->vid;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_start_time');?></span>
				<input type="text" class="form-control" name="play_time" value="<?php echo $id->play_time;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_image');?></span>
				<input type="text" class="form-control" name="userfile" value="<?php echo $id->userfile?>" />
			</div>
					
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_update_image');?></span>
				<select name="update_image" class="form-control">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<?php echo form_error('userfile2'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_replace_image');?></span>
				<input type="file" class="form-control" name="userfile2" value="" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_date');?></span>
				<input type="text" class="form-control" name="date" value="<?php echo $id->date?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_author');?></span>
				<input type="text" class="form-control" name="postedby" value="<?php echo $id->postedby?>" />
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_text');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->text;
				echo form_ckeditor('text', $textareaContent);?>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_categories');?></span>
				<select class="form-control" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id;?>"
				<?php foreach($get_categories->result() as $gc):?>
				<?php if($catname->id == $gc->cat_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $catname->video_cat?></option>
				<?php endforeach;?>
				</select>
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
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_segment');?></span>
				<select name="is_segment" class="form-control">
				<option value="Y"<?php if($id->is_segment == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->is_segment == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_active');?></span>
				<select name="active" class="form-control">
				<option value="Y"<?php if($id->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>