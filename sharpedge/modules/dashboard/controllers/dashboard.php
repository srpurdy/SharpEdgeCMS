<?php defined('BASEPATH') OR exit('No direct script access allowed');
###################################################################
##
##	Dashboard Module
##	Version: 1.21
##
##	Last Edit:
##	March 12 2013
##
##	Description:
##	Provide Various Quick Controls - Widgets
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Dashboard extends ADMIN_Controller {

	function __construct()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->library('image_moo');
		
		#Models
		$this->load->model('dashboard_model');
		$this->load->model('blog_admin/blog_admin_model');
		$this->load->model('page_admin/page_admin_model');
		$this->load->model('widget_admin/widget_admin_model');
		$this->load->model('log_admin/log_admin_model');
		$this->load->model('menu_admin/menu_admin_model');
		
		#Helpers
		$this->load->helper('date');
		$this->load->helper('directory');
		
		#Configuration
		$this->load->config('blog_config');
		$this->load->config('analytics');
		
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
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->data['heading'] = 'Dashboard';
			$this->data['template_path'] = $this->config->item('template_admin_page');
			$this->data['protect_module'] = $this->backend_model->protect_module();
			$this->data['page'] = $this->data['template_path'] . '/dashboard/dashboard_view';
			$this->data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($this->data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function analytics()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//User Information
			$ga_email = $this->config->item('username');
			$ga_password = $this->config->item('password');
			$ga_profile_id = $this->config->item('profile_id'); //'50151742';
			
			//Library
			$this->load->library('gapi');
			
			//Login
			$ga = $this->gapi->login($ga_email,$ga_password);
			
			//metrics
			$dimensions = array('date');
			$metrics = array('pageviews','visits','visitors','visitBounceRate');
			$sort_metric = array('date'); 
			$filter = null;
			$start_date = $this->config->item('start_date');//'2005-01-01';
			$end_date = date('Y-m-d');
			$start_index = 1;
			$max_results = 10000000;
			
			//Request Data
			$this->gapi->requestReportData($ga_profile_id,$dimensions,$metrics,$sort_metric,$filter,$start_date,$end_date,$start_index,$max_results);

			$data['heading'] = 'Analytics';
			$data['result'] = $this->gapi->getResults();
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/dashboard/stats', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function stat_by_month_year()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$month_year = $this->uri->segment(3);
			
			//User Information
			$ga_email = $this->config->item('username');
			$ga_password = $this->config->item('password');
			$ga_profile_id = $this->config->item('profile_id'); //'50151742';
			
			//Library
			$this->load->library('gapi');
			
			//Login
			$ga = $this->gapi->login($ga_email,$ga_password);
			
			//metrics
			$dimensions = array('date');
			$metrics = array('pageviews','visits','visitors','visitBounceRate');
			$sort_metric = array('date'); 
			$filter = null;
			$start_date = $month_year;//'2005-01-01';
			$end_date = date("Y-m-t", strtotime($start_date));
			$start_index = 1;
			$max_results = 10000000;
			
			//Request Data
			$this->gapi->requestReportData($ga_profile_id,$dimensions,$metrics,$sort_metric,$filter,$start_date,$end_date,$start_index,$max_results);
			$data['heading'] = 'Analytics';
			$data['result'] = $this->gapi->getResults();
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/dashboard/stats_by_month', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_page()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text2', 'text2', 'required');
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean');
			$this->form_validation->set_rules('meta_desc', 'meta_desc', 'xss_clean');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('hide', 'hide', 'xss_clean');
			$this->form_validation->set_rules('draft', 'draft', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Page';
				$template_path = $this->config->item('template_admin_page');
				$data['containers'] = $this->page_admin_model->get_containers();
				$data['get_slideshow'] = $this->page_admin_model->get_slideshow();
				$data['w_locations'] = $this->widget_admin_model->get_widget_locations();
				$data['groups'] = $this->page_admin_model->get_groups();
				$data['langs'] = $this->page_admin_model->get_langs();
				if(!isset($_POST['name']))
					{
					$this->load->view($template_path . '/dashboard/addpage', $data);
					}
				else
					{
					$data['page'] = $template_path . '/dashboard/addpage';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				#Check if the page will be saved as a draft or not
				if($this->input->post('draft') == 'Y')
					{
					#hidden page draft.
					$this->page_admin_model->page_insert_draft();
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('dashboard');
					}
				else
					{
					#Live Publicly viewable
					$this->dashboard_model->page_insert();
					$page_id = $this->db->insert_id();
					$w_locations = $this->widget_admin_model->get_widget_locations();
					foreach($w_locations->result() as $wl)
						{
						$loc = $wl->id;
							
						if($this->input->post($wl->name) == '0')
							{
							$this->widget_admin_model->delete_page_exist($loc, $page_id);
							}
						else
							{
							$group_id = $_POST[$wl->name];
							$this->widget_admin_model->delete_page_exist($loc, $page_id);
							$this->widget_admin_model->insert_page_widgets($loc, $page_id, $group_id);
							}
						}
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('dashboard');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_menu()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('link', 'link', 'xss_clean');
			$this->form_validation->set_rules('use_page', 'use_page', 'xss_clean');
			$this->form_validation->set_rules('page_link', 'page_link', 'xss_clean');
			$this->form_validation->set_rules('parent_id', 'parent_id', 'xss_clean');
			$this->form_validation->set_rules('child_id', 'child_id', 'xss_clean');
			$this->form_validation->set_rules('has_child', 'has_child', 'xss_clean');
			$this->form_validation->set_rules('has_sub_child', 'has_sub_child', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('Orderfield', 'Orderfield', 'xss_clean');
			$this->form_validation->set_rules('hide', 'hide', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Menu Item';
				$template_path = $this->config->item('template_admin_page');
				$data['menu_items'] = $this->menu_admin_model->menu_index();
				$data['get_pages'] = $this->menu_admin_model->get_pages();
				$data['langs'] = $this->menu_admin_model->get_langs();
				if(!isset($_POST['use_page']))
					{
					$this->load->view($template_path . '/dashboard/addmenu', $data);
					}
				else
					{
					$data['page'] = $template_path . '/dashboard/addmenu';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->menu_admin_model->menu_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('menu');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('dashboard');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_news()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'required');
			$this->form_validation->set_rules('add_image', 'add_image', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('gallery_display', 'gallery_display', 'xss_clean');
			$this->form_validation->set_rules('gallery_id', 'gallery_id', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run($this) == FALSE)
				{
				$data['heading'] = $this->lang->line('new_blog_post');
				$template_path = $this->config->item('template_admin_page');
				$data['get_galleries'] = $this->blog_admin_model->get_galleries();
				$data['tags'] = $this->blog_admin_model->get_tags();
				$data['langs'] = $this->blog_admin_model->get_langs();
				
				if(!isset($_POST['add_image']))
					{
					$this->load->view($template_path . '/dashboard/blog_new_post', $data);
					}
				else
					{
					$data['page'] = $template_path . '/dashboard/blog_new_post';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				if($this->input->post('add_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/news/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						redirect('dashboard/#tabs-2');
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();
						
						$thumb_path = 'assets/news/thumbs/' . $data['upload_data']['file_name'];
						$small_path = 'assets/news/small/' . $data['upload_data']['file_name'];
						$medium_path = 'assets/news/medium/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/news/normal/' . $data['upload_data']['file_name'];
					
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_thumbnail_quality'))
							->resize_crop($this->config->item('blog_thumbnail_maxwidth'),$this->config->item('blog_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_normal_quality'))
							->resize_crop($this->config->item('blog_normal_maxwidth'),$this->config->item('blog_normal_maxheight'))
							->save($normal_path, TRUE);
							
						//Create Medium Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_medium_quality'))
							->resize_crop($this->config->item('blog_medium_maxwidth'),$this->config->item('blog_medium_maxheight'))
							->save($medium_path, TRUE);
							
						//Create Small Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_small_quality'))
							->resize_crop($this->config->item('blog_small_maxwidth'),$this->config->item('blog_small_maxheight'))
							->save($small_path, TRUE);
						
						$userfile = $data['upload_data']['file_name'];
						$this->blog_admin_model->blog_insert($userfile);
						$post_id = $this->db->insert_id();
						if($this->input->post('tags') == '')
							{
							}
							else
							{
							for($i = 0; $i < count($_POST['tags']); $i++)
								{
								$new_tag = $_POST['tags'][$i];
								$this->blog_admin_model->import_category($new_tag, $post_id);
								}
							}
						$this->load->dbutil();
						$this->dbutil->optimize_table('blog');
						$msg = $this->lang->line('added');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('dashboard');
						}
					}
				else
					{
					$userfile = '';
					$this->blog_admin_model->blog_insert($userfile);
					$post_id = $this->db->insert_id();
					if($this->input->post('tags') == '')
						{
						}
						else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->blog_admin_model->import_category($new_tag, $post_id);
							}
						}
					$this->load->dbutil();
					$this->dbutil->optimize_table('blog');
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('dashboard');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function latest_comments()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['show_comments'] = $this->dashboard_model->show_comments();
			$data['heading'] = $this->lang->line('manage_blog_comments');
			$data['template_path'] = $this->config->item('template_admin_page');
			$this->load->view($data['template_path'] . '/dashboard/comment_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function spam_log()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->log_admin_model->spam_log();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/dashboard/spam_log', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function widget_locations()
		{
		}
	
	function updates()
		{
		$this->data['heading'] = 'Change Log';
		$this->data['template_path'] = $this->config->item('template_admin_page');
		$this->data['page'] = $this->data['template_path'] . '/dashboard/updates';
		$this->load->vars($this->data);
		$this->load->view($this->_container);
		}
}