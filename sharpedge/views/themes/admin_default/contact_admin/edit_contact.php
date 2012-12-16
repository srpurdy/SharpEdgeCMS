<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('contact_admin/edit_contact/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_contact');?></legend>
			
			<?php echo form_error('contact_name'); ?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="contact_name" value="<?php echo $id->contact_name?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_email_address');?></label>
				<div class="controls">
				<input type="text" class="field" name="email" value="<?php echo $id->email?>" />
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>