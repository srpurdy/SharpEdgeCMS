<div class="form-horizontal">
<?php echo form_open('page_admin/addpage/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_page');?></legend>
		
			<div class="col-md-8">
			<?php echo form_error('name'); ?>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_title');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo set_value('name');?>" />
			</div>
			
			<?php echo form_error('text'); ?>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_page_content');?></span>
				<?php $textareaContent=(isset($textareaContent))?$textareaContent: set_value('text');
				echo form_ckeditor('text', $textareaContent);?>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select name="lang" class="form-control">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php echo set_select('lang', $la->lang_short, FALSE);?>><?php echo $la->lang?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_description');?></span>
				<textarea class="form-control" name="meta_desc" rows="5" cols="60"><?php echo set_value('meta_desc');?></textarea>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_meta_keywords');?></span>
				<textarea class="form-control" name="meta_keywords" rows="5" cols="60"><?php echo set_value('meta_keywords');?></textarea>
			</div>
			</div>
			
			<div class="col-md-4">
			<div class="input-group pull-left">
				<input class="btn btn-lg btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			<div class="clearfix"></div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_container');?></span>
				<select name="container_name" class="form-control">
				<option value="/container" selected="selected"><?php echo $this->lang->line('label_select_container');?></option>
				<?php foreach($containers->result() as $ct):?>
				<option value="<?php echo $ct->container_name?>" <?php echo set_select('container_name', $ct->container_name);?>><?php echo $ct->container_name?></option>
				<?php endforeach; ?>
				</select>
				<?php echo set_select('container_name');?>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_slide_group');?></span>
				<select name="slide_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php echo set_select('slide_id', $ss->id, FALSE);?>><?php echo $ss->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_top');?></span>
				<select name="side_top" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_side_bottom');?></span>
				<select name="side_bottom" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('side_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_top');?></span>
				<select name="content_top" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_top', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_content_bottom');?></span>
				<select name="content_bottom" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php echo set_select('content_bottom', $set->id, FALSE);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_hide');?></span>
				<select name="hide" class="form-control">
				<option value="N" <?php echo set_select('hide', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('hide', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_save_as_draft');?></span>
				<select name="draft" class="form-control">
				<option value="N" <?php echo set_select('draft', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('draft', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_restrict_access');?></span>
				<select name="restrict_access" class="form-control">
				<option value="N" <?php echo set_select('restrict_access', 'N', TRUE);?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php echo set_select('restrict_access', 'Y');?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><?php echo $this->lang->line('label_user_group');?></span>
				<select name="user_group" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($get_user_groups->result() as $ug):?>
				<option value="<?php echo $ug->id?>" <?php echo set_select('user_group', $ug->id, FALSE);?>><?php echo $ug->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>