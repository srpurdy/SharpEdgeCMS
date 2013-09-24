<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/* The MX_Controller class is autoloaded as required */
###################################################################
##
##	Main Controller Class
##	Version: 1.21
##
##	Last Edit:
##	Dec 28 2012
##
##	Description:
##	
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class MY_Controller extends MX_Controller
	{
	var $data = array();

	function MY_Controller()
		{
		$this->output->set_header('Content-Type: text/html; charset=utf-8');
		if($this->uri->segment(1) == 'blog_feed')
			{
			$this->output->set_header('Content-Type: application/xml; charset=utf-8');
			}
		#Load Sharpedge Configuration Files
		$this->load->config('template_config');
		$this->load->config('template_path_config');
		$this->load->config('website_config');
		$this->load->config('recaptcha');
		
		#Load User Agents
		$this->load->library('user_agent');
		
		#Load Sharpedge Interface Language Pack
		$this->lang->load('sharpedge', $this->config->item('language'));
		
		#Load Global Models
		$this->load->model('frontend_model');
		$this->load->model('pages/page_model');
		
		#Load Multi-Site Configuration
		$multi_site_temp = $this->frontend_model->multi_site_template($_SERVER['HTTP_HOST']);
		
		#Check for Short URL
		if($this->config->item('short_url') == 1)
			{
			$seg = $this->uri->segment(1);
			}
		else
			{
			$seg = $this->uri->segment(3);
			}
		
		#Get Page For Meta Tags
		if($this->router->fetch_class() == 'pages')
			{
			$this->data['curpage'] = $this->page_model->page_section($seg);
			if($this->data['curpage']->result())
				{
				foreach($this->data['curpage']->result() as $cp)
					{
					$this->data['mod_con_top'] = $this->page_model->get_page_widgets('content_top', $seg);
					$this->data['mod_con_bot'] = $this->page_model->get_page_widgets('content_bottom', $seg);
					$this->data['mod_side_top'] = $this->page_model->get_page_widgets('side_top', $seg);
					$this->data['mod_side_bot'] = $this->page_model->get_page_widgets('side_bottom', $seg);
					$page_restrict = $cp->restrict_access;
					$page_user_group = $cp->user_group;
					$logged_in_group = $this->page_model->get_user_group($this->session->userdata('user_id'));
					$page_access = true;
					if(!$this->ion_auth->logged_in())
						{
						if($page_restrict == 'Y')
							{
							$page_access = false;
							}
						}
					foreach($logged_in_group->result() as $lig)
						{
							if($page_restrict == 'Y')
								{
								if($page_user_group == $lig->group_id)
									{
									$page_access = true;
									break;
									}
								else
									{
									$page_access = false;
									}
								}
							else
								{
								$page_access = true;
								}
						}
					
					if($page_access == false)
						{
						show_error('access not allowed', 500);
						}
						
					//lets get the page layout
					$page_container = $cp->container_name;
					$this->data['page_heading'] = $cp->name;
					$this->data['page_text'] = $cp->text;
					$this->data['page_hide'] = $cp->hide;
					}
				}
			else
				{
				show_404('page');
				}
			}
		else
			{
			$this->data['curpage'] = '';
			
			$ctrl_widgets = $this->frontend_model->ctrl_widgets($this->uri->segment(1));
			foreach($ctrl_widgets->result() as $cw)
				{
				$this->data['mod_content_top'] = $this->frontend_model->get_ctrl_widgets('content_top', $cw->name);
				$this->data['mod_content_bot'] = $this->frontend_model->get_ctrl_widgets('content_bottom', $cw->name);
				$this->data['mod_side_top'] = $this->frontend_model->get_ctrl_widgets('side_top', $cw->name);
				$this->data['mod_side_bot'] = $this->frontend_model->get_ctrl_widgets('side_bottom', $cw->name);
				}
			$page_container = '';
			}
		
		#Check if the Install Folder is still on the server.
		$install_folder = $_SERVER['DOCUMENT_ROOT'].'/install';
		if(file_exists($install_folder))
			{
			show_error('The SharpEdge Install folder is still on the server. You must delete the install folder before proceeding.', 500);
			}
		
		#Model Calls
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			if($this->router->fetch_class() != 'pages')
				{
				$ctrl_template = '';
				$ctrl_mobile_template = $this->frontend_model->get_ctrl_mobile_template();
				$pg_template = '';
				$pg_mobile_template = '';
				}
			else
				{
				$pg_mobile_template = $this->frontend_model->get_page_mobile_template($page_container);
				$pg_template = '';
				$ctrl_template = '';
				$ctrl_mobile_template = '';
				}
			}
		else
			{
			if($this->router->fetch_class() != 'pages')
				{
				$ctrl_mobile_template = '';
				$ctrl_template = $this->frontend_model->get_ctrl_template();
				$pg_template = '';
				$pg_mobile_template = '';
				}
			else
				{
				$pg_mobile_template = '';
				$pg_template = $this->frontend_model->get_page_template($page_container);
				$ctrl_template = '';
				$ctrl_mobile_template = '';
				}
			}
		
		//Global Admin Check
		$this->data['admin_logged_in'] = $this->ion_auth->is_admin();
		//Global User Check
		$this->data['user_logged_in'] = $this->ion_auth->logged_in();
		
		//Check for Dashboard permissions
		$this->data['dashboard_read'] = 'N';
		if($this->data['user_logged_in'])
			{
			$this->data['dash_permissions'] = $this->frontend_model->dashboard_permissions();
			if($this->data['dash_permissions']->result())
				{
				foreach($this->data['dash_permissions']->result() as $dp)
					{
					$this->data['dashboard_read'] = $dp->read;
					if($this->data['dashboard_read'] == 'Y')
						{
						break;
						}
					}
				}
			else
				{
				$this->data['dashboard_read'] = 'N';
				}
			}
		
		#Extract Theme Information
		$this->data['theme'] = $this->config->item('theme');
		$this->data['mobile_theme'] = $this->config->item('mobile_theme');
		$this->data['template'] = $this->config->item('template_url');
		$this->data['mobile_template'] = $this->config->item('template_mobile_url');
		$this->data['j_ui_theme'] = $this->config->item('j_ui_theme');
		
		#Resource URL Addresses for Cookieless domains and performance optimization
		$this->data['themes_url'] = $this->config->item('themes_url');
		$this->data['assets_url'] = $this->config->item('assets_url');
		$this->data['gallery_url'] = $this->config->item('gallery_url');
		
		#Load The Menu System, and pass language variable.
		$this->data['menu'] = $this->frontend_model->get_menu($this->config->item('language_abbr'));

		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{			
			#Page Handling
			if($pg_mobile_template == '' AND $this->router->fetch_class() == 'pages')
				{
				$this->_container_pages = $this->data['mobile_template'];
				show_404('page');
				}
			else
				{
				$this->_container_pages = $pg_mobile_template;
				$this->_container = $this->data['mobile_template'];
				$this->_container_ctrl = $ctrl_mobile_template;
				}
			}
		else
			{
			#Page Handling
			if($pg_template == '' AND $this->router->fetch_class() == 'pages')
				{
				$this->_container_pages = $this->data['template'];
				show_404('page');
				}
			else
				{
				$this->_container_pages = $pg_template;
				$this->_container = $this->data['template'];
				$this->_container_ctrl = $ctrl_template;
				}
			}
			
		$this->load->vars($this->data);
		}
	}