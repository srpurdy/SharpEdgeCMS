<?php
###################################################################
##
##	Nav Admin Module
##	Version: 2.00
##
##	Last Edit:
##	June 25 2015
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
class Nav_admin extends ADMIN_Controller
	{	
    function Nav_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('form');
		$this->load->helper('directory');
		
		#Models
		$this->load->model('nav_admin_model');
	
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
			$data['heading'] = $this->lang->line('manage_nav');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['langs'] = $this->nav_admin_model->get_langs();
			$data['pages'] = $this->nav_admin_model->get_pages();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$data['page'] = $data['template_path'] . '/nav_admin/nav_dashboard';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function manage_menus()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['menus'] = $this->nav_admin_model->get_menus();
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/nav_admin/list_menus', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_menu()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				redirect('nav_admin');
				}
			else
				{
				$this->nav_admin_model->add_menu();
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('nav_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function set_as_default()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->nav_admin_model->set_default_menu();
			$msg = $this->lang->line('updated');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('nav_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function delete_menu()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->nav_admin_model->delete_menu();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('nav_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function manage_menu_items()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$selected_menu = $this->input->post('menu_id');
			$data['menu_items'] = $this->nav_admin_model->get_menu_items($selected_menu);
			$data['current_menu'] = $this->nav_admin_model->get_current_menu($selected_menu);
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/nav_admin/list_menu_items', $data);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_menu_item()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('link', 'link', 'xss_clean');
			$this->form_validation->set_rules('use_page', 'use_page', 'xss_clean');
			$this->form_validation->set_rules('page_link', 'page_link', 'xss_clean');
			$this->form_validation->set_rules('target', 'target', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['langs'] = $this->nav_admin_model->get_langs();
				$data['pages'] = $this->nav_admin_model->get_pages();
				$template_path = $this->config->item('template_admin_page');
				$this->load->view($template_path . '/nav_admin/add_menu_item', $data);
				}
			else
				{
				$this->nav_admin_model->add_item();
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('nav_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function add_items_by_page()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('pages', 'pages', 'requried|xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				redirect('nav_admin');
				}
			else
				{
				for($i = 0; $i <= count($this->input->post('pages')) -1; $i++)
					{
					$this->nav_admin_model->insert_by_pages($_POST['pages'][$i]);
					}
				redirect('nav_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function edit_menu_item()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('link', 'link', 'xss_clean');
			$this->form_validation->set_rules('use_page', 'use_page', 'xss_clean');
			$this->form_validation->set_rules('page_link', 'page_link', 'xss_clean');
			$this->form_validation->set_rules('target', 'target', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['edit_menu_item'] = $this->nav_admin_model->edit_item($this->input->post('item_id'));
				$data['langs'] = $this->nav_admin_model->get_langs();
				$data['pages'] = $this->nav_admin_model->get_pages();
				$template_path = $this->config->item('template_admin_page');
				$this->load->view($template_path . '/nav_admin/edit_menu_item', $data);
				}
			else
				{
				$this->nav_admin_model->update_item();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('nav_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function delete_menu_item()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->nav_admin_model->delete_menu_item();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('nav_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function save_items()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$json_menu = $this->input->post('json_menu_data');
			$decoded_menu = json_decode($json_menu, true);
			//echo "<pre>";
			//print_r($decoded_menu);
			//echo "</pre>";
			$sort_number = 0;
			$sort_number_b = 0;
			$sort_number_c = 0;
			$sort_number_d = 0;
			$has_child = 'N';
			$has_child_b = 'N';
			$has_child_c = 'N';
			$has_child_d = 'N';
			$has_sub_child_d = 'N';
			for($i = 0; $i < count($decoded_menu);)
				{
				$sub_items1 = count($decoded_menu[$i]['children']);
				for($s = 0; $s < count($decoded_menu[$i]['children']);)
					{
					$sub_items2 = count($decoded_menu[$i]['children'][$s]['children']);
					for($s2 = 0; $s2 < count($decoded_menu[$i]['children'][$s]['children']);)
						{
						$sub_items3 = count($decoded_menu[$i]['children'][$s]['children'][$s2]['children']);
						for($s3 = 0; $s3 < count($decoded_menu[$i]['children'][$s]['children'][$s2]['children']);)
							{
							//$sub_items3 = count($decoded_menu[$i]['children'][$s]['children'][$s2]['children']);
							$parent_id_d = $decoded_menu[$i]['children'][$s]['children'][$s2]['id'];
							$child_id_d = $decoded_menu[$i]['children'][$s]['children'][$s2]['id'];
							$this->nav_admin_model->update_sort_item($decoded_menu[$i]['children'][$s]['children'][$s2]['children'][$s3]['id'], $sort_number_d,$parent_id_d, $has_child_d, $has_sub_child_d,$child_id_d);
							$sort_number_d += 100;
							$s3++;
							}
							
						if(count($decoded_menu[$i]['children'][$s]['children'][$s2]['children']) > 0)
							{
							$has_child_c = 'Y';
							$has_sub_child_c = 'Y';
							}
						else
							{
							$has_child_c = 'N';
							$has_sub_child_c = 'N';
							}
							
						$parent_id_c = $decoded_menu[$i]['children'][$s]['id'];
						$child_id_c = $decoded_menu[$i]['children'][$s]['id'];
						$this->nav_admin_model->update_sort_item($decoded_menu[$i]['children'][$s]['children'][$s2]['id'], $sort_number_c,$parent_id_c, $has_child_c, $has_sub_child_c,$child_id_c);
						$sort_number_c += 100;
						$s2++;
						}
					
					if(count($decoded_menu[$i]['children'][$s]['children']) > 0)
						{
						$has_child_b = 'Y';
						$has_sub_child_b = 'Y';
						}
					else
						{
						$has_child_b = 'N';
						$has_sub_child_b = 'N';
						}	
						
					$parent_id_b = $decoded_menu[$i]['id'];
					$child_id_b = 0;
					$this->nav_admin_model->update_sort_item($decoded_menu[$i]['children'][$s]['id'], $sort_number_b, $parent_id_b, $has_child_b, $has_sub_child_b, $child_id_b);
					$sort_number_b += 100;
					$s++;
					}
					
				if(count($decoded_menu[$i]['children']) > 0)
					{
					$has_child = 'Y';
					$has_sub_child = 'N';
					}
				else
					{
					$has_child = 'N';
					$has_sub_child = 'N';
					}
					
				$parent_id = 0;
				$child_id = 0;
				$this->nav_admin_model->update_sort_item($decoded_menu[$i]['id'], $sort_number, $parent_id, $has_child, $has_sub_child, $child_id);
				$sort_number += 100;
				$i++;
				}
			//echo $sub_items1 . ' ' . $sub_items2 . ' ' . $sub_items3;
			}
		else
			{
			echo "access denied";
			}
		}
	}