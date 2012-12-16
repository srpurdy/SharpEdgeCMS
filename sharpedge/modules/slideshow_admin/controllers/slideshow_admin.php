<?php
###################################################################
##
##	Slideshow Admin Module
##	Version: 1.04
##
##	Last Edit:
##	Sept 25 2012
##
##	Description:
##	Slideshow Control System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Slideshow_admin extends ADMIN_Controller
	{
	
	function Slideshow_admin()
		{
		parent::__construct();
		#Libarays
		$this->load->library('image_lib');

		#Models
		$this->load->model('slideshow_admin_model');

		#Helpers
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->helper('directory');
		
		#Configuration
		$this->load->config('gallery_config');
	
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
			$data['query'] = $this->slideshow_admin_model->show_slideshow();
			$data['heading'] = "Manage Slideshow Images";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  $data['template_path'] . '/slideshow_admin/slideshow_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_image()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('desc_one', 'desc_one', 'xss_clean');
			$this->form_validation->set_rules('desc_two', 'desc_two', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['desc_one']))
					{
					redirect('slideshow_admin/#tabs-2');
					}
				else
					{
					$data['error'] = '';
					$data['heading'] = 'Add Image';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'add_image';
					$data['get_assets'] = directory_map('./assets/images/uploads/');
					$this->load->view($data['template_path'] . '/slideshow_admin/add_image', $data);
					}
				}
			else
				{
				#Upload file
				$config['upload_path'] = './assets/gallery/slideshow/';
				$config['allowed_types'] = 'png|jpg|gif';
				$config['max_size']	= '20000';
				$config['max_width']  = '5000';
				$config['max_height']  = '5000';
				$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
					{
					$error = array('error' => $this->upload->display_errors());
					$data['heading'] = 'Add Image';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = $data['template_path'] . '/slideshow_admin/add_image';
					$data['get_assets'] = directory_map('./assets/images/uploads/');
					$this->load->vars($data);    
					$this->load->view($this->_container, $error);
					}
					else
					{
					$data = array('upload_data' => $this->upload->data());		
					$config['image_library'] = 'GD2';
					$updatea = $this->upload->data();
					$config['source_image'] = $updatea['full_path'];
					$config['new_image'] = 'assets/gallery/slideshow/thumbs/';
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['quality'] = $this->config->item('thumbnail_quality');
					$config['width'] = $this->config->item('thumbnail_maxwidth');
					$config['height'] = $this->config->item('thumbnail_maxheight');
					$config['thumb_marker'] = '';
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					#config2
					$config2['source_image'] = $updatea['full_path'];
					$config2['new_image'] = 'assets/gallery/slideshow/normal/';
					$config2['create_thumb'] = TRUE;
					$config2['maintain_ratio'] = TRUE;
					$config2['quality'] = $this->config->item('slideshow_quality');
					$config2['width'] = $this->config->item('slideshow_maxwidth');
					$config2['height'] = $this->config->item('slidshow_maxheight');
					$config2['thumb_marker'] = '';
					$this->image_lib->initialize($config2);
					$this->image_lib->resize();
					
					#Insert file info into database
					$userfile = $data['upload_data']['file_name'];
					$this->slideshow_admin_model->image_insert($userfile);
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('./slideshow_admin/');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_image()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean|required');
			$this->form_validation->set_rules('desc_one', 'desc_one', 'xss_clean');
			$this->form_validation->set_rules('desc_two', 'desc_two', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['edit_image'] = $this->slideshow_admin_model->edit_image();
				$data['get_assets'] = directory_map('./assets/images/uploads/');
				$data['heading'] = "Edit Image";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/slideshow_admin/edit_image';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->slideshow_admin_model->image_update();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('./slideshow_admin/');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_image()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->slideshow_admin_model->image_delete();
			redirect('./slideshow_admin/');
			}
		else
			{
			echo "access denied";
			}
		}

	function manage_groups()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['query'] = $this->slideshow_admin_model->show_slidegroups();
			$data['heading'] = "Manage Slideshow Groups";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  'group_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/slideshow_admin/group_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['name']))
					{
					redirect('slideshow_admin/#tabs-4');
					}
				else
					{
					$data['heading'] = "New Group";
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'new_group';
					$data['images'] = $this->slideshow_admin_model->get_images();
					$this->load->view($data['template_path'] . '/slideshow_admin/new_group', $data);
					}
				}
			else
				{
				$images = $_POST['images'] = serialize($_POST['images']);
				$images = explode("~", $images);
				$this->slideshow_admin_model->group_insert($images);
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('slideshow_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->slideshow_admin_model->edit_group();
				$data['heading'] = "Edit Group";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/slideshow_admin/edit_group';
				$data['images'] = $this->slideshow_admin_model->get_images();
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$images = $_POST['images'] = serialize($_POST['images']);
				$images = explode("~", $images);
				$this->slideshow_admin_model->group_update($images);
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('slideshow_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_group()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->slideshow_admin_model->group_delete();
			redirect('slideshow_admin/#tabs-3');
			}
		else
			{
			echo "access denied";
			}
		}
	}