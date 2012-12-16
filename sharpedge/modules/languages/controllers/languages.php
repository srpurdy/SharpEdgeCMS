<?php
###################################################################
##
##	Language Module
##	Version: 1.04
##
##	Last Edit:
##	Oct 28 2012
##
##	Description:
##	Language System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Languages extends ADMIN_Controller
	{
    function Languages()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		#Models
		$this->load->model('lang_model');
		
		#Libraries
		$this->load->library('ion_auth');
		$this->load->library('session');
		
		#Language
		$this->lang->load('ion_auth');
		
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
			$data['heading'] = 'Manage Languages';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->lang_model->get_languages();
			$data['page'] = $data['template_path'] . '/languages/lang_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);	        
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function addlang()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean|required');
			$this->form_validation->set_rules('lang_short', 'lang_short', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Language';
				$data['template_path'] = $this->config->item('template_admin_page');
				
				if(!isset($_POST['lang']))
					{
					$this->load->view($data['template_path'] . '/languages/addlang', $data);
					}
				else
					{
					$data['page'] = $data['template_path'] . '/languages/addlang';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->lang_model->lang_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('languages');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('languages');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
    function editlang()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean|required');
			$this->form_validation->set_rules('lang_short', 'lang_short', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Language';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->lang_model->lang_edit();
				$data['page'] = $data['template_path'] . '/languages/editlang';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->lang_model->lang_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('languages');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('languages');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deletelang()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->lang_model->lang_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('languages');
			}
		else
			{
			echo "access denied";
			}
		}
}