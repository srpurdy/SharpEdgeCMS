<?php
###################################################################
##
##	Tools Admin Module
##	Version: 0.90
##
##	Last Edit:
##	March 10 2013
##
##	Description:
##	Tools System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Tools_admin extends ADMIN_Controller
	{	
    function Tools_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('form');
		$this->load->helper('file');
		
		#Models
	
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
			$data['heading'] = 'Tools';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/tools_admin/tools_index';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function database_backup()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			// Load the DB utility class
			$this->load->dbutil();

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup(); 
			
			$this->load->helper('download');
			force_download('shapedge_database_backup.gz', $backup);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function database_optimize()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			// Load the DB utility class
			$this->load->dbutil();
			$data['db_opt'] = $this->dbutil->optimize_database();
			$data['heading'] = 'Database Optimize';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/tools_admin/tools_db_opt';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function info_php()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = 'PHP Information';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/tools_admin/tools_php';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	}