<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('page_admin/edit_draft/'.$this->uri->segment(3));?>
	<fieldset>
			<legend><?php echo $this->lang->line('label_edit_page');?></legend>
			
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />

			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_title');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_url_title');?></span>
				<input type="text" class="form-control" name="url_name" value="<?php echo $id->url_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_container');?></span>
				<select name="container_name" class="form-control">
				<option value="/container" selected="selected"><?php echo $this->lang->line('label_select_container');?></option>
				<?php foreach($containers->result() as $ct):?>
				<option value="<?php echo $ct->container_name?>" <?php if($id->container_name == $ct->container_name):?>selected="selected"<?php endif;?>><?php echo $ct->container_name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_content');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->text;
				echo form_ckeditor('text', $textareaContent);?>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_description');?></span>
				<textarea class="form-control" name="meta_desc" rows="5" cols="60"><?php echo $id->meta_desc?></textarea>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_keywords');?></span>
				<textarea class="form-control" name="meta_keywords" rows="5" cols="60"><?php echo $id->meta_keywords?></textarea>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_slide_group');?></span>
				<select name="slide_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php if($ss->id == $id->slide_id):?>selected="selected"<?php endif;?>><?php echo $ss->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_top');?></span>
				<select name="side_top" class="form-control">
				<option value="0" <?php if ($id->side_top == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->side_top == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_bottom');?></span>
				<select name="side_bottom" class="form-control">
				<option value="0" <?php if ($id->side_bottom == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->side_bottom == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_top');?></span>
				<select name="content_top" class="form-control">
				<option value="0" <?php if ($id->content_top == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->content_top == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_bottom');?></span>
				<select name="content_bottom" class="form-control">
				<option value="0" <?php if ($id->content_bottom == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->content_bottom == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
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
				<span class="input-group-addon"><?php echo $this->lang->line('label_hide');?></span>
				<select name="hide" class="form-control">
				<option value="N" <?php if($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_save_as_draft');?></span>
				<select name="draft" class="form-control">
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_new_or_exist');?></span>
				<select name="draft_type" class="form-control">
				<option value="New"><?php echo $this->lang->line('label_new_page');?></option>
				<option value="Old"><?php echo $this->lang->line('label_updating_page');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_restrict_access');?></span>
				<select name="restrict_access" class="form-control">
				<option value="N" <?php if($id->restrict_access == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->restrict_access == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_user_group');?></span>
				<select name="user_group" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($get_user_groups->result() as $ug):?>
				<option value="<?php echo $ug->id?>" <?php if($ug->id == $id->user_group):?>selected="selected"<?php endif;?>><?php echo $ug->name?></option>
				<?php endforeach;?>
				</select>
			</div>
            
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>