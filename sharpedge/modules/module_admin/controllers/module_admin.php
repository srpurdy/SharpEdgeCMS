<?php
###################################################################
##
##	Module Admin Module
##	Version: 1.06
##
##	Last Edit:
##	Dec 28 2012
##
##	Description:
##	Module Control System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Module_admin extends ADMIN_Controller
	{	
    function Module_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('directory');
		$this->load->helper('file');
		
		#Models
		$this->load->model('module_admin_model');
		$this->load->model('widget_admin/widget_admin_model');
		
		#Libraries
		$this->load->library('table');
		
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
			$data['heading'] = 'Manage Modules';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->module_admin_model->module_index();
			$data['page'] = $data['template_path'] . '/module_admin/modules';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);	        
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

    function edit_module()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('container', 'container', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('is_admin', 'is_admin', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Module';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->module_admin_model->module_edit();
				$data['get_slideshow'] = $this->module_admin_model->get_slideshow();
				$data['w_locations'] = $this->widget_admin_model->get_widget_locations();
				$w_i = 0;
				foreach($data['w_locations']->result() as $w)
					{
					$widget_loc_id[$w_i] = $w->id;
					$data['widget_location'][$w_i] = $this->module_admin_model->get_module_widgets($widget_loc_id[$w_i]);
					$w_i++;
					}
				$data['groups'] = $this->module_admin_model->get_groups();
				$data['page'] = $data['template_path'] . '/module_admin/edit_module';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$w_locations = $this->widget_admin_model->get_widget_locations();
				foreach($w_locations->result() as $wl)
					{
					$loc = $wl->id;
					$module_id = $this->uri->segment(3);
					if($this->input->post($wl->name) == '0')
						{
						$this->widget_admin_model->delete_module_exist($loc, $module_id);
						}
					else
						{
						$group_id = $_POST[$wl->name];
						$this->widget_admin_model->delete_module_exist($loc, $module_id);
						$this->widget_admin_model->insert_module_widgets($loc, $module_id, $group_id);
						}
					}
				$this->module_admin_model->module_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('modules');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('module_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function add_module()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('container', 'container', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('is_admin', 'is_admin', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Module';
				$template_path = $this->config->item('template_admin_page');
				$data['get_slideshow'] = $this->module_admin_model->get_slideshow();
				$data['groups'] = $this->module_admin_model->get_groups();
				if(!isset($_POST['name']))
					{
					$this->load->view($template_path . '/module_admin/add_module', $data);
					}
				else
					{
					$data['page'] = $template_path . '/module_admin/add_module';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->module_admin_model->module_insert();
				$module_id = $this->db->insert_id();
				$w_locations = $this->widget_admin_model->get_widget_locations();
				foreach($w_locations->result() as $wl)
					{
					$loc = $wl->id;
						
					if($this->input->post($wl->name) == '0')
						{
						$this->widget_admin_model->delete_module_exist($loc, $module_id);
						}
					else
						{
						$group_id = $_POST[$wl->name];
						$this->widget_admin_model->delete_module_exist($loc, $module_id);
						$this->widget_admin_model->insert_module_widgets($loc, $module_id, $group_id);
						}
					}
				$this->load->dbutil();
				$this->dbutil->optimize_table('modules');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('module_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_module()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->module_admin_model->module_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('module_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	}