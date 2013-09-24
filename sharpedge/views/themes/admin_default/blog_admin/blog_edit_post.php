<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('blog_admin/edit_blog_post/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="blog_id" value="<?php echo $id->blog_id?>">
	<input type="hidden" id="id" name="url_name" value="<?php echo $id->url_name?>">
	<input type="hidden" value="<?php echo $id->postedby?>" name="postedby"/><br />
		<fieldset>
			<legend><?php echo $this->lang->line('blog_edit_post');?></legend>
			
			<div class="control-group">
			<?php echo form_error('name');?>
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_image');?></label>
				<div class="controls">
				<input type="text" class="field" name="userfile" value="<?php echo $id->userfile?>" />
				</div>
			</div>
					
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_update_image');?></label>
				<div class="controls">
				<select name="update_image">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<?php echo form_error('userfile2'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_replace_image');?></label>
				<div class="controls">
				<input type="file" class="field" name="userfile2" value="" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_date');?></label>
				<div class="controls">
				<input type="text" class="field" name="date" value="<?php echo $id->date?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_author');?></label>
				<div class="controls">
				<input type="text" class="field" name="postedby" value="<?php echo $id->postedby?>" />
				</div>
			</div>
			
			<div class="control-group">
			<?php echo form_error('text'); ?>
			<label class="control-label"><?php echo $this->lang->line('label_text');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->text;
				echo form_ckeditor('text', $textareaContent);?>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_categories');?></label>
				<div class="controls">
				<select class="field" class="field" name="tags[]" size=10 multiple>
				<?php foreach($tags->result() as $catname) : ?>
				<option value="<?php echo $catname->id;?>"
				<?php foreach($get_categories->result() as $gc):?>
				<?php if($catname->id == $gc->cat_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $catname->blog_cat?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_display');?></label>
				<div class="controls">
				<select name="gallery_display">
				<option value="Y"<?php if($id->gallery_display == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->gallery_display == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('blog_gallery_cat');?></label>
				<div class="controls">
				<select name="gallery_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($get_galleries->result() as $gg):?>
				<option value="<?php echo $gg->id?>" <?php if($id->gallery_id == $gg->id):?>selected="selected"<?php endif;?>><?php echo $gg->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_active');?></label>
				<div class="controls">
				<select name="active">
				<option value="Y"<?php if($id->active == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->active == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
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