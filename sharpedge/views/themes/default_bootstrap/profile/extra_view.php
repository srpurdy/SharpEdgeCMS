<div class="form-horizontal">
<?php $attributes = array('name' => 'page');?>
<?php echo form_open_multipart('profile/custom_fields', $attributes);?>
<fieldset>
	<legend><?php echo $this->lang->line('label_extra_fields');?></legend>
		<?php foreach($fields->result() as $gf):?>
		<?php $field = $this->profile_model->get_user_fields($gf->id);?>
		<?php $fvalue = '';?>
		<?php foreach($field->result() as $f):?>
		<?php $fvalue = $f->value;?>
		<?php endforeach;?>
			<?php if($gf->type == 'input'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<input type="text" class="form-control" name="<?php echo url_title($gf->name)?>" value="<?php echo $fvalue;?>" />
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<option value="Y" <?php if($fvalue == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
				<option value="N" <?php if($fvalue == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
				</select>
			</div>
			
			<?php elseif($gf->type == 'label'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?></span>
			</div>
			
			<?php elseif($gf->type == 'para'):?>
			<p><?php echo $gf->name;?></p>
			
			<?php elseif($gf->type == 'text'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<textarea class="form-control" name="<?php echo url_title($gf->name)?>" rows="10" cols="25"><?php echo $fvalue;?></textarea>
			</div>
			
			<?php elseif($gf->type == 'array'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<?php $list_items = explode(',', $gf->list);?>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<?php for($i = 0; $i < count($list_items); $i++):?>
				<option value="<?php echo url_title($list_items[$i]);?>" <?php if(url_title($list_items[$i]) == $fvalue):?>selected="selected"<?php endif;?>><?php echo url_title($list_items[$i]);?></option>
				<?php endfor;?>
				</select>
				</div>
			<?php endif;?>
		<?php endforeach;?>
		
		<div class="form-actions">
		<input class="btn btn-primary" type="submit" value="Submit" />
		</div>
</fieldset>
<?php echo form_close();?>
</div>