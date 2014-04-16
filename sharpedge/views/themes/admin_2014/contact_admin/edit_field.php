<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('contact_admin/edit_field/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_field');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo htmlentities($id->name)?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_field_type');?></span>
				<select name="type" class="form-control">
				<option value="label" <?php if($id->type == 'label'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_label');?></option>
				<option value="para" <?php if($id->type == 'para'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_para_info');?></option>
				<option value="input" <?php if($id->type == 'input'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_input_box');?></option>
				<option value="text" <?php if($id->type == 'text'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_text_area');?></option>
				<option value="select"<?php if($id->type == 'select'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_drop_down');?></option>
				<option value="radio" <?php if($id->type == 'radio'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_radio');?></option>
				<option value="array" <?php if($id->type == 'array'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_array_drop_down');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_array_name');?></span>
				<input type="text" class="form-control" name="array_name" value="<?php echo $id->array_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<select class="form-control" name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_required');?></span>
				<select class="form-control" name="is_required">
				<option value="N" <?php if($id->is_required == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->is_required == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_email');?></span>
				<select class="form-control" name="is_email">
				<option value="N" <?php if($id->is_email == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				<option value="Y" <?php if($id->is_email == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_alignment');?></span>
				<select class="form-control" name="alignment">
				<option value="left" <?php if($id->alignment == 'left'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_left');?></option>
				<option value="center"<?php if($id->alignment == 'center'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_center');?></option>
				<option value="right"<?php if($id->alignment == 'right'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_right');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" name="sort_id" value="<?php echo $id->sort_id?>" />
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />

		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>