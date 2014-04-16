<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('module_admin/edit_module/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_module');?></legend>

		    <input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="name" value="<?php echo $id->name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_layout');?></span>
				<input type="text" class="form-control" name="container" value="<?php echo $id->container?>" />
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
			
			<?php $i = 0;?>
			<?php foreach($w_locations->result() as $wl):?>
			<?php if($widget_location[$i]->result()):?>
			<?php foreach($widget_location[$i]->result() as $wdl):?>
			<?php $group_id = $wdl->group_id;?>
			<?php endforeach;?>
			<?php else:?>
			<?php $group_id = 0;?>
			<?php endif;?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_widget_' . $wl->name);?></span>
				<select name="<?php echo $wl->name;?>" class="form-control">
				<option value="0" <?php if ($group_id  == 0):?> selected="selected" <?php endif; ?>><?php echo $this->lang->line('label_none');?></option>
				<?php foreach($groups->result() as $set):?>
				<option value="<?php echo $set->id?>" <?php if ($group_id  == $set->id):?> selected="selected" <?php endif; ?>><?php echo $set->name?></option>
				<?php endforeach;?>
				</select>
			</div>
			<?php $i++;?>
			<?php endforeach;?>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_is_admin_module');?></span>
				<div class="form-control">
				<input type="radio" name="is_admin" value="N" <?php if($id->is_admin == 'N'):?>checked<?php endif;?>><?php echo $this->lang->line('label_no');?>
				<input type="radio" name="is_admin" value="Y" <?php if($id->is_admin == 'Y'):?>checked<?php endif;?>><?php echo $this->lang->line('label_yes');?>
				</div>
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>