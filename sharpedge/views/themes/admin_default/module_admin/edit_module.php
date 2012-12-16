<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('module_admin/edit_module/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_module');?></legend>

		    <input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo $id->name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_layout');?></label>
				<div class="controls">
				<input type="text" class="field" name="container" value="<?php echo $id->container?>" />
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
			<label class="control-label"><?php echo $this->lang->line('label_is_admin_module');?></label>
				<div class="controls">
				<input type="radio" name="is_admin" value="N" <?php if($id->is_admin == 'N'):?>checked<?php endif;?>><?php echo $this->lang->line('label_no');?>
				<input type="radio" name="is_admin" value="Y" <?php if($id->is_admin == 'Y'):?>checked<?php endif;?>><?php echo $this->lang->line('label_yes');?>
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>