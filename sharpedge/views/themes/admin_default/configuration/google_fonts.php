<?php $stats = $this->config->load('fonts_config');?>
<?php $google_fonts = $stats . $this->config->item('google_fonts');?>
<?php $new_font = explode('|', $google_fonts);?>
<div class="form-horizontal">
<p><?php echo $this->lang->line('fonts_text');?></p>
<?php echo form_open('configuration/google_fonts/');?>
		<fieldset>
			<legend></legend>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('fonts_config');?></label>
				<div class="controls">
				<select class="field" name="fonts[]" size=10 multiple>
				<?php for($i = 0; $i < count($ga_fonts) -1; $i++):?>
				<option value="<?php echo str_replace(" ", "+", $ga_fonts[$i]);?>"
				<?php for($nf = 0; $nf < count($new_font); $nf++):?>
				<?php if(str_replace(" ", "+", $ga_fonts[$i]) == $new_font[$nf]):?>
				selected="selected"
				<?php endif;?>
				<?php endfor;?>
				>
				<?php echo $ga_fonts[$i];?></option>
				<?php endfor;?>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label">Fonts Selected</label>
				<div class="controls">
				<p>
				<?php for($nf = 0; $nf < count($new_font); $nf++):?>
				<?php echo $new_font[$nf];?><br />
				<?php endfor;?>
				</p>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>