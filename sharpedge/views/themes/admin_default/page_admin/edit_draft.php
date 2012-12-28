<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('page_admin/edit_draft/'.$this->uri->segment(3));?>
	<fieldset>
			<legend><?php echo $this->lang->line('label_edit_page');?></legend>
			
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>" />

			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_title');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_url_title');?></label>
				<div class="controls">
				<input type="text" class="field" name="url_name" value="<?php echo $id->url_name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_container');?></label>
				<div class="controls">
				<select name="container_name">
				<option value="/container" selected="selected"><?php echo $this->lang->line('label_select_container');?></option>
				<?php foreach($containers->result() as $ct):?>
				<option value="<?php echo $ct->container_name?>" <?php if($id->container_name == $ct->container_name):?>selected="selected"<?php endif;?>><?php echo $ct->container_name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_content');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: $id->text;
				echo form_ckeditor('text', $textareaContent);?>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_meta_description');?></label>
				<div class="controls">
				<textarea class="span5" name="meta_desc" rows="10" cols="60"><?php echo $id->meta_desc?></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_meta_keywords');?></label>
				<div class="controls">
				<textarea class="span5" name="meta_keywords" rows="10" cols="60"><?php echo $id->meta_keywords?></textarea>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_slide_group');?></label>
				<div class="controls">
				<select name="slide_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php if($ss->id == $id->slide_id):?>selected="selected"<?php endif;?>><?php echo $ss->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_side_top');?></label>
				<div class="controls">
				<select name="side_top">
				<option value="0" <?php if ($id->side_top == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->side_top == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_side_bottom');?></label>
				<div class="controls">
				<select name="side_bottom">
				<option value="0" <?php if ($id->side_bottom == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->side_bottom == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_content_top');?></label>
				<div class="controls">
				<select name="content_top">
				<option value="0" <?php if ($id->content_top == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->content_top == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_content_bottom');?></label>
				<div class="controls">
				<select name="content_bottom">
				<option value="0" <?php if ($id->content_bottom == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($id->content_bottom == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
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
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide">
				<option value="N" <?php if($id->hide == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->hide == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_save_as_draft');?></label>
				<div class="controls">
				<select name="draft">
				<option value="N" selected="selected"><?php echo $this->lang->line('label_no');?></option>
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_new_or_exist');?></label>
				<div class="controls">
				<select name="draft_type">
				<option value="New"><?php echo $this->lang->line('label_new_page');?></option>
				<option value="Old"><?php echo $this->lang->line('label_updating_page');?></option>
				</select>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>