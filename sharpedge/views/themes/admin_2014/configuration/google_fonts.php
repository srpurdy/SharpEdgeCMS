<?php $stats = $this->config->load('fonts_config');?>
<?php $google_fonts = $stats . $this->config->item('google_fonts');?>
<?php $new_font = explode('|', $google_fonts);?>
<div class="form-horizontal">
<p><?php echo $this->lang->line('fonts_text');?></p>
<?php echo form_open('configuration/google_fonts/');?>
		<fieldset>
			<legend></legend>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('fonts_config');?></span>
				<select class="form-control" name="fonts[]" size=10 multiple>
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
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_fonts_selected');?></span>
				<p class="form-control">
				<?php for($nf = 0; $nf < count($new_font); $nf++):?>
				<?php echo $new_font[$nf];?>,
				<?php endfor;?>
				</p>
			</div>
			

			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>