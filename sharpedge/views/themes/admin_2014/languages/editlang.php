<div class="form-horizontal">
<?php foreach($query->result() as $id ) : ?>
<?php echo form_open('languages/editlang/'.$this->uri->segment(3));?>
	<fieldset>
		<legend><?php echo $this->lang->line('edit_lang');?></legend>
		
			<input type="hidden" id="id" name="id" value="<?php echo $this->uri->segment(3)?>">

			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_language');?></span>
				<input type="text" class="form-control" name="lang" value="<?php echo $id->lang?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_lang_short');?></span>
				<input type="text" class="form-control" name="lang_short" value="<?php echo $id->lang_short?>" />
			</div>
            
			<input class="btn btn-primary" type="submit" value="Submit" />
			
	</fieldset>
<?php echo form_close();?>
<?php endforeach; ?>
</div>