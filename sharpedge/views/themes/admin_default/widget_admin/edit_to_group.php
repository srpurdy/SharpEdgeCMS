<div class="form-horizontal">
<?php foreach($widget_in_group->result() as $id):?>
<?php echo form_open('widget_admin/edit_to_group/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_to_group');?></legend>
		
			<input type="hidden" class="field" value="<?php echo $id->gm_id?>" name="gm_id" />
				
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_group');?></label>
				<div class="controls">
				<select name="group_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_group');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if($set->id == $id->group_id):?> selected="selected" <?php endif;?>><?php echo $set->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_widget');?></label>
				<div class="controls">
				<select name="widget_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_widget');?></option>
				<?php foreach($widgets->result() as $mod):?>
				<option value="<?php echo $mod->id?>" <?php if($mod->id == $id->widget_id):?> selected="selected" <?php endif;?>><?php echo $mod->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="span1" value="<?php echo $id->sort_id?>" name="sort_id" />
				</div>
			</div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>