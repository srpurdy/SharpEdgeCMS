<?php
###################################################################
##
##	Download Admin Module
##	Version: 0.92
##
##	Last Edit:
##	Oct 28 2012
##
##	Description:
##	Download Admin Control System.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Download_admin extends ADMIN_Controller
	{
	function Download_admin()
		{
		parent::__construct();
		#Libraries
		
		#Helpers
		$this->load->helper('date');
		$this->load->helper('file');
		
		#Config
		//$this->load->config('download_config');
		
		#Models
		$this->load->model('download_admin_model');
	
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
			$data['heading'] = 'Manage Downloads';
			$data['query'] = $this->download_admin_model->get_downloads();
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/download_admin/download_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function add_download()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('download_name', 'download_name', 'xss_clean|required');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('desc', 'desc', 'xss_clean');
			$this->form_validation->set_rules('sort_id', 'sort_id', 'xss_clean');
			$this->form_validation->set_rules('isProduct', 'isProduct', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['error'] = '';
				$data['heading'] = 'Add Download';
				$data['template_path'] = $this->config->item('template_admin_page');
				if(!isset($_POST['download_name']))
					{
					$this->load->view($data['template_path'] . '/download_admin/add_download', $data);
					}
				else
					{
					$data['page'] = $data['template_path'] . '/download_admin/add_download';
					$this->load->vars($data); 
					$this->load->view($this->_container);
					}
				}
			else
				{
				#Upload file
				$config['upload_path'] = './assets/downloads/files/';
				$config['allowed_types'] = 'zip|pdf|png|jpg|gif';
				$config['max_size']	= '20000';
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload())
					{
					$error = array('error' => $this->upload->display_errors());
					$data['heading'] = 'Add Download';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = $data['template_path'] . '/download_admin/add_download';
					$this->load->vars($data); 
					$this->load->view($this->_container, $error);
					}
				else
					{
					$data = array('upload_data' => $this->upload->data());
					$userfile = $data['upload_data']['file_name'];
					$this->download_admin_model->insert_download($userfile);
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('download_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function edit_download()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('download_name', 'download_name', 'xss_clean|required');
			$this->form_validation->set_rules('desc', 'desc', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('sort_id', 'sort_id', 'xss_clean');
			$this->form_validation->set_rules('isProduct', 'isProduct', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Download';
				$data['query'] = $this->download_admin_model->edit_download();
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/download_admin/edit_download';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				if($this->input->post('update_download') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/downloads/files/';
					$config['allowed_types'] = 'zip|pdf|png|jpg|gif';
					$config['max_size']	= '20000';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						$error = array('error' => $this->upload->display_errors());
						$template_path = $this->config->item('template_admin_page');
						$data['heading'] = 'Edit Download';
						$data['page'] = $template_path . '/download_admin/edit_download';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$updatea = $this->upload->data();		
						$data = array('upload_data' => $this->upload->data());
						$userfile = $data['upload_data']['file_name'];
						}
					}
				else
					{
					$userfile = '';
					}
				$this->download_admin_model->update_download($userfile);
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('download_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function delete_download()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->download_admin_model->delete_download();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('download_admin');
			}
		else
			{
			echo "access denied";
			}
		}
}