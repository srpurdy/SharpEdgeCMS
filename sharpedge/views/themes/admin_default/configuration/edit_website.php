<script type="text/javascript">
$('#tab2').live('click', function()
{
	$('#tabs-2').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/webstat_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-2').html(msg);
		}
	})
});

$('#tab3').live('click', function()
{
	$('#tabs-3').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/contact_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-3').html(msg);
		}
	})
});

$('#tab4').live('click', function()
{
	$('#tabs-4').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/blog_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-4').html(msg);
		}
	})
});

$('#tab5').live('click', function()
{
	$('#tabs-5').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/gallery_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-5').html(msg);
		}
	})
});

$('#tab6').live('click', function()
{
	$('#tabs-6').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/paypal_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-6').html(msg);
		}
	})
});

$('#tab7').live('click', function()
{
	$('#tabs-7').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/recaptcha_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-7').html(msg);
		}
	})
});

$('#tab8').live('click', function()
{
	$('#tabs-8').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/product_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-8').html(msg);
		}
	})
});

$('#tab9').live('click', function()
{
	$('#tabs-9').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/template_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-9').html(msg);
		}
	})
});

$('#tab10').live('click', function()
{
	$('#tabs-10').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/video_config",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-10').html(msg);
		}
	})
});

$('#tab11').live('click', function()
{
	$('#tabs-11').html('<div class="admin_ajax"><img src="/assets/images/system_images/loading/loaderB64.gif" alt="" /><br />Loading...</div>');
	$.ajax(
	{
		url: "<?php echo site_url();?>/configuration/google_fonts",
		type: "GET",
		success: function(msg)
		{
			$('#tabs-11').html(msg);
		}
	})
});
</script>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
<div class="tabbable tabs-left">
	<ul class="nav nav-tabs remove_underline" id="tabs">
		<li class="active"><a href="#tabs-1" data-toggle="tab"><?php echo $this->lang->line('web_config');?></a></li>
		<li><a id="tab2" href="#tabs-2" data-toggle="tab"><?php echo $this->lang->line('stat_config');?></a></li>
		<li><a id="tab3" href="#tabs-3" data-toggle="tab"><?php echo $this->lang->line('contact_config');?></a></li>
		<li><a id="tab4" href="#tabs-4" data-toggle="tab"><?php echo $this->lang->line('news_config');?></a></li>
		<li><a id="tab5" href="#tabs-5" data-toggle="tab"><?php echo $this->lang->line('gallery_config');?></a></li>
		<li><a id="tab6" href="#tabs-6" data-toggle="tab"><?php echo $this->lang->line('paypal_config');?></a></li>
		<li><a id="tab7" href="#tabs-7" data-toggle="tab"><?php echo $this->lang->line('recaptcha_config');?></a></li>
		<li><a id="tab8" href="#tabs-8" data-toggle="tab"><?php echo $this->lang->line('product_config');?></a></li>
		<li><a id="tab9" href="#tabs-9" data-toggle="tab"><?php echo $this->lang->line('template_config');?></a></li>
		<li><a id="tab10" href="#tabs-10" data-toggle="tab"><?php echo $this->lang->line('video_config');?></a></li>
		<li><a id="tab11" href="#tabs-11" data-toggle="tab"><?php echo $this->lang->line('fonts_config');?></a></li>
	</ul>
	
	<div class="tab-content">		
		<div class="tab-pane active" id="tabs-1">
		<?php $stats = $this->config->load('website_config');?>
		<?php $sitename = $stats . $this->config->item('sitename');?>
		<?php $site_slogan = $stats . $this->config->item('site_slogan');?>
		<?php $contact_email = $stats . $this->config->item('contact_email');?>
		<?php $homepage_string = $stats . $this->config->item('homepage_string');?>
		<?php $short_url = $stats . $this->config->item('short_url');?>
		<?php $google_stats = $stats . $this->config->item('google_stats');?>
		<?php $google_id = $stats . $this->config->item('google_id');?>
		<?php $twitter = $stats . $this->config->item('twitter');?>
		<?php $facebook = $stats . $this->config->item('facebook');?>
		<?php $linkedin = $stats . $this->config->item('linkedin');?>
		<?php $twitter_url = $stats . $this->config->item('twitter_url');?>
		<?php $facebook_url = $stats . $this->config->item('facebook_url');?>
		<?php $linkedin_url = $stats . $this->config->item('linkedin_url');?>
		<?php $contruction = $stats . $this->config->item('construction');?>
		<?php $allow_register = $stats . $this->config->item('allow_register');?>
		<?php $security_register = $stats . $this->config->item('security_register');?>
		<?php $robots = $stats . $this->config->item('robots');?>
		<?php $description = $stats . $this->config->item('description');?>
		<?php $keywords = $stats . $this->config->item('keywords');?>
		<?php $image_src = $stats . $this->config->item('image_src');?>
		<?php $benchmark = $stats . $this->config->item('benchmark');?>
		<?php $themes_url = $stats . $this->config->item('themes_url');?>
		<?php $assets_url = $stats . $this->config->item('assets_url');?>
		<?php $gallery_url = $stats . $this->config->item('gallery_url');?>
		<?php $upload_limit = $stats . $this->config->item('global_upload_limit');?>
		<?php $upload_maxwidth = $stats . $this->config->item('global_upload_maxwidth');?>
		<?php $upload_maxheight = $stats . $this->config->item('global_upload_maxheight');?>
		<?php $upload_filetypes = $stats . $this->config->item('global_filetypes');?>
		<?php $copyright = $stats . $this->config->item('copyright');?>
		<?php $generator = $stats . $this->config->item('generator');?>
			<div class="form-horizontal">
			<?php echo form_open('configuration/website_config/');?>
					<fieldset>
						<legend><?php echo $this->lang->line('web_config');?></legend>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_site_name');?></label>
							<div class="controls">
							<input type="text" class="field" name="sitename" value="<?php echo htmlentities($sitename);?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_site_slogan');?></label>
							<div class="controls">
							<input type="text" class="field" name="site_slogan" value="<?php echo htmlentities($site_slogan);?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_contact_email');?></label>
							<div class="controls">
							<input type="text" class="field" name="contact_email" value="<?php echo $contact_email;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_home_page');?></label>
							<div class="controls">
							<input type="text" class="field" name="homepage_string" value="<?php echo $homepage_string;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_short_url');?></label>
							<div class="controls">
							<select name="short_url">
							<option value="true"<?php if($short_url == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($short_url == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_stats_code');?></label>
							<div class="controls">
							<select name="google_stats">
							<option value="true"<?php if($google_stats == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($google_stats == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_stats_id');?></label>
							<div class="controls">
							<input type="text" class="field" name="google_id" value="<?php echo $google_id;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_twitter');?></label>
							<div class="controls">
							<select name="twitter">
							<option value="true"<?php if($twitter == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($twitter == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_facebook');?></label>
							<div class="controls">
							<select name="facebook">
							<option value="true"<?php if($facebook == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($facebook == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_linkedin');?></label>
							<div class="controls">
							<select name="linkedin">
							<option value="true"<?php if($linkedin == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($linkedin == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_twitter_url');?></label>
							<div class="controls">
							<input type="text" class="span5" name="twitter_url" value="<?php echo $twitter_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_facebook_url');?></label>
							<div class="controls">
							<input type="text" class="span5" name="facebook_url" value="<?php echo $facebook_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_linkedin_url');?></label>
							<div class="controls">
							<input type="text" class="span5" name="linkedin_url" value="<?php echo $linkedin_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_construction');?></label>
							<div class="controls">
							<select name="construction">
							<option value="true"<?php if($contruction == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($contruction == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_allow_reg');?></label>
							<div class="controls">
							<select name="allow_register">
							<option value="true"<?php if($allow_register == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($allow_register == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_security_image');?></label>
							<div class="controls">
							<select name="security_register">
							<option value="I"<?php if($security_register == 'I'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_image');?></option>
							<option value="M"<?php if($security_register == 'M'):?>selected="selected"<?php endif;?>>Math</option>
							<option value="N"<?php if($security_register == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_none');?></option>
							</select>
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_robots');?></label>
							<div class="controls">
							<input type="text" class="field" name="robots" value="<?php echo $robots;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_site_desc');?></label>
							<div class="controls">
							<input type="text" class="span6" name="description" value="<?php echo $description;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_site_keywords');?></label>
							<div class="controls">
							<input type="text" class="span6" name="keywords" value="<?php echo $keywords;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_site_logo');?></label>
							<div class="controls">
							<input type="text" class="field" name="image_src" value="<?php echo $image_src;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_benchmark');?></label>
							<div class="controls">
							<select name="benchmark">
							<option value="true"<?php if($benchmark == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($benchmark == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
							</div>
						</div>
					
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_themes_url');?></label>
							<div class="controls">
							<input type="text" class="span4" name="themes_url" value="<?php echo $themes_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_assets_url');?></label>
							<div class="controls">
							<input type="text" class="span4" name="assets_url" value="<?php echo $assets_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_gallery_url');?></label>
							<div class="controls">
							<input type="text" class="span4" name="gallery_url" value="<?php echo $gallery_url;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_upload_limit');?></label>
							<div class="controls">
							<input type="text" class="span4" name="global_upload_limit" value="<?php echo $upload_limit;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_upload_maxwidth');?></label>
							<div class="controls">
							<input type="text" class="span4" name="global_upload_maxwidth" value="<?php echo $upload_maxwidth;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_upload_maxheight');?></label>
							<div class="controls">
							<input type="text" class="span4" name="global_upload_maxheight" value="<?php echo $upload_maxheight;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_upload_filetypes');?></label>
							<div class="controls">
							<input type="text" class="span4" name="global_filetypes" value="<?php echo $upload_filetypes;?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_copyright');?></label>
							<div class="controls">
							<input type="text" class="span6" name="copyright" value="<?php echo htmlentities($copyright);?>" />
							</div>
						</div>
						
						<div class="control-group">
						<label class="control-label"><?php echo $this->lang->line('label_generator');?></label>
							<div class="controls">
							<input type="text" class="span6" name="generator" value="<?php echo htmlentities($generator);?>" />
							</div>
						</div>
						
						<div class="form-actions">
						<input class="btn btn-primary" type="submit" value="Submit" />
						</div>
			</fieldset>
			<?php echo form_close();?>
			</div>
		</div>
		
		<div class="tab-pane" id="tabs-2">
		</div>
		
		<div class="tab-pane" id="tabs-3">
		</div>
		
		<div class="tab-pane" id="tabs-4">
		</div>
		
		<div class="tab-pane" id="tabs-5">
		</div>
		
		<div class="tab-pane" id="tabs-6">
		</div>
		
		<div class="tab-pane" id="tabs-7">
		</div>
		
		<div class="tab-pane" id="tabs-8">
		</div>
		
		<div class="tab-pane" id="tabs-9">
		</div>
		
		<div class="tab-pane" id="tabs-10">
		</div>
		
		<div class="tab-pane" id="tabs-11">
		</div>
	</div>
</div>