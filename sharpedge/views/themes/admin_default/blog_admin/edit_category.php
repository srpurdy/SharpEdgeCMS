<div class="form-horizontal">
<?php foreach($query->result() as $id):?>
<?php echo form_open('blog_admin/edit_category/'.$this->uri->segment(3));?>
	<input type="hidden" id="id" name="id" value="<?php echo $id->id?>">
		<fieldset>
			<legend><?php echo $this->lang->line('label_edit_category');?></legend>
			
			<div class="control-group">
			<?php echo form_error('blog_cat'); ?>
			<label class="control-label"><?php echo $this->lang->line('label_name');?></label>
				<div class="controls">
				<input type="text" class="span5" name="blog_cat" value="<?php echo $id->blog_cat?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_language');?></label>
				<div class="controls">
				<select name="lang">
				<option value="<?php echo $this->config->item('language_abbr');?>" selected="selected"><?php echo $this->lang->line('label_language');?></option>
				<?php foreach($langs->result() as $la):?>
				<option value="<?php echo $la->lang_short?>" <?php if($id->lang == $la->lang_short):?>selected="selected"<?php endif;?>><?php echo $la->lang?></option>
				<?php endforeach; ?>
				</select>
				</div>
			</div>
            
            <div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
		</fieldset>
<?php echo form_close();?>
<?php endforeach;?>
</div>