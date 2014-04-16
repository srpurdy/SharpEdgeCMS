<div class="form-horizontal">
<?php echo form_open('widget_admin/new_widget_group');?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_add_group');?></legend>
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" value="<?php echo set_value('name'); ?>" name="name" />
			</div>
			
			<div class="input-group">
			<?php foreach($w_locations->result() as $wl) : ?>
				<span class="input-group-addon">Modules <?php echo $this->lang->line('label_widget_'. $wl->name);?></span>
				<select class="form-control" name="modules_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($modules->result() as $m) : ?>
				<option value="<?php echo $m->id;?>"><?php echo $m->name?></option>
				<?php endforeach;?>
				</select>
			<?php endforeach;?>
			</div>
			
			<div class="input-group">
			<?php foreach($w_locations->result() as $wl) : ?>
				<span class="input-group-addon">Pages <?php echo $this->lang->line('label_widget_'. $wl->name);?></span>			
				<select class="form-control" name="pages_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($pages->result() as $p) : ?>
				<option value="<?php echo $p->id;?>"><?php echo $p->name?></option>
				<?php endforeach;?>
				</select>
			<?php endforeach;?>
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
</div>