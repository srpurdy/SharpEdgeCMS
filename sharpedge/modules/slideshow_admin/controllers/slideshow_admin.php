<?php
###################################################################
##
##	Slideshow Admin Module
##	Version: 1.05
##
##	Last Edit:
##	Feb 2 2013
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
		$this->load->library('image_moo');

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
				$config['allowed_types'] = $this->config->item('global_filetypes');
				$config['max_size']	= $this->config->item('global_upload_limit');
				$config['max_width']  = $this->config->item('global_upload_maxwidth');
				$config['max_height']  = $this->config->item('global_upload_maxheight');
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
					$updatea = $this->upload->data();					
					
					$thumb_path = 'assets/gallery/slideshow/thumbs/' . $data['upload_data']['file_name'];
					$normal_path = 'assets/gallery/slideshow/normal/' . $data['upload_data']['file_name'];
					
					//Create Thumbnail
					$this->image_moo
						->load($updatea['full_path'])
						->set_jpeg_quality($this->config->item('thumbnail_quality'))
						->resize_crop($this->config->item('thumbnail_maxwidth'),$this->config->item('thumbnail_maxheight'))
						->save($thumb_path, TRUE);
						
					//Create Normal Size
					$this->image_moo
						->load($updatea['full_path'])
						->set_jpeg_quality($this->config->item('slideshow_quality'))
						->resize_crop($this->config->item('slideshow_maxwidth'),$this->config->item('slideshow_maxheight'))
						->save($normal_path, TRUE);
					
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