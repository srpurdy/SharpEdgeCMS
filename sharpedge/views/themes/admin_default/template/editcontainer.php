<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('template/editcontainer/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('label_edit_layout');?></legend>

			<input type="hidden" id="id" name="c_id" value="<?php echo $this->uri->segment(3)?>" />
		
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="field" name="container_name" value="<?php echo $id->container_name?>" />
				</div>
			</div>
 
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('label_submit');?>" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>