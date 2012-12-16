<?php
###################################################################
##
##	Menu Admin Module
##	Version: 1.06
##
##	Last Edit:
##	Oct 28 2012
##
##	Description:
##	Menu Control System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Menu_admin extends ADMIN_Controller
	{	
    function Menu_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('form');
		$this->load->helper('directory');
		
		#Models
		$this->load->model('menu_admin_model');
	
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
		$data['heading'] = 'Manage Menu Items';
		$data['template_path'] = $this->config->item('template_admin_page');
		$data['query'] = $this->menu_admin_model->menu_index();
		$data['flashmsg'] = $this->session->flashdata('flashmsg');
		$data['page'] = $data['template_path'] . '/menu_admin/menu';
		$this->load->vars($data);
		$this->load->view($this->_container);
		}
	else
		{
		echo "access denied";
		}
    }

    function editmenu()
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
				$data['heading'] = 'Edit Menu Item';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['menu_items'] = $this->menu_admin_model->menu_index();
				$data['query'] = $this->menu_admin_model->menu_edit();
				$data['langs'] = $this->menu_admin_model->get_langs();
				$data['get_pages'] = $this->menu_admin_model->get_pages();
				$data['page'] = $data['template_path'] . '/menu_admin/editmenu';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->menu_admin_model->menu_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('menu');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('menu_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function addmenu()
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
					$this->load->view($template_path . '/menu_admin/addmenu', $data);
					}
				else
					{
					$data['page'] = $template_path . '/menu_admin/addmenu';
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
				redirect('menu_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deletemenu()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->menu_admin_model->menu_delete();
			$this->load->dbutil();
			$this->dbutil->optimize_table('menu');
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('menu_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	}