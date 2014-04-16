<script type="text/javascript">
$(document).on('click', '#tab2', function()
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

$(document).on('click', '#tab3', function()
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

$(document).on('click', '#tab4', function()
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

$(document).on('click', '#tab5', function()
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

$(document).on('click', '#tab6', function()
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

$(document).on('click', '#tab7', function()
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

$(document).on('click', '#tab8', function()
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

$(document).on('click', '#tab9', function()
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

$(document).on('click', '#tab10', function()
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

$(document).on('click', '#tab11', function()
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
<div class="col-md-2">
	<ul class="nav nav-pills nav-stacked remove_underline" id="tabs">
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
</div>
<div class="col-md-10">	
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
		<?php $googleplus = $stats . $this->config->item('googleplus');?>
		<?php $pinterest = $stats . $this->config->item('pinterest');?>
		<?php $twitter_url = $stats . $this->config->item('twitter_url');?>
		<?php $facebook_url = $stats . $this->config->item('facebook_url');?>
		<?php $linkedin_url = $stats . $this->config->item('linkedin_url');?>
		<?php $googleplus_url = $stats . $this->config->item('googleplus_url');?>
		<?php $pinterest_url = $stats . $this->config->item('pinterest_url');?>
		<?php $contruction = $stats . $this->config->item('construction');?>
		<?php $allow_register = $stats . $this->config->item('allow_register');?>
		<?php $security_register = $stats . $this->config->item('security_register');?>
		<?php $phone_enabled = $stats . $this->config->item('phone_enabled');?>
		<?php $company_enabled = $stats . $this->config->item('company_enabled');?>
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
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_site_name');?></span>
							<input type="text" class="form-control" name="sitename" value="<?php echo htmlentities($sitename);?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_site_slogan');?></span>
							<input type="text" class="form-control" name="site_slogan" value="<?php echo htmlentities($site_slogan);?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_contact_email');?></span>
							<input type="text" class="form-control" name="contact_email" value="<?php echo $contact_email;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_home_page');?></span>
							<input type="text" class="form-control" name="homepage_string" value="<?php echo $homepage_string;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_short_url');?></span>
							<select name="short_url" class="form-control">
							<option value="true"<?php if($short_url == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($short_url == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_stats_code');?></span>
							<select name="google_stats" class="form-control">
							<option value="true"<?php if($google_stats == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($google_stats == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_stats_id');?></span>
							<input type="text" class="form-control" name="google_id" value="<?php echo $google_id;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_twitter');?></span>
							<select name="twitter" class="form-control">
							<option value="true"<?php if($twitter == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($twitter == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_facebook');?></span>
							<select name="facebook" class="form-control">
							<option value="true"<?php if($facebook == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($facebook == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_linkedin');?></span>
							<select name="linkedin" class="form-control">
							<option value="true"<?php if($linkedin == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($linkedin == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_googleplus');?></span>
							<select name="googleplus" class="form-control">
							<option value="true"<?php if($googleplus == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($googleplus == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_pinterest');?></span>
							<select name="pinterest" class="form-control">
							<option value="true"<?php if($pinterest == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($pinterest == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_twitter_url');?></span>
							<input type="text" class="form-control" name="twitter_url" value="<?php echo $twitter_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_facebook_url');?></span>
							<input type="text" class="form-control" name="facebook_url" value="<?php echo $facebook_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_linkedin_url');?></span>
							<input type="text" class="form-control" name="linkedin_url" value="<?php echo $linkedin_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_googleplus_url');?></span>
							<input type="text" class="form-control" name="googleplus_url" value="<?php echo $googleplus_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_pinterest_url');?></span>
							<input type="text" class="form-control" name="pinterest_url" value="<?php echo $pinterest_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_construction');?></span>
							<select name="construction" class="form-control">
							<option value="true"<?php if($contruction == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($contruction == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_allow_reg');?></span>
							<select name="allow_register" class="form-control">
							<option value="true"<?php if($allow_register == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($allow_register == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_security_image');?></span>
							<select name="security_register" class="form-control">
							<option value="I"<?php if($security_register == 'I'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_image');?></option>
							<option value="M"<?php if($security_register == 'M'):?>selected="selected"<?php endif;?>>Math</option>
							<option value="N"<?php if($security_register == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_none');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_phone_enabled');?></span>
							<select name="phone_enabled" class="form-control">
							<option value="Y"<?php if($phone_enabled == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
							<option value="N"<?php if($phone_enabled == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_company_enabled');?></span>
							<select name="company_enabled" class="form-control">
							<option value="Y"<?php if($company_enabled == 'Y'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_yes');?></option>
							<option value="N"<?php if($company_enabled == 'N'):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_no');?></option>
							</select>
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_robots');?></span>
							<input type="text" class="form-control" name="robots" value="<?php echo $robots;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_site_desc');?></span>
							<input type="text" class="form-control" name="description" value="<?php echo $description;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_site_keywords');?></span>
							<input type="text" class="form-control" name="keywords" value="<?php echo $keywords;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_site_logo');?></span>
							<input type="text" class="form-control" name="image_src" value="<?php echo $image_src;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_benchmark');?></span>
							<select name="benchmark" class="form-control">
							<option value="true"<?php if($benchmark == 1):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_true');?></option>
							<option value="false"<?php if($benchmark == 0):?>selected="selected"<?php endif;?>><?php echo $this->lang->line('label_false');?></option>
							</select>
						</div>
					
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_themes_url');?></span>
							<input type="text" class="form-control" name="themes_url" value="<?php echo $themes_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_assets_url');?></span>
							<input type="text" class="form-control" name="assets_url" value="<?php echo $assets_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_gallery_url');?></span>
							<input type="text" class="form-control" name="gallery_url" value="<?php echo $gallery_url;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_upload_limit');?></span>
							<input type="text" class="form-control" name="global_upload_limit" value="<?php echo $upload_limit;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_upload_maxwidth');?></span>
							<input type="text" class="form-control" name="global_upload_maxwidth" value="<?php echo $upload_maxwidth;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_upload_maxheight');?></span>
							<input type="text" class="form-control" name="global_upload_maxheight" value="<?php echo $upload_maxheight;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_upload_filetypes');?></span>
							<input type="text" class="form-control" name="global_filetypes" value="<?php echo $upload_filetypes;?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_copyright');?></span>
							<input type="text" class="form-control" name="copyright" value="<?php echo htmlentities($copyright);?>" />
						</div>
						
						<div class="input-group">
							<span class="input-group-addon"><?php echo $this->lang->line('label_generator');?></span>
							<input type="text" class="form-control" name="generator" value="<?php echo htmlentities($generator);?>" />
						</div>
						
						<input class="btn btn-primary" type="submit" value="Submit" />

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