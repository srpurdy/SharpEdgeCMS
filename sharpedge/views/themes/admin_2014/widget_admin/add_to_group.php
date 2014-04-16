<div class="form-horizontal">
<?php echo form_open('widget_admin/add_to_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_to_group');?></legend>
					
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_group');?></span>
				<select name="group_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_group');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if($this->uri->segment(3) == $set->id):?> selected="selected" <?php endif;?>><?php echo $set->name?></option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_widget');?></span>
				<select name="widget_id" class="form-control">
				<option value="0" selected="selected"><?php echo $this->lang->line('label_select_widget');?></option>
				<?php foreach($widgets->result() as $mod):?>
				<option value="<?php echo $mod->id?>"><?php echo $mod->name?></option>
				<?php endforeach; ?>
				</select>
			</div>
			
			<?php echo form_error('sort_id'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_sort');?></span>
				<input type="text" class="form-control" value="" name="sort_id" />
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>