<?php
###################################################################
##
##	Gateway Admin Module
##	Version: 1.00
##
##	Last Edit:
##	Sept 25 2012
##
##	Description:
##	Gateway Admin System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Gateway_admin extends ADMIN_Controller
	{
    function Gateway_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		#Models
		$this->load->model('gateway_admin_model');
		
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
			$data['heading'] = 'Manage Gateways';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->gateway_admin_model->get_gateways();
			$data['page'] = $data['template_path'] . '/gateway_admin/gateway_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);	        
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function add_gateway()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('module_name', 'module_name', 'xss_clean|required');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['name']))
					{
					redirect('gateway_admin/#tabs-2');
					}
				else
					{
					$data['heading'] = 'Add Gateway';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'addlang';
					$this->load->view($data['template_path'] . '/gateway_admin/add_gateway', $data);
					}
				}
			else
				{
				$this->gateway_admin_model->gateway_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('gateways');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('gateway_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
    function edit_gateway()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('module_name', 'module_name', 'xss_clean|required');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Gateway';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->gateway_admin_model->gateway_edit();
				$data['page'] = $data['template_path'] . '/gateway_admin/edit_gateway';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->gateway_admin_model->gateway_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('gateways');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('gateway_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_gateway()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->gateway_admin_model->gateway_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('gateway_admin');
			}
		else
			{
			echo "access denied";
			}
		}
}