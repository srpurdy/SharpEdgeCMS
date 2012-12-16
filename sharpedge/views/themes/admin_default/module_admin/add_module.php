<div class="form-horizontal">
<?php echo form_open('module_admin/add_module/');?>
	<fieldset>
		<legend><?php echo $this->lang->line('new_controller');?></legend>       
		
			<?php echo form_error('name');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="name" value="<?php echo set_value('name');?>" />
				</div>
			</div>
			
			<?php echo form_error('container');?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_layout');?></label>
				<div class="controls">
				<input type="text" class="field" name="container" value="<?php echo form_error('container');?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_slide_group');?></label>
				<div class="controls">
				<select name="slide_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_slide');?></option>
				<?php foreach($get_slideshow->result() as $ss):?>
				<option value="<?php echo $ss->id?>" <?php echo set_select('slide_id', $ss->id);?>><?php echo $ss->name?></option>
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
				<option value="<?php echo $set->id?>" <?php echo set_select('side_top', $set->id);?>><?php echo $set->name?></option>
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
				<option value="<?php echo $set->id?>" <?php echo set_select('side_bottom', $set->id);?>><?php echo $set->name?></option>
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
				<option value="<?php echo $set->id?>" <?php echo set_select('content_top', $set->id);?>><?php echo $set->name?></option>
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
				<option value="<?php echo $set->id?>" <?php echo set_select('content_bottom', $set->id);?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_is_admin_module');?></label>
				<div class="controls">
				<input type="radio" name="is_admin" value="N" <?php echo set_radio('is_admin', 'N');?>><?php echo $this->lang->line('label_no');?>
				<input type="radio" name="is_admin" value="Y" <?php echo set_radio('is_admin', 'Y');?>><?php echo $this->lang->line('label_yes');?>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>