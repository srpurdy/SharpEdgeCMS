<div class="form-horizontal">
<?php echo form_open('widget_admin/add_to_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_to_group');?></legend>
					
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_select_group');?></label>
				<div class="controls">
				<select name="group_id">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_group');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if($this->uri->segment(3) == $set->id):?> selected="selected" <?php endif;?>><?php echo $set->name?></option>
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
				<option value="<?php echo $mod->id?>"><?php echo $mod->name?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
			
			<?php echo form_error('sort_id'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_sort');?></label>
				<div class="controls">
				<input type="text" class="span1" value="" name="sort_id" />
				</div>
			</div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>