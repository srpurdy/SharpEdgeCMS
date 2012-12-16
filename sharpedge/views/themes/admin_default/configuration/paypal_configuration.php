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
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_live_settings');?></label>
				<div class="controls">
				<select name="paypal_ipn_use_live_settings">
				<option value="true"<?php if($paypal_ipn_use_live_settings == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($paypal_ipn_use_live_settings== 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_live_email');?></label>
				<div class="controls">
				<input type="text" class="span7" name="live_email" value="<?php echo $live_email;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_live_url');?></label>
				<div class="controls">
				<input type="text" class="span7" name="live_url" value="<?php echo $live_url;?>" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_live_debug');?></label>
				<div class="controls">
				<select name="live_debug">
				<option value="true"<?php if($live_debug == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($live_debug == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_test_email');?></label>
				<div class="controls">
				<input type="text" class="span7" name="test_email" value="<?php echo $test_email;?>" />
				</div>
			</div>
			
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_test_url');?></label>
				<div class="controls">
				<input type="text" class="span7" name="test_url" value="<?php echo $test_url;?>" />
				</div>
			</div>
            
			<div class="control-group">
			<label class="control-label"><?php echo $this->lang->line('paypal_test_debug');?></label>
				<div class="controls">
				<select name="test_debug">
				<option value="true"<?php if($test_debug == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
				<option value="false"<?php if($test_debug == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
				</select>
				</div>
			</div>
			
			<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="Submit" />
			</div>
</fieldset>
<?php echo form_close();?>
</div>