<?php
###################################################################
##
##	Upload Module
##	Version: 1.03
##
##	Last Edit:
##	Feb 3 2013
##
##	Description:
##	Upload Extra Image Files
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Upload extends ADMIN_Controller
	{
	
	function Upload()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('directory');
		$this->load->helper('file');
		
		#Libraries
		$this->load->library('image_lib');
		$this->load->library('ion_auth');
		$this->load->library('session');
	
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
		redirect('upload/upload_file');
		}
	
	function upload_file()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['error'] = "";
			$data['heading'] = "Upload Image/JS/CSS";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/upload/upload_form';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function do_upload()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			#SET UP THE UPLOAD LIB FOR UPLOADING OF SELECTED FILE TO THE SELECTED DIRECTORY, YOU CAN CONFIGURE FILE MIME TYPES IN THE mimes.php file in the application/config folder.
			$config['upload_path'] = './assets/images/uploads';
			$config['allowed_types'] = $this->config->item('global_filetypes');
			$config['max_size']	= $this->config->item('global_upload_limit');
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload())
				{
				#IF THE UPLOAD FAILED, CHOMOD THE DIRECTORY BACK TO READ ONLY, AND CLOSE THE FTP CONNECTION THAN REDIRECT BACK TO THE UPLOAD FILE SCREEN, AND DISPLAY AN ERROR MESSAGE!
				$error = array('error' => $this->upload->display_errors());
				$data['heading'] = "Upload Image Files";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/upload/upload_form';
				$this->load->vars($data);
				$this->load->view($this->_container, $error);
				}
			else
				{
				#IF THE FILE WAS UPLOADED SUCCESSFULLY CHOMOD THE DIRECTORY BACK TO READ ONLY, AND CLOSE THE FTP CONNECTION THAN LOAD THE SUCCESS PAGE
				$data = array('upload_data' => $this->upload->data());
				$data['heading'] = "Upload Success!";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/upload/upload_success';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			}
		else
			{
			echo "access denied";
			}
		}
	}