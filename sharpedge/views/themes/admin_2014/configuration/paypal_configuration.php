<?php $stats = $this->config->load('paypal_ipn');?>
<?php $paypal_ipn_use_live_settings = $stats . $this->config->item('paypal_ipn_use_live_settings');?>
<?php $live_email = $stats . $this->config->item('email', 'paypal_ipn_live_settings');?>
<?php $live_url = $stats . $this->config->item('url', 'paypal_ipn_live_settings');?>
<?php $live_debug = $stats . $this->config->item('debug', 'paypal_ipn_live_settings');?>
<?php $test_email = $stats . $this->config->item('email', 'paypal_ipn_sandbox_settings');?>
<?php $test_url = $stats . $this->config->item('url', 'paypal_ipn_sandbox_settings');?>
<?php $test_debug = $stats . $this->config->item('debug', 'paypal_ipn_sandbox_settings');?>
<div class="form-horizontal">
<?php echo form_open('configuration/paypal_config/');?>
		<fieldset>
			<legend><?php echo $this->lang->line('paypal_config');?></legend>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_live_settings');?></span>
				<select name="paypal_ipn_use_live_settings" class="form-control">
				<option value="true"<?php if($paypal_ipn_use_live_settings == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($paypal_ipn_use_live_settings== 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_live_email');?></span>
				<input type="text" class="form-control" name="live_email" value="<?php echo $live_email;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_live_url');?></span>
				<input type="text" class="form-control" name="live_url" value="<?php echo $live_url;?>" />
			</div>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_live_debug');?></span>
				<select name="live_debug" class="form-control">
				<option value="true"<?php if($live_debug == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($live_debug == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_test_email');?></span>
				<input type="text" class="form-control" name="test_email" value="<?php echo $test_email;?>" />
			</div>
			
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_test_url');?></span>
				<input type="text" class="form-control" name="test_url" value="<?php echo $test_url;?>" />
			</div>
            
			<div class="input-group">
				<span class="input-group-addon"><?php echo $this->lang->line('paypal_test_debug');?></span>
				<select name="test_debug" class="form-control">
				<option value="true"<?php if($test_debug == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($test_debug == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
			</div>		

			<input class="btn btn-primary" type="submit" value="Submit" />

</fieldset>
<?php echo form_close();?>
</div>