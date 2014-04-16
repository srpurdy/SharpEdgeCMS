<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('contact_admin/edit_contact/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_contact');?></legend>
			
			<?php echo form_error('contact_name'); ?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_name');?></span>
				<input type="text" class="form-control" name="contact_name" value="<?php echo $id->contact_name?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_email_address');?></span>
				<input type="text" class="form-control" name="email" value="<?php echo $id->email?>" />
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />

		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>