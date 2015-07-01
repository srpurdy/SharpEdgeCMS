<?php
$math_captcha = array('name' => 'math_captcha',
	'class' => 'form-control',
);
?>
<div class="form-horizontal">
<?php echo form_open('contact');?>
	<fieldset>
            <input type="hidden" name="subject" value="<?php echo $this->config->item('contact_subject');?>"/>
			<?php if($this->config->item('multi_contact') == '1'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('label_select_contact');?></span>
					<select name="contact_address" class="form-control">
					<?php foreach($addresses->result() as $a):?>
					<option value="<?php echo $this->encrypt->encode($a->email);?>"><?php echo $a->contact_name?></option>
					<?php endforeach; ?>
					</select>
				</div>
			<?php else:?>
				<?php foreach($addresses->result() as $a):?>
				<input type="hidden" name="contact_address" value="<?php echo $this->encrypt->encode($a->email);?>"/>
				<?php endforeach;?>
			<?php endif;?>
			
			<?#LEFTSIDE SIDE FIELDS?>
			<div class="col-md-6" style="padding:0px;">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'left'):?>
			<?php echo form_error($gf->name); ?>
			
			<?php if($gf->type == 'input'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<input type="text" class="form-control" name="<?php echo url_title($gf->name)?>" value="" />
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
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
				<textarea class="form-control" name="<?php echo url_title($gf->name)?>" rows="10" cols="25"></textarea>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
					<?php if($gf->array_name == 'states'):?>
					<?php echo states_dropdown($gf->name, '', 'form-control', '', array(), '');?>
					<?php elseif($gf->array_name == 'country'):?>
					<?php echo country_dropdown($gf->name, '', 'form-control', '', array(), '');?>
					<?php endif;?>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<?#RIGHT SIDE FIELDS?>
			<div class="col-md-6" style="padding:0px;">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'right'):?>
			<?php echo form_error($gf->name); ?>
			<?php if($gf->type == 'input'):?>
			
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<input type="text" class="form-control" name="<?php echo url_title($gf->name)?>" value="" />
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
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
				<textarea class="form-control" name="<?php echo url_title($gf->name)?>" rows="10" cols="25"></textarea>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
					<?php if($gf->array_name == 'states'):?>
					<?php echo states_dropdown($gf->name, '', 'form-control', '', array(), '');?>
					<?php elseif($gf->array_name == 'country'):?>
					<?php echo country_dropdown($gf->name, '', 'form-control', '', array(), '');?>
					<?php endif;?>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<div style="clear: both;"></div>
			
			<?#CENTER FIELDS?>
			<div class="col-md-12" style="padding:0px;">
			<?php foreach($fields->result() as $gf):?>
			<?php if($gf->alignment == 'center'):?>
			<?php echo form_error($gf->name); ?>
			<?php if($gf->type == 'input'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<input type="text" class="form-control" name="<?php echo url_title($gf->name)?>" value="" />
			</div>
			<?php elseif($gf->type == 'select'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<option value="Yes"><?php echo $this->lang->line('label_yes');?></option>
				<option value="No"><?php echo $this->lang->line('label_no');?></option>
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
				<textarea class="form-control" name="<?php echo url_title($gf->name)?>" rows="15" cols="70"></textarea>
			</div>
			
			<?php elseif($gf->type == 'radio'):?>
			<?php elseif($gf->type == 'array'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
					<?php if($gf->array_name == 'states'):?>
					<?php echo states_dropdown($gf->name, 'form-control');?>
					<?php elseif($gf->array_name == 'country'):?>
					<?php echo country_dropdown($gf->name, 'form-control');?>
					<?php endif;?>
				</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			</div>
			
			<div class="col-md-12" style="padding:0px;">
			<?php if($this->config->item('security_image') == '1'):?>
			<?php if($this->config->item('security_register') == 'I'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_security_code');?></span>
			<script type="text/javascript">
			  var RecaptchaOptions = { 
				theme: "<?php echo $this->config->item('re_theme', 'recaptcha');?>",
				lang: "en"
			  };
			</script>
					<script type="text/javascript" src="<?php echo $server?>/challenge?k=<?php echo $key.$errorpart?>"></script>
			<noscript>
					<iframe src="<?php echo $server?>/noscript?lang=<?php echo $lang?>&k=<?php echo $key.$errorpart?>" height="300" width="500" frameborder="0"></iframe>
					<textarea name="recaptcha_challenge_field" rows="3" cols="40" class="form-control"></textarea>
					<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
			</noscript>
			</div>
			<?php endif;?>
			<?php if($this->config->item('security_register') == 'M'):?>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $mq;?></span>
			<?php echo form_input($math_captcha);?>
			</div>
			<?php endif;?>
			
			<?php endif;?>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
			
	</fieldset>
<?php echo form_close();?>
</div>