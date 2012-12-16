<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('languages/editlang/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('edit_lang');?></legend>
		
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">

			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<input type="text" class="field" name="lang" value="<?php echo $id->lang?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_lang_short');?></label>
				<div class="controls">
				<input type="text" class="field" name="lang_short" value="<?php echo $id->lang_short?>" />
				</div>
			</div>
            
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>