<?php
###################################################################
##
##	Page Admin Module
##	Version: 1.19
##
##	Last Edit:
##	Dec 11 2012
##
##	Description:
##	Page Control System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Page_admin extends ADMIN_Controller
	{
	
    function Page_admin()
		{
		parent::__construct();
		#Helpers
		$this->load->helper('file');
		
		#Models
		$this->load->model('page_admin_model');
		
		#Libaries
		$this->load->library('table');
		$this->load->library('pagination');
		
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
			$config['base_url'] = site_url(). '/page_admin/pages/10/';
			if($this->uri->segment(3) == '')
				{
				$config['per_page'] = '10';
				}
			else
				{
				$config['per_page'] = $this->uri->segment(3);
				}
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['heading'] = 'Manage Pages';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->page_admin_model->page_index($config['per_page'], $this->uri->segment(4));
			$data['has_draft'] = $this->page_admin_model->page_has_draft();
			$data['count_pages'] = $this->page_admin_model->count_pages();
			$config['total_rows'] = count($data['count_pages']->result());
			$this->pagination->initialize($config);
			$data['page'] = $data['template_path'] . '/page_admin/pages';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function pages()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$config['base_url'] = site_url(). '/page_admin/pages/'. $this->uri->segment(3) . '/';
			$config['per_page'] = $this->uri->segment(3);
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['heading'] = 'Manage Pages';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->page_admin_model->page_index($config['per_page'], $this->uri->segment(4));
			$data['has_draft'] = $this->page_admin_model->page_has_draft();
			$data['count_pages'] = $this->page_admin_model->count_pages();
			$config['total_rows'] = count($data['count_pages']->result());
			$this->pagination->initialize($config);
			$data['page'] = $data['template_path'] . '/page_admin/pages';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

    function editpage()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean');
			$this->form_validation->set_rules('meta_desc', 'meta_desc', 'xss_clean');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('hide', 'hide', 'xss_clean');
			$this->form_validation->set_rules('draft', 'draft', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Page';
				$template_path = $this->config->item('template_admin_page');
				$data['query'] = $this->page_admin_model->page_edit();
				$data['containers'] = $this->page_admin_model->get_containers();
				$data['get_slideshow'] = $this->page_admin_model->get_slideshow();
				$data['groups'] = $this->page_admin_model->get_groups();
				$data['langs'] = $this->page_admin_model->get_langs();
				$data['page'] = $template_path . '/page_admin/editpage';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				#Check if the page will be saved as a draft or not
				if($this->input->post('draft') == 'Y')
					{
					#hidden page draft.
					$this->page_admin_model->page_insert_draft();
					$msg = $this->lang->line('updated');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('page_admin');
					}
				else
					{
					/*
					#Live Publicly viewable
					//Check old name against post data to determine if the page name is changed.
					$check_old_name = $this->page_admin_model->page_edit();
					foreach($check_old_name->result() as $on)
						{
						$page_url_name = $on->url_name;
						}
						
					//Check for menu items that link to this page
					$find_menu = $this->page_admin_model->find_menu_item($page_url_name);
					$links = 0;
					if($find_menu->result())
						{
						foreach($find_menu->result() as $fm)
							{
							$data['menu_id'][$links] = $fm->id;
							$data['menu_name'][$links] = $fm->text;
							$data['menu_url'][$links] = $fm->page_link;
							$data['menu_link'][$links] = $fm->link;
							$data['menu_use_page'][$links] = $fm->use_page;
							$links++;
							}
							
						if($page_url_name == url_title($this->input->post('name')))
							{
							$this->page_admin_model->page_update();
							$msg = $this->lang->line('updated');
							$this->session->set_flashdata('flashmsg', $msg);
							redirect('page_admin');
							}
						else
							{
							$this->page_admin_model->page_update();
							$msg = $this->lang->line('updated');
							$this->session->set_flashdata('flashmsg', $msg);
							$this->load->view($template_path.'/page_admin/update_menu', $data);
							}
						}
					*/
					$this->page_admin_model->page_update();
					$msg = $this->lang->line('updated');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('page_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	/*
	function update_menu()
		{
		$this->form_validation->set_rules('draft', 'draft', 'xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
		if($this->form_validation->run() == FALSE)
			{
			$data['heading'] = 'Update Menu';
			$template_path = $this->config->item('template_admin_page');
			$data['langs'] = $this->page_admin_model->get_langs();
			$data['page'] = $template_path . '/page_admin/update_menu';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			if($this->input->post('update_menu') == true)
				{
				$this->page_admin_model->update_menu();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('page_admin');
				}
			else
				{
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('page_admin');
				}
			}
		}
	*/

	function addpage()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean');
			$this->form_validation->set_rules('meta_desc', 'meta_desc', 'xss_clean');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('hide', 'hide', 'xss_clean');
			$this->form_validation->set_rules('draft', 'draft', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Add Page';
				$template_path = $this->config->item('template_admin_page');
				$data['containers'] = $this->page_admin_model->get_containers();
				$data['get_slideshow'] = $this->page_admin_model->get_slideshow();
				$data['groups'] = $this->page_admin_model->get_groups();
				$data['langs'] = $this->page_admin_model->get_langs();
				if(!isset($_POST['name']))
					{
					$this->load->view($template_path . '/page_admin/addpage', $data);
					}
				else
					{
					$data['page'] = $template_path . '/page_admin/addpage';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				#Check if the page will be saved as a draft or not
				if($this->input->post('draft') == 'Y')
					{
					#hidden page draft.
					$this->page_admin_model->page_insert_draft();
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('page_admin');
					}
				else
					{
					#Live Publicly viewable
					$this->page_admin_model->page_insert();
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('page_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function deletepage()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->page_admin_model->page_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('page_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	
	function delete_draft()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->page_admin_model->page_draft_delete();
			$msg = $this->lang->line('delete');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('page_admin/#tabs-3');
			}
		else
			{
			echo "access denied";
			}
		}
	
	function manage_page_drafts()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = 'Manage Page Drafts';
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['query'] = $this->page_admin_model->page_index_drafts();
			$data['has_page'] = $this->page_admin_model->draft_has_page();
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/page_admin/page_drafts', $data);
			}
		else
			{
			echo "access denied";
			}
		}
	
    function edit_draft()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'xss_clean|required');
			$this->form_validation->set_rules('container_name', 'container_name', 'xss_clean');
			$this->form_validation->set_rules('meta_desc', 'meta_desc', 'xss_clean');
			$this->form_validation->set_rules('meta_keywords', 'meta_keywords', 'xss_clean');
			$this->form_validation->set_rules('slide_id', 'slide_id', 'xss_clean');
			$this->form_validation->set_rules('side_top', 'side_top', 'xss_clean');
			$this->form_validation->set_rules('side_bottom', 'side_bottom', 'xss_clean');
			$this->form_validation->set_rules('content_top', 'content_top', 'xss_clean');
			$this->form_validation->set_rules('content_bottom', 'content_bottom', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('hide', 'hide', 'xss_clean');
			$this->form_validation->set_rules('draft', 'draft', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = 'Edit Page Draft';
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['query'] = $this->page_admin_model->page_draft_edit();
				$data['containers'] = $this->page_admin_model->get_containers();
				$data['get_slideshow'] = $this->page_admin_model->get_slideshow();
				$data['groups'] = $this->page_admin_model->get_groups();
				$data['langs'] = $this->page_admin_model->get_langs();
				$data['page'] = $data['template_path'] . '/page_admin/edit_draft';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				#Check if the page will be saved as a draft or not
				if($this->input->post('draft') == 'Y')
					{
					#hidden page draft. (update)
					$this->page_admin_model->page_update_draft();
					$msg = $this->lang->line('updated');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('page_admin/#tabs-3');
					}
				else
					{
					#lets check if the page is a new or existing page
					if($this->input->post('draft_type') == 'New')
						{
						#Lets make the page draft Live (Publicly viewable)
						#This is a brand new page. Lets insert it
						$this->page_admin_model->page_insert_draft_live();
						$msg = $this->lang->line('added');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('page_admin/#tabs-3');
						}
						else
						{
						#Lets make the page draft Live (Publicly viewable)
						#This is an existing page lets update the old one.
						$this->page_admin_model->page_update_draft_live();
						$msg = $this->lang->line('updated');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('page_admin/#tabs-3');
						}
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}
	}