<?php if($this->config->item('allow_register') == '0'):?>
<p><?php echo $this->lang->line('label_reg_closed');?></p>
<?php else:?>
<?php
$first_name = array('name' => 'first_name',
	'id' => 'first_name',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('first_name'),
);
$last_name = array('name' => 'last_name',
	'id' => 'last_name',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('last_name'),
);
$email = array('name' => 'email',
	'id' => 'email',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('email'),
);
$company = array('name' => 'company',
	'id' => 'company',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('company'),
);
$phone1 = array('name' => 'phone1',
	'id' => 'phone1',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('phone1'),
);
$phone2 = array('name' => 'phone2',
	'id' => 'phone2',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('phone2'),
);
$phone3 = array('name' => 'phone3',
	'id' => 'phone3',
	'type' => 'text',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('phone3'),
);
$password = array('name' => 'password',
	'id' => 'password',
	'type' => 'password',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('password'),
);
$password_confirm = array('name' => 'password_confirm',
	'id' => 'password_confirm',
	'type' => 'password',
	'class' => 'form-control',
	'value' => $this->form_validation->set_value('password_confirm'),
);
$math_captcha = array('name' => 'math_captcha',
	'class' => 'form-control',
);
?>
<div class="form-horizontal">
	<div id="infoMessage"><?php echo $message;?></div>
	
    <?php echo form_open("/auth/create_user");?>
	<fieldset>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_first_name');?></span>
				<?php echo form_input($first_name);?>
			</div>

			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_last_name');?></span>
				<?php echo form_input($last_name);?>
			</div>

			<?php if($this->config->item('company_enabled') == 'Y'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_company_name');?></span>
				<?php echo form_input($company);?>
			</div>
			<?php endif;?>

			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_email_address');?></span>
				<?php echo form_input($email);?>
			</div>

			<?php if($this->config->item('phone_enabled') == 'Y'):?>			
			<div class="controls-row">
				<div class="control-group col col-lg-3" style="padding:0px;">
					<div class="input-group">
					<span class="input-group-addon"><?php echo $this->lang->line('label_phone');?></span>
					<?php echo form_input($phone1);?>
					</div>
				</div>
			</div>
			
			<div class="controls-row">
				<div class="control-group col col-lg-3">
					<div class="input-group">
					<span class="input-group-addon">-</span>
					<?php echo form_input($phone2);?>
					</div>
				</div>
			</div>
			
			<div class="controls-row">
				<div class="control-group col col-lg-3">
					<div class="input-group">
					<span class="input-group-addon">-</span>
					<?php echo form_input($phone3);?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php endif;?>

			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_password');?></span>
				<?php echo form_input($password);?>
			</div>

			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_confirm_password');?></span>
				<?php echo form_input($password_confirm);?>
			</div>
			
			<?php foreach($fields as $gf):?>	
			<?php if($gf->type == 'input'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<input type="text" class="form-control" name="<?php echo url_title($gf->name)?>" value="" />
			</div>
			
			<?php elseif($gf->type == 'select'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<option value="Y"><?php echo $this->lang->line('label_yes');?></option>
				<option value="N"><?php echo $this->lang->line('label_no');?></option>
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
			
			<?php elseif($gf->type == 'array'):?>
				<div class="input-group">
				<span class="input-group-addon"><?php echo $gf->name?> <?php if($gf->is_required == 'Y'):?><img src="<?php echo base_url();?>assets/images/system_images/tick.gif" alt="" /><?php endif;?></span>
				<?php $list_items = explode(',', $gf->list);?>
				<select name="<?php echo url_title($gf->name)?>" class="form-control">
				<?php for($i = 0; $i < count($list_items); $i++):?>
				<option value="<?php echo url_title($list_items[$i]);?>"><?php echo url_title($list_items[$i]);?></option>
				<?php endfor;?>
				</select>
				</div>
			<?php endif;?>
		<?php endforeach;?>
			
			<?php if($this->config->item('security_register') == 'I'):?>
			<div class="input-group">
			<span class="input-group-addon"><?php echo $this->lang->line('label_security_code');?></span>
			<script type="text/javascript">
			  var RecaptchaOptions = { 
				theme: "white",
				lang: "en"
			  };
			</script>
				<script type="text/javascript" src="<?php echo $server?>/challenge?k=<?php echo $key.$errorpart?>"></script>
				<noscript>
				<iframe src="<?php echo $server?>/noscript?lang=<?php echo $lang?>&k=<?php echo $key.$errorpart?>" height="300" width="500" frameborder="0"></iframe><br/>
				<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
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
			
			<br />

			<div class="form-actions">
			<?php echo form_submit(array('name'=>'submit',
					 'class' => 'btn btn-primary',  
					 'id'=>'submit', 
					 'value'=> 'Create User'))?>
			</div>

    </fieldset>
    <?php echo form_close();?>

</div>
<?php endif;?>