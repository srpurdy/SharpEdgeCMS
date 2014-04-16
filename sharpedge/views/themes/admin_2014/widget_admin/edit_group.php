<div class="form-horizontal">
<?php foreach($edit_group->result() as $id):?>
<?php echo form_open('widget_admin/edit_group/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_group');?></legend>
		
			<input type="hidden" class="field" value="<?php echo $id->id?>" name="id" />
			
			<?php echo form_error('name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" value="<?php echo $id->name?>" name="name" />
			</div>
			
			<div class="input-group">
			<?php foreach($w_locations->result() as $wl) : ?>
				<span class="input-group-addon">Modules <?php echo $this->lang->line('label_widget_'. $wl->name);?></span>
				<select class="form-control" name="modules_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($modules->result() as $m) : ?>
				<option value="<?php echo $m->id;?>"
				<?php foreach($selected_modules->result() as $sm):?>
				<?php if($m->id == $sm->rel_id AND $wl->id == $sm->location_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $m->name?></option>
				<?php endforeach;?>
				</select>
			<?php endforeach;?>
			</div>
			
			<div class="input-group">
			<?php foreach($w_locations->result() as $wl) : ?>
				<span class="input-group-addon">Pages <?php echo $this->lang->line('label_widget_'. $wl->name);?></span>				
				<select class="form-control" name="pages_<?php echo $wl->name;?>[]" size=10 multiple>
				<?php foreach($pages->result() as $p) : ?>
				<option value="<?php echo $p->id;?>"
				<?php foreach($selected_pages->result() as $sp):?>
				<?php if($p->id == $sp->rel_id AND $wl->id == $sp->location_id):?>
				selected="selected"
				<?php endif;?>
				<?php endforeach;?>><?php echo $p->name?></option>
				<?php endforeach;?>
				</select>
			<?php endforeach;?>
			</div>
			
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>