<?php
###################################################################
##
##	Configuration Module
##	Version: 1.28
##
##	Last Edit:
##	July 28 2015
##
##	Description:
##	SharpEdge Configuration Options
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Configuration extends ADMIN_Controller {

	function Configuration()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->helper('directory');
		
		#Models
		$this->load->model('config_model');
		
		#Libraries
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		
		#Load Module User Protection
		$check_perm = $this->backend_model->protect_module();
		$this->data['module_read'] = 'N';
		$this->data['module_write'] = 'N';
		$this->data['module_delete'] = 'N';
		$check_perm = $this->backend_model->get_module_permissions();
		if($check_perm->result())
			{
			foreach($check_perm->result() as $pm)
				{
				$this->data['module_read'] = $pm->read;
				$this->data['module_write'] = $pm->write;
				$this->data['module_delete'] = $pm->delete;
				}
			}
		else
			{
			$this->data['module_read'] = 'N';
			$this->data['module_write'] = 'N';
			$this->data['module_delete'] = 'N';
			}
		}

	function index()
		{
		redirect('configuration/website_config');
		}

	function website_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('sitename', 'sitename', 'required|xss_clean');
			$this->form_validation->set_rules('site_slogan', 'site_slogan', 'required|xss_clean');
			$this->form_validation->set_rules('contact_email', 'contact_email', 'required|xss_clean');
			$this->form_validation->set_rules('robots', 'robots', 'required|xss_clean');
			$this->form_validation->set_rules('description', 'description', 'required|xss_clean');
			$this->form_validation->set_rules('keywords', 'keywords', 'required|xss_clean');
			$this->form_validation->set_rules('image_src', 'image_src', 'required|xss_clean');
			$this->form_validation->set_rules('copyright', 'copyright', 'required|xss_clean');
			$this->form_validation->set_rules('generator', 'generator', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('web_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/configuration/edit_website';
				$data['get_langs'] = $this->config_model->get_langs();
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
				else
				{
				$this->config->load('website_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["sitename"] = ' . var_export($this->input->post('sitename'), true) . ";\n" 
				. '$config["site_slogan"] = ' . var_export($this->input->post('site_slogan'), true) . ";\n"
				. '$config["contact_email"] = ' . var_export($this->input->post('contact_email'), true) . ";\n" 
				. '$config["homepage_string"] = ' . var_export($this->input->post('homepage_string'), true) . ";\n" 
				. '$config["short_url"] = ' . $this->input->post('short_url') . ";\n" 
				. '$config["google_stats"] = ' . $this->input->post('google_stats') . ";\n" 
				. '$config["google_id"] = ' . var_export($this->input->post('google_id'), true) . ";\n" 
				. '$config["twitter"] = ' . $this->input->post('twitter') . ";\n" 
				. '$config["facebook"] = ' . $this->input->post('facebook') . ";\n" 
				. '$config["linkedin"] = ' . $this->input->post('linkedin') . ";\n"
				. '$config["googleplus"] = ' . $this->input->post('googleplus') . ";\n"
				. '$config["pinterest"] = ' . $this->input->post('pinterest') . ";\n"
				. '$config["twitter_url"] = ' . var_export($this->input->post('twitter_url'), true) . ";\n"
				. '$config["facebook_url"] = ' . var_export($this->input->post('facebook_url'), true) . ";\n"
				. '$config["linkedin_url"] = ' . var_export($this->input->post('linkedin_url'), true) . ";\n"
				. '$config["googleplus_url"] = ' . var_export($this->input->post('googleplus_url'), true) . ";\n"
				. '$config["pinterest_url"] = ' . var_export($this->input->post('pinterest_url'), true) . ";\n"
				. '$config["construction"] = ' . $this->input->post('construction') . ";\n" 
				. '$config["allow_register"] = ' . $this->input->post('allow_register') . ";\n"
				. '$config["security_register"] = ' . var_export($this->input->post('security_register'), true) . ";\n"
				. '$config["phone_enabled"] = ' . var_export($this->input->post('phone_enabled'), true) . ";\n"
				. '$config["company_enabled"] = ' . var_export($this->input->post('company_enabled'), true) . ";\n"
				. '$config["robots"] = ' . var_export($this->input->post('robots'), true) . ";\n"
				. '$config["description"] = ' . var_export($this->input->post('description'), true) . ";\n"
				. '$config["keywords"] = ' . var_export($this->input->post('keywords'), true) . ";\n"
				. '$config["image_src"] = ' . var_export($this->input->post('image_src'), true) . ";\n"
				. '$config["benchmark"] = ' . $this->input->post('benchmark') . ";\n"
				. '$config["themes_url"] = ' . var_export($this->input->post('themes_url'), true) . ";\n"
				. '$config["assets_url"] = ' . var_export($this->input->post('assets_url'), true) . ";\n"
				. '$config["gallery_url"] = ' . var_export($this->input->post('gallery_url'), true) . ";\n"
				. '$config["global_upload_limit"] = ' . var_export($this->input->post('global_upload_limit'), true) . ";\n"
				. '$config["global_upload_maxwidth"] = ' . var_export($this->input->post('global_upload_maxwidth'), true) . ";\n"
				. '$config["global_upload_maxheight"] = ' . var_export($this->input->post('global_upload_maxheight'), true) . ";\n"
				. '$config["global_filetypes"] = ' . var_export($this->input->post('global_filetypes'), true) . ";\n"
				. '$config["copyright"] = ' . var_export($this->input->post('copyright'), true) . ";\n"
				. '$config["generator"] = ' . var_export($this->input->post('generator'), true) . ";\n" . '?>';	
				write_file(APPPATH . 'config/website_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function webstat_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('username', 'username', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('stat_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/configuration/edit_stat';
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/edit_stat', $data);
				}
			else
				{
				$this->config->load('analytics', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n" 
				. '$config["username"] = ' . var_export($this->input->post('username'), true) . ";\n" 
				. '$config["password"] = ' . var_export($this->input->post('password'), true) . ";\n"
				. '$config["profile_id"] = ' . var_export($this->input->post('profile_id'), true) . ";\n"
				. '$config["start_date"] = ' . var_export($this->input->post('start_date'), true) . ";\n" . '?>';
				write_file(APPPATH . 'config/analytics.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-2');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function user_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('groups', 'groups', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('user_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/configuration/edit_user';
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view('edit_user', $data);
				}
			else
				{
				$this->config->load('ion_auth', true);
				$columns = array($this->input->post('first_name'),$this->input->post('last_name'),$this->input->post('company'),$this->input->post('phone'));
				$data = 
				'<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["tables"]["groups"] = ' . var_export($this->input->post('groups'), true) . ";\n"
				. '$config["tables"]["users"] = ' . var_export($this->input->post('users'), true) . ";\n"
				. '$config["tables"]["meta"] = ' . var_export($this->input->post('meta'), true) . ";\n"
				. '$config["site_title"] = ' . var_export($this->input->post('site_title'), true) . ";\n"
				. '$config["admin_email"] = ' . var_export($this->input->post('admin_email'), true) . ";\n"
				. '$config["default_group"] = ' . var_export($this->input->post('default_group'), true) . ";\n"
				. '$config["admin_group"] = ' . var_export($this->input->post('admin_group'), true) . ";\n"
				. '$config["join"] = ' . var_export($this->input->post('join'), true) . ";\n"
				. '$config["columns"] = array("' . $this->input->post('first_name') . '", "' . $this->input->post('last_name') . '", "' . $this->input->post('company') . '", "' . $this->input->post('phone').'")' . ";\n"
				. '$config["identity"] = ' . var_export($this->input->post('identity'), true) . ";\n"
				. '$config["min_password_length"] = ' . $this->input->post('min_password_length') . ";\n"
				. '$config["max_password_length"] = ' . $this->input->post('max_password_length') . ";\n"
				. '$config["email_activation"] = ' . $this->input->post('email_activation') . ";\n"
				. '$config["remember_users"] = ' . $this->input->post('remember_users') . ";\n"
				. '$config["user_expire"] = ' . $this->input->post('user_expire') . ";\n"
				. '$config["user_extend_on_login"] = ' . $this->input->post('user_extend_on_login') . ";\n"
				. '$config["email_templates"] = ' . var_export($this->input->post('email_templates'), true) . ";\n"
				. '$config["email_activate"] = ' . var_export($this->input->post('email_activate'), true) . ";\n"
				. '$config["email_forgot_password"] = ' . var_export($this->input->post('email_forgot_password'), true) . ";\n"
				. '$config["email_forgot_password_complete"] = ' . var_export($this->input->post('email_forgot_password_complete'), true) . ";\n"
				. '$config["salt_length"] = ' . $this->input->post('salt_length'). ";\n"
				. '$config["store_salt"] = ' . $this->input->post('store_salt') . ";\n"
				. '$config["message_start_delimiter"] = ' . var_export($this->input->post('message_start_delimiter'), true) . ";\n"
				. '$config["message_end_delimiter"] = ' . var_export($this->input->post('message_end_delimiter'), true) . ";\n"
				. '$config["error_start_delimiter"] = ' . var_export($this->input->post('error_start_delimiter'), true) . ";\n"
				. '$config["error_end_delimiter"] = ' . var_export($this->input->post('error_end_delimiter'), true) . ";\n" . '?>';
				write_file(APPPATH . 'config/ion_auth.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function blog_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('blog_per_page', 'blog_per_page', 'required|xss_clean');
			$this->form_validation->set_rules('blog_short_char_limit', 'blog_short_char_limit', 'required|xss_clean');
			$this->form_validation->set_rules('blog_normal_maxwidth', 'blog_normal_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('blog_normal_maxheight', 'blog_normal_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('blog_normal_quality', 'blog_normal_quality', 'required|xss_clean');
			$this->form_validation->set_rules('blog_small_maxwidth', 'blog_small_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('blog_small_maxheight', 'blog_small_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('blog_small_quality', 'blog_small_quality', 'required|xss_clean');
			$this->form_validation->set_rules('blog_medium_maxwidth', 'blog_medium_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('blog_medium_maxheight', 'blog_medium_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('blog_medium_quality', 'blog_medium_quality', 'required|xss_clean');
			$this->form_validation->set_rules('blog_thumbnail_maxwidth', 'blog_thumbnail_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('blog_thumbnail_maxheight', 'blog_thumbnail_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('blog_thumbnail_quality', 'blog_thumbnail_quality', 'required|xss_clean');
			$this->form_validation->set_rules('disqus_comments', 'disqus_comments', 'required|xss_clean');
			$this->form_validation->set_rules('disqus_shortname', 'disqus_shortname', 'xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('blog_configuration');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = 'blog_configuration';
				$this->load->view($data['template_path'] . '/configuration/blog_configuration', $data);
				}
			else
				{
				$this->config->load('blog_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["blog_per_page"] = ' . var_export($this->input->post('blog_per_page'), true) . ";\n" 
				. '$config["blog_short_char_limit"] = ' . var_export($this->input->post('blog_short_char_limit'), true) . ";\n"
				. '$config["allow_comments"] = ' . $this->input->post('allow_comments') . ";\n" 
				. '$config["image_security"] = ' . $this->input->post('image_security') . ";\n"
				. '$config["blog_normal_maxwidth"] = ' . var_export($this->input->post('blog_normal_maxwidth'), true) . ";\n"
				. '$config["blog_normal_maxheight"] = ' . var_export($this->input->post('blog_normal_maxheight'), true) . ";\n"
				. '$config["blog_normal_quality"] = ' . var_export($this->input->post('blog_normal_quality'), true) . ";\n"
				. '$config["blog_small_maxwidth"] = ' . var_export($this->input->post('blog_small_maxwidth'), true) . ";\n"
				. '$config["blog_small_maxheight"] = ' . var_export($this->input->post('blog_small_maxheight'), true) . ";\n"
				. '$config["blog_small_quality"] = ' . var_export($this->input->post('blog_small_quality'), true) . ";\n"
				. '$config["blog_medium_maxwidth"] = ' . var_export($this->input->post('blog_medium_maxwidth'), true) . ";\n"
				. '$config["blog_medium_maxheight"] = ' . var_export($this->input->post('blog_medium_maxheight'), true) . ";\n"
				. '$config["blog_medium_quality"] = ' . var_export($this->input->post('blog_medium_quality'), true) . ";\n"
				. '$config["blog_thumbnail_maxwidth"] = ' . var_export($this->input->post('blog_thumbnail_maxwidth'), true) . ";\n"
				. '$config["blog_thumbnail_maxheight"] = ' . var_export($this->input->post('blog_thumbnail_maxheight'), true) . ";\n"
				. '$config["blog_thumbnail_quality"] = ' . var_export($this->input->post('blog_thumbnail_quality'), true) . ";\n"
				. '$config["disqus_comments"] = ' . $this->input->post('disqus_comments') . ";\n"
				. '$config["disqus_shortname"] = ' . var_export($this->input->post('disqus_shortname'), true) . ";\n"
				. '?>';
				write_file(APPPATH . 'config/blog_config.php', $data);
				redirect('configuration/website_config/#tabs-4');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function contact_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('contact_subject', 'contact_subject', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('contact_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = 'contact_configuration';
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/contact_configuration', $data);
				}
			else
				{
				$this->config->load('contact_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["contact_subject"] = ' . var_export($this->input->post('contact_subject'), true) . ";\n" 
				. '$config["multi_contact"] = ' . $this->input->post('multi_contact') . ";\n" 
				. '$config["security_image"] = ' . $this->input->post('security_image') . ";\n" . '?>';
				write_file(APPPATH . 'config/contact_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function gallery_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('normal_maxwidth', 'normal_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('normal_maxheight', 'normal_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('normal_quality', 'normal_quality', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_maxwidth', 'thumbnail_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_maxheight', 'thumbnail_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_quality', 'thumbnail_quality', 'required|xss_clean');
			$this->form_validation->set_rules('slideshow_maxwidth', 'slideshow_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('slideshow_maxheight', 'slideshow_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('slideshow_quality', 'slideshow_quality', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('gallery_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/gallery_configuration', $data);
				}
			else
				{
				$this->config->load('gallery_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["normal_maxwidth"] = ' . var_export($this->input->post('normal_maxwidth'), true) . ";\n"
				. '$config["normal_maxheight"] = ' . var_export($this->input->post('normal_maxheight'), true) . ";\n"
				. '$config["normal_quality"] = ' . var_export($this->input->post('normal_quality'), true) . ";\n"
				. '$config["thumbnail_maxwidth"] = ' . var_export($this->input->post('thumbnail_maxwidth'), true) . ";\n"
				. '$config["thumbnail_maxheight"] = ' . var_export($this->input->post('thumbnail_maxheight'), true) . ";\n"
				. '$config["thumbnail_quality"] = ' . var_export($this->input->post('thumbnail_quality'), true) . ";\n"
				. '$config["slideshow_maxwidth"] = ' . var_export($this->input->post('slideshow_maxwidth'), true) . ";\n"
				. '$config["slideshow_maxheight"] = ' . var_export($this->input->post('slideshow_maxheight'), true) . ";\n"
				. '$config["slideshow_quality"] = ' . var_export($this->input->post('slideshow_quality'), true) . ";\n"
				. '?>';
				write_file(APPPATH . 'config/gallery_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-5');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function paypal_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('paypal_ipn_use_live_settings', 'paypal_ipn_use_live_settings', 'xss_clean');
			$this->form_validation->set_rules('live_email', 'live_email', 'required|xss_clean');
			$this->form_validation->set_rules('live_url', 'live_url', 'required|xss_clean');
			$this->form_validation->set_rules('live_debug', 'live_debug', 'xss_clean');
			$this->form_validation->set_rules('test_email', 'test_email', 'required|xss_clean');
			$this->form_validation->set_rules('test_url', 'test_url', 'required|xss_clean');
			$this->form_validation->set_rules('test_debug', 'test_debug', 'xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('paypal_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/paypal_configuration', $data);
				}
			else
				{
				$this->config->load('paypal_ipn', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["paypal_ipn_use_live_settings"] = ' . $this->input->post('paypal_ipn_use_live_settings') . ";\n" 
				. '$config["paypal_ipn_live_settings"] = array('
				. '\'email\' => ' . var_export($this->input->post('live_email'), true) . ",\n"
				. '\'url\' => ' . var_export($this->input->post('live_url'), true) . ",\n"
				. '\'debug\' => ' . $this->input->post('live_debug') . "\n"
				. ');'
				. '$config["paypal_ipn_sandbox_settings"] = array('
				. '\'email\' => ' . var_export($this->input->post('test_email'), true) . ",\n"
				. '\'url\' => ' . var_export($this->input->post('test_url'), true) . ",\n"
				. '\'debug\' => ' . $this->input->post('test_debug') . "\n"
				. ');'
				. '?>';
				write_file(APPPATH . 'config/paypal_ipn.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-6');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function recaptcha_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('api_server', 'api_server', 'required|xss_clean');
			$this->form_validation->set_rules('api_secure_server', 'api_secure_server', 'required|xss_clean');
			$this->form_validation->set_rules('verify_server', 'verify_server', 'required|xss_clean');
			$this->form_validation->set_rules('signup_url', 'signup_url', 'required|xss_clean');
			$this->form_validation->set_rules('recaptcha_theme', 'recaptcha_theme', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('recaptcha_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/recaptcha_configuration', $data);
				}
			else
				{
				$this->config->load('recaptcha', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["recaptcha"] = array('
				. '\'public\' => ' . var_export($this->input->post('public_key'), true) . ",\n"
				. '\'private\' => ' . var_export($this->input->post('private_key'), true) . ",\n"
				. '\'RECAPTCHA_API_SERVER\' => ' . var_export($this->input->post('api_server'), true) . ",\n"
				. '\'RECAPTCHA_API_SECURE_SERVER\' => ' . var_export($this->input->post('api_secure_server'), true) . ",\n"
				. '\'RECAPTCHA_VERIFY_SERVER\' => ' . var_export($this->input->post('verify_server'), true) . ",\n"
				. '\'RECAPTCHA_SIGNUP_URL\' => ' . var_export($this->input->post('signup_url'), true) . ",\n"
				. '\'re_theme\' => ' . var_export($this->input->post('recaptcha_theme'), true) . ",\n"
				. ');'
				. '?>';
				write_file(APPPATH . 'config/recaptcha.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-7');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function product_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('normal_maxwidth', 'normal_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('normal_maxheight', 'normal_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('normal_quality', 'normal_quality', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_maxwidth', 'thumbnail_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_maxheight', 'thumbnail_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('thumbnail_quality', 'thumbnail_quality', 'required|xss_clean');
			$this->form_validation->set_rules('category_maxwidth', 'category_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('category_maxheight', 'category_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('category_quality', 'category_quality', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('product_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/product_configuration', $data);
				}
			else
				{
				$this->config->load('product_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["product_allow_cart"] = ' . $this->input->post('allow_cart') . ";\n"
				. '$config["product_details_button"] = ' . $this->input->post('details_button') . ";\n"
				. '$config["product_require_login"] = ' . $this->input->post('product_require_login') . ";\n"
				. '$config["product_char_limit"] = ' . var_export($this->input->post('char_limit'), true) . ";\n"
				. '$config["product_normal_maxwidth"] = ' . var_export($this->input->post('normal_maxwidth'), true) . ";\n"
				. '$config["product_normal_maxheight"] = ' . var_export($this->input->post('normal_maxheight'), true) . ";\n"
				. '$config["product_normal_quality"] = ' . var_export($this->input->post('normal_quality'), true) . ";\n"
				. '$config["product_thumbnail_maxwidth"] = ' . var_export($this->input->post('thumbnail_maxwidth'), true) . ";\n"
				. '$config["product_thumbnail_maxheight"] = ' . var_export($this->input->post('thumbnail_maxheight'), true) . ";\n"
				. '$config["product_thumbnail_quality"] = ' . var_export($this->input->post('thumbnail_quality'), true) . ";\n"
				. '$config["product_category_maxwidth"] = ' . var_export($this->input->post('category_maxwidth'), true) . ";\n"
				. '$config["product_category_maxheight"] = ' . var_export($this->input->post('category_maxheight'), true) . ";\n"
				. '$config["product_category_quality"] = ' . var_export($this->input->post('category_quality'), true) . ";\n"
				. '?>';
				write_file(APPPATH . 'config/product_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-8');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function template_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('theme', 'theme', 'required|xss_clean');
			$this->form_validation->set_rules('admin_theme', 'admin_theme', 'required|xss_clean');
			$this->form_validation->set_rules('jquery_ui_theme', 'jquery_ui_theme', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('template_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/template_configuration', $data);
				}
			else
				{
				$this->config->load('template_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["theme"] = ' . var_export($this->input->post('theme'), true) . ";\n"
				. '$config["admin_theme"] = ' . var_export($this->input->post('admin_theme'), true) . ";\n"
				. '$config["j_ui_theme"] = ' . var_export($this->input->post('jquery_ui_theme'), true) . ";\n"
				. '?>';
				write_file(APPPATH . 'config/template_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-9');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function video_config()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('video_normal_maxwidth', 'video_normal_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('video_normal_maxheight', 'video_normal_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('video_normal_quality', 'video_normal_quality', 'required|xss_clean');
			$this->form_validation->set_rules('video_small_maxwidth', 'video_small_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('video_small_maxheight', 'video_small_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('video_small_quality', 'video_small_quality', 'required|xss_clean');
			$this->form_validation->set_rules('video_medium_maxwidth', 'video_medium_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('video_medium_maxheight', 'video_medium_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('video_medium_quality', 'video_medium_quality', 'required|xss_clean');
			$this->form_validation->set_rules('video_thumbnail_maxwidth', 'video_thumbnail_maxwidth', 'required|xss_clean');
			$this->form_validation->set_rules('video_thumbnail_maxheight', 'video_thumbnail_maxheight', 'required|xss_clean');
			$this->form_validation->set_rules('video_thumbnail_quality', 'video_thumbnail_quality', 'required|xss_clean');
			$this->form_validation->set_rules('videos_per_page', 'videos_per_page', 'required|xss_clean');
			$this->form_validation->set_rules('video_short_char_limit', 'video_short_char_limit', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('video_config');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$this->load->view($data['template_path'] . '/configuration/video_configuration', $data);
				}
			else
				{
				$this->config->load('video_config', true);
				$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
				. '$config["videos_per_page"] = ' . var_export($this->input->post('videos_per_page'), true) . ";\n"
				. '$config["video_short_char_limit"] = ' . var_export($this->input->post('video_short_char_limit'), true) . ";\n"
				. '$config["video_allow_comments"] = ' . $this->input->post('video_allow_comments') . ";\n"
				. '$config["video_image_security"] = ' . $this->input->post('video_image_security') . ";\n"
				. '$config["video_normal_maxwidth"] = ' . var_export($this->input->post('video_normal_maxwidth'), true) . ";\n"
				. '$config["video_normal_maxheight"] = ' . var_export($this->input->post('video_normal_maxheight'), true) . ";\n"
				. '$config["video_normal_quality"] = ' . var_export($this->input->post('video_normal_quality'), true) . ";\n"
				. '$config["video_small_maxwidth"] = ' . var_export($this->input->post('video_small_maxwidth'), true) . ";\n"
				. '$config["video_small_maxheight"] = ' . var_export($this->input->post('video_small_maxheight'), true) . ";\n"
				. '$config["video_small_quality"] = ' . var_export($this->input->post('video_small_quality'), true) . ";\n"
				. '$config["video_medium_maxwidth"] = ' . var_export($this->input->post('video_medium_maxwidth'), true) . ";\n"
				. '$config["video_medium_maxheight"] = ' . var_export($this->input->post('video_medium_maxheight'), true) . ";\n"
				. '$config["video_medium_quality"] = ' . var_export($this->input->post('video_medium_quality'), true) . ";\n"
				. '$config["video_thumbnail_maxwidth"] = ' . var_export($this->input->post('video_thumbnail_maxwidth'), true) . ";\n"
				. '$config["video_thumbnail_maxheight"] = ' . var_export($this->input->post('video_thumbnail_maxheight'), true) . ";\n"
				. '$config["video_thumbnail_quality"] = ' . var_export($this->input->post('video_thumbnail_quality'), true) . ";\n"
				. '?>';
				write_file(APPPATH . 'config/video_config.php', $data);
				$msg = $this->lang->line('file_written');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('configuration/website_config/#tabs-8');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function google_fonts()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('fonts[]', 'fonts[]', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('fonts_text');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['flashmsg'] = $this->session->flashdata('flashmsg');
				$url  = 'http://static.scripting.com/google/webFontNames.txt';
				$path = 'assets/fonts/remote_fonts.txt';
				
				$fp = fopen($path, 'w');
		 
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_FILE, $fp);
		 
				$data2 = curl_exec($ch);
		 
				curl_close($ch);
				fclose($fp);
				$ga = file_get_contents($path);
				$data['ga_fonts'] = array();
				$data['ga_fonts'] = explode("\r", $ga);
				//print_r($data['ga_fonts']);
				$this->load->view($data['template_path'] . '/configuration/google_fonts', $data);
				}
			else
				{
				if($this->input->post('fonts') == '')
					{
					}
					else
					{
					$this->config->load('fonts_config', true);
					$new_tag = '';
					for($i = 0; $i < count($_POST['fonts']); $i++)
						{
						if(end($_POST['fonts']) == $_POST['fonts'][$i])
							{
							$new_tag .= $_POST['fonts'][$i];
							}
						else
							{
							$new_tag .= $_POST['fonts'][$i] . '|';
							}
						}
					$this->config->load('fonts_config', true);
					$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
						. '$config["google_fonts"] = ' . var_export($new_tag, true) . ";\n"
						. '?>';
					write_file(APPPATH . 'config/fonts_config.php', $data);
					$msg = $this->lang->line('file_written');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('configuration/website_config/#tabs-8');
					}
				}
			//print_r($ga);
			}
		else
			{
			echo "access denied";
			}
		}
		
	}