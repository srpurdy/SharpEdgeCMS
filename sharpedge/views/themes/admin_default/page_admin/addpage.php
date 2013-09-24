<div class="form-horizontal">
<?php echo form_open('page_admin/addpage/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_page');?></legend>
		
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_title');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo set_value('name');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_container');?></label>
				<div class="controls">
				<select name="container_name">
				<option value="/container" selected="selected"><?php echo $this->lang->line('label_select_container');?></option>
				<?php foreach($containers->result() as $ct):?>
				<option value="<?php echo $ct->container_name?>" <?php echo set_select('container_name', $ct->container_name);?>><?php echo $ct->container_name?></option>
				<?php endforeach; ?>
				</select>
				<?php echo set_select('container_name');?>
				</div>
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_page_content');?></label>
				<div class="controls">
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo form_ckeditor('text', $textareaContent);?>
				</div>
			</div>
		
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_meta_description');?></label>
				<div class="controls">
				<textarea class="span5" name="meta_desc" rows="10" cols="60"><?php echo set_value('meta_desc');?></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_meta_keywords');?></label>
				<div class="controls">
				<textarea class="span5" name="meta_keywords" rows="10" cols="60"><?php echo set_value('meta_keywords');?></textarea>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_slide_group');?></label>
				<div class="controls">
				<select name="slide_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php echo set_select('slide_id', $ss->id, FALSE);?>><?php echo $ss->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_side_top');?></label>
				<div class="controls">
				<select name="side_top">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_side_bottom');?></label>
				<div class="controls">
				<select name="side_bottom">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_content_top');?></label>
				<div class="controls">
				<select name="content_top">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_widget_content_bottom');?></label>
				<div class="controls">
				<select name="content_bottom">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
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
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short, FALSE);?>><?php echo $la->lang?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_hide');?></label>
				<div class="controls">
				<select name="hide">
				<option value="N" <?php echo set_select('hide', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('hide', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_save_as_draft');?></label>
				<div class="controls">
				<select name="draft">
				<option value="N" <?php echo set_select('draft', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('draft', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_restrict_access');?></label>
				<div class="controls">
				<select name="restrict_access">
				<option value="N" <?php echo set_select('restrict_access', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('restrict_access', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_user_group');?></label>
				<div class="controls">
				<select name="user_group">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($get_user_groups->result() as $ug):?>
				<option value="<?php echo $ug->id?>" <?php echo set_select('user_group', $ug->id, FALSE);?>><?php echo $ug->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>

			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>