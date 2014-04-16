<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open_multipart('blog_admin/edit_blog_post/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="blog_id" value="<?php echo $id->blog_id?>">
	<input type="hidden" id="id" name="url_name" value="<?php echo $id->url_name?>">
	<input type="hidden" value="<?php echo $id->postedby?>" name="postedby"/><br />
		<fieldset>
			<legend><?php echo $this->lang->line('blog_edit_post');?></legend>
			
			<?php echo form_error('name');?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name;?>" />
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
				<?php endforeach;?>><?php echo $catname->blog_cat?></option>
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
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_display');?></span>
				<select name="gallery_display" class="form-control">
				<option value="Y"<?php if($id->gallery_display == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"<?php if($id->gallery_display == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('blog_gallery_cat');?></span>
				<select name="gallery_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('blog_select_gallery');?></option>
				<?php foreach($get_galleries->result() as $gg):?>
				<option value="<?php echo $gg->id?>" <?php if($id->gallery_id == $gg->id):?>selected="selected"<?php endif;?>><?php echo $gg->name?></option>
				<?php endforeach; ?>
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