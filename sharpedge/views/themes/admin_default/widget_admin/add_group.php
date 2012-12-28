<div class="form-horizontal">
<?php echo form_open('widget_admin/new_widget_group');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" value="<?php echo set_value('name'); ?>" name="name" />
				</div>
			</div>
			
			<div class="control-group pull-left">
			<?php foreach($w_locations->result() as $wl) : ?>
			<label class="control-label">Modules <?php echo $this->lang->line('label_widget_'. $wl->name);?></label>
				<div class="controls">
				<select class="field" class="field" name="modules_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($modules->result() as $m) : ?>
				<option value="<?php echo $m->id;?>"><?php echo $m->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			<?php endforeach;?>
			</div>
			
			<div class="control-group pull-right">
			<?php foreach($w_locations->result() as $wl) : ?>
			<label class="control-label">Pages <?php echo $this->lang->line('label_widget_'. $wl->name);?></label>
				<div class="controls">				
				<select class="field" class="field" name="pages_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($pages->result() as $p) : ?>
				<option value="<?php echo $p->id;?>"><?php echo $p->name?></option>
				<?php endforeach;?>
				</select>
				</div>
			<?php endforeach;?>
			</div>
			
			<div class="clearfix"></div>
			
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>