<?php
###################################################################
##
##	Template Editor Module
##	Version: 1.20
##
##	Last Edit:
##	Nov 26 2012
##
##	Description:
##	Add Layouts
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	removed old template editing options for security reasons.
##
##################################################################
class Template extends ADMIN_Controller
	{
	
	function Template()
		{
		parent::__construct();
		#HELPERS
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('directory');
		$this->load->helper('file');
		
		#LIBRARY'S
		$this->load->library('image_lib');
		$this->load->library('ion_auth');
		$this->load->library('session');
		
		#LANG
		$this->lang->load('ion_auth');
		
		#MODELS
		$this->load->model('template_model');
	
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
		redirect('template/manage_containers');
		}
	
	function manage_containers()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = "Manage Site Containers";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['get_containers'] = $this->template_model->get_containers();
			$data['page'] = $data['template_path'] . '/template/manage_containers';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function addcontainer()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['container_name']))
					{
					redirect('template/#tabs-2');
					}
				else
					{
					$data['heading'] = 'Add Container';
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'addcontainer';
					$this->load->view($data['template_path'] . '/template/addcontainer', $data);
					}
				}
			else
				{
				$this->template_model->container_insert();
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('/template/manage_containers');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function editcontainer()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE)
				{
				$data['heading']= 'Edit Container';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->template_model->container_edit();
				$data['page'] = $data['template_path'] . '/template/editcontainer';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->template_model->container_update();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('/template/manage_containers');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function deletecontainer()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->template_model->container_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('/template/manage_containers');
			}
		else
			{
			echo "access denied";
			}
		}
	}