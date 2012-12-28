<?php
###################################################################
##
##	Widget Admin Module
##	Version: 1.07
##
##	Last Edit:
##	Dec 28 2012
##
##	Description:
##	Widget Control System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Widget_admin extends ADMIN_Controller
	{
    function Widget_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('directory');
		$this->load->helper('file');
		
		#Models
		$this->load->model('widget_admin_model');
		
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
			$data['heading'] = 'Manage Widgets';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->widget_admin_model->widget_index();
			$data['page'] = $data['template_path'] . '/widget_admin/widgets';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

    function editwidget()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('system_name', 'system_name', 'xss_clean');
			$this->form_validation->set_rules('mode', 'mode', 'xss_clean');
			$this->form_validation->set_rules('bbcode', 'bbocde', '');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading']='Edit Widget';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->widget_admin_model->widget_edit();
				$data['get_assets'] = directory_map('./assets/images/uploads/');
				$data['langs'] = $this->widget_admin_model->get_langs();
				$data['page'] = $data['template_path'] . '/widget_admin/editwidget';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				//Update Relation information for pages
				
				//Update Relation information for modules
				
				$this->widget_admin_model->widget_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('widgets');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function addwidget()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('system_name', 'system_name', 'xss_clean');
			$this->form_validation->set_rules('mode', 'mode', 'xss_clean');
			$this->form_validation->set_rules('bbcode', 'bbocde', '');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Widget';
				$template_path = $this->config->item('template_admin_page');
				$data['get_assets'] = directory_map('./assets/images/uploads/');
				$data['langs'] = $this->widget_admin_model->get_langs();
				if(!isset($_POST['lang']))
					{
					$this->load->view($template_path . '/widget_admin/addwidget', $data);
					}
				else
					{
					$data['page'] = $template_path . '/widget_admin/addwidget';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->widget_admin_model->widget_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('widgets');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deletewidget()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->widget_admin_model->widget_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('widget_admin');
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
			$data['heading'] = "Manage Groups";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['sets'] = $this->widget_admin_model->get_groups();
			$this->load->view($data['template_path'] . '/widget_admin/group_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function manage_widget_groups()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = "Widgets in This Group";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['widget_group'] = $this->widget_admin_model->get_widgets_in_group();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/widget_admin/widget_group_list';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function new_widget_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "Add Group";
				$template_path = $this->config->item('template_admin_page');
				$data['w_locations'] = $this->widget_admin_model->get_widget_locations();
				$data['modules'] = $this->widget_admin_model->get_modules();
				$data['pages'] = $this->widget_admin_model->get_pages();
				if(!isset($_POST['name']))
					{
					$this->load->view($template_path . '/widget_admin/add_group', $data);
					}
				else
					{
					$data['page'] = $template_path . '/widget_admin/add_group';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->widget_admin_model->insert_group();
				$group_id = $this->db->insert_id();
				$w_locations = $this->widget_admin_model->get_widget_locations();
				foreach($w_locations->result() as $wl)
					{
					$loc = $wl->id;
					if($this->input->post('modules_' . $wl->name) == '')
						{
						}
					else
						{
						for($m = 0; $m < count($_POST['modules_' . $wl->name]); $m++)
							{
							$mod = $_POST['modules_' . $wl->name][$m];
							$this->widget_admin_model->delete_module_exist($loc, $mod);
							$this->widget_admin_model->insert_module_widgets($loc, $mod, $group_id);
							}
						}
						
					if($this->input->post('pages_' . $wl->name) == '')
						{
						}
					else
						{
						for($p = 0; $p < count($_POST['pages_' . $wl->name]); $p++)
							{
							$wpages = $_POST['pages_' . $wl->name][$p];
							$this->widget_admin_model->delete_page_exist($loc, $wpages);
							$this->widget_admin_model->insert_page_widgets($loc, $wpages, $group_id);
							}
						}
					}

				$this->load->dbutil();
				$this->dbutil->optimize_table('widget_groups');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin/#tabs-3');
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
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "Edit Group";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['edit_group'] = $this->widget_admin_model->edit_group();
				$data['w_locations'] = $this->widget_admin_model->get_widget_locations();
				$data['modules'] = $this->widget_admin_model->get_modules();
				$data['pages'] = $this->widget_admin_model->get_pages();
				$data['selected_modules'] = $this->widget_admin_model->selected_modules();
				$data['selected_pages'] = $this->widget_admin_model->selected_pages();
				$data['page'] = $data['template_path'] . '/widget_admin/edit_group';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				//Lets delete old data from the database
				$this->widget_admin_model->delete_module_widgets($this->uri->segment(3));
				$this->widget_admin_model->delete_page_widgets($this->uri->segment(3));
				$w_locations = $this->widget_admin_model->get_widget_locations();
				foreach($w_locations->result() as $wl)
					{
					$loc = $wl->id;
					if($this->input->post('modules_' . $wl->name) == '')
						{
						}
					else
						{
						for($m = 0; $m < count($_POST['modules_' . $wl->name]); $m++)
							{
							$mod = $_POST['modules_' . $wl->name][$m];
							$this->widget_admin_model->delete_module_exist($loc, $mod);
							$this->widget_admin_model->insert_module_widgets($loc, $mod, $this->uri->segment(3));
							}
						}
						
					if($this->input->post('pages_' . $wl->name) == '')
						{
						}
					else
						{
						for($p = 0; $p < count($_POST['pages_' . $wl->name]); $p++)
							{
							$wpages = $_POST['pages_' . $wl->name][$p];
							$this->widget_admin_model->delete_page_exist($loc, $wpages);
							$this->widget_admin_model->insert_page_widgets($loc, $wpages, $this->uri->segment(3));
							}
						}
					}
				$this->widget_admin_model->update_group();
				$this->load->dbutil();
				$this->dbutil->optimize_table('widget_groups');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin/#tabs-3');
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
			$this->widget_admin_model->delete_group();
			$this->db->cache_delete_all();
			$this->load->dbutil();
			$this->dbutil->optimize_table('widget_groups');
			redirect('widget_admin/#tabs-3');
			}
		else
			{
			echo "access denied";
			}
		}
	
	function add_to_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('group_id', 'group_id', 'xss_clean');
			$this->form_validation->set_rules('sort_id', 'sort_id', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "Add To Group";
				$template_path = $this->config->item('template_admin_page');
				$data['groups'] = $this->widget_admin_model->get_groups();
				$data['widgets'] = $this->widget_admin_model->get_widgets();
				if(!isset($_POST['sort_id']))
					{
					$this->load->view($template_path . '/widget_admin/add_to_group', $data);
					}
				else
					{
					$data['page'] = $template_path . '/widget_admin/add_to_group';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				$this->widget_admin_model->insert_to_group();
				$this->load->dbutil();
				$this->dbutil->optimize_table('widget_groups_items');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin/manage_widget_groups/' . $this->uri->segment(3));
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function edit_to_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('group_id', 'group_id', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "Edit To Group";
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/widget_admin/edit_to_group';
				$data['groups'] = $this->widget_admin_model->get_groups();
				$data['widgets'] = $this->widget_admin_model->get_widgets();
				$data['widget_in_group'] = $this->widget_admin_model->edit_in_group();
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->widget_admin_model->update_to_group();
				$this->load->dbutil();
				$this->dbutil->optimize_table('widget_group_items');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('widget_admin/manage_widget_groups/' . $this->uri->segment(4));
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function delete_to_group()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->widget_admin_model->delete_group_item();
			$this->db->cache_delete_all();
			$this->load->dbutil();
			$this->dbutil->optimize_table('widget_group_items');
			redirect('widget_admin/manage_widget_groups/' . $this->uri->segment(4));
			}
		else
			{
			echo "access denied";
			}
		}
	}