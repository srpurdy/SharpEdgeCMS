<?php
###################################################################
##
##	Log Admin Module
##	Version: 1.00
##
##	Last Edit:
##	Dec 3 2012
##
##	Description:
##	Log System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Log_admin extends ADMIN_Controller
	{	
    function Log_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('form');
		
		#Models
		$this->load->model('log_admin_model');
	
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
		//May add a gui with selectable logs later (only 1 log currently)
		echo "access denied";
		}
	
	function spam_log()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = 'Spam Log';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->log_admin_model->spam_log();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/log_admin/spam_log';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function delete_spam_log()
		{
		$this->log_admin_model->delete_spam_log();
		$this->load->dbutil();
		$this->dbutil->optimize_table('spam_log');
		$msg = $this->lang->line('delete');
		$this->session->set_flashdata('flashmsg', $msg);
		redirect('log_admin/spam_log');
		}
	}