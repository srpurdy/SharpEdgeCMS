<div class="form-horizontal">
<?php echo form_open('contact');?>
	<fieldset>
            <input type="hidden" name="subject" value="<?php echo $this->config->item('contact_subject');?>"/>
			<?php if($this->config->item('multi_contact') == '1'):?>
				<div class="control-group">
				<label class="control-label"><?php echo $this->lang->line('label_select_contact');?></label>
					<div class="controls">
					<select name="contact_address">
					<?php foreach($addresses->result() as $a):?>
					<option value="<?php echo $a->email?>"><?php echo $a->contact_name?></option>
					<?php endforeach; ?>
					</select>
					</div>
				</div>
			<?php else:?>
				<?php foreach($addresses->result() as $a):?>
				<input type="hidden" name="contact_address" value="<?php echo $a->email?>"/>
				<?php endforeach;?>
			<?php endif;?>
			
			<?#LEFTSIDE SIDE FIELDS?>
			<div class="span6">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'left'):?>
			<?php echo form_error($gf->name); ?>
			
			<?php if($gf->type == 'input'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<input type="text" class="field" name="<?php echo url_title($gf->name)?>" value="" />
				</div>
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<select name="<?php echo url_title($gf->name)?>">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<?php elseif($gf->type == 'label'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?></label>
			</div>
			
			<?php elseif($gf->type == 'para'):?>
			<p><?php echo $gf->name;?></p>
			
			<?php elseif($gf->type == 'text'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<textarea class="span6" name="<?php echo url_title($gf->name)?>" rows="10" cols="25"></textarea>
				</div>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="control-group">
				<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
					<div class="controls">
					<?php if($gf->array_name == 'states'):?>
					<?echo states_dropdown($gf->name);?>
					<?php elseif($gf->array_name == 'country'):?>
					<?echo country_dropdown($gf->name);?>
					<?php endif;?>
					</div>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<?#RIGHT SIDE FIELDS?>
			<div class="span6">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'right'):?>
			<?php echo form_error($gf->name); ?>
			<?php if($gf->type == 'input'):?>
			
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<input type="text" class="field" name="<?php echo url_title($gf->name)?>" value="" />
				</div>
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<select name="<?php echo url_title($gf->name)?>">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<?php elseif($gf->type == 'label'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?></label>
			</div>
			
			<?php elseif($gf->type == 'para'):?>
			<p><?php echo $gf->name;?></p>
			
			<?php elseif($gf->type == 'text'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<textarea class="span6" name="<?php echo url_title($gf->name)?>" rows="10" cols="25"></textarea>
				</div>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="control-group">
				<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
					<div class="controls">
					<?php if($gf->array_name == 'states'):?>
					<?echo states_dropdown($gf->name);?>
					<?php elseif($gf->array_name == 'country'):?>
					<?echo country_dropdown($gf->name);?>
					<?php endif;?>
					</div>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<div style="clear: both;"></div>
			
			<?#CENTER FIELDS?>
			<div class="span12">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'center'):?>
			<?php echo form_error($gf->name); ?>
			<?php if($gf->type == 'input'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<input type="text" class="field" name="<?php echo url_title($gf->name)?>" value="" />
				</div>
			</div>
			<?php elseif($gf->type == 'select'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<select name="<?php echo url_title($gf->name)?>">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
				</select>
				</div>
			</div>
			
			<?php elseif($gf->type == 'label'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?></label>
			</div>
			
			<?php elseif($gf->type == 'para'):?>
			<p><?php echo $gf->name;?></p>
			
			<?php elseif($gf->type == 'text'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
				<div class="controls">
				<textarea class="span8" name="<?php echo url_title($gf->name)?>" rows="15" cols="70"></textarea>
				</div>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="control-group">
				<label class="control-label"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></label>
					<div class="controls">
					<?php if($gf->array_name == 'states'):?>
					<?echo states_dropdown($gf->name);?>
					<?php elseif($gf->array_name == 'country'):?>
					<?echo country_dropdown($gf->name);?>
					<?php endif;?>
					</div>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<div class="span12">
			<?php if($this->config->item('security_image') == '1'):?>
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('label_security_code');?></label>
			<script type="text/javascript">
			  var RecaptchaOptions = { 
				theme: "<?php echo $this->config->item('re_theme', 'recaptcha');?>",
				lang: "en"
			  };
			</script>
					<div class="controls">
					<script type="text/javascript" src="<?php echo $server?>/challenge?k=<?php echo $key.$errorpart?>"></script>
					</div>
			<noscript>
					<div class="controls">
					<iframe src="<?php echo $server?>/noscript?lang=<?php echo $lang?>&k=<?php echo $key.$errorpart?>" height="300" width="500" frameborder="0"></iframe>
					<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
					<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
					</div>
			</noscript>
			</div>
			<?php endif;?>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>