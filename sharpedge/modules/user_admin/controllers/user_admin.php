<?php defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! class_exists('Controller'))
	{
    class Controller extends MX_Controller {} //this is the part you forgot
	}

class User_admin extends ADMIN_Controller
	{

	function __construct()
		{
		parent::__construct();
		$this->load->library('users/ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('profile/profile_model');
		
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
		
	private function get_all_user_groups()
		{
		//$users_groups = $this->ion_auth->get_users_groups_array();
		
		}

	//redirect if needed, otherwise display the user list
	function index()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$config['base_url'] = site_url(). '/user_admin/pages/25/';
			if($this->uri->segment(3) == '')
				{
				$config['per_page'] = '25';
				}
			else
				{
				$config['per_page'] = $this->uri->segment(3);
				}
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['count_users'] = $this->ion_auth_model->count_users();
			$config['total_rows'] = count($data['count_users']->result());
			$this->pagination->initialize($config);
			//list the users
			//$data['users'] = $this->ion_auth->users()->result();
			$data['users'] = $this->ion_auth_model->get_users($config['per_page'], $this->uri->segment(4))->result();
			$data['groups'] = $this->ion_auth_model->get_users_groups_new();

			//list the users
			$data['heading'] = $this->lang->line('manage_users');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/auth/index';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function search_users()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//list the users
			if($this->input->post('ps') == '')
				{
				$data['user_by_name'] = '';
				}
			else
				{
				if(preg_match('/\s/', $this->input->post('ps')))
					{
					$full_name = explode(' ', $this->input->post('ps'));
					$data['user_by_name'] = $this->db
						->where('first_name', $full_name[0])
						->where('last_name', $full_name[1])
						->select('*')
						->from('users')
						->get();
					}
				else
					{
					//$regex_email = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"; 
					if(filter_var($this->input->post('ps'), FILTER_VALIDATE_EMAIL))
						{
						$data['user_by_name'] = $this->db
							->where('email', $this->input->post('ps'))
							->select('*')
							->from('users')
							->get();
						}
					else
						{
						$data['user_by_name'] = $this->db
							->where('first_name', $this->input->post('ps'))
							->select('*')
							->from('users')
							->get();
						if($data['user_by_name']->result())
							{
							}
						else
							{
							$data['user_by_name'] = $this->db
								->where('last_name', $this->input->post('ps'))
								->select('*')
								->from('users')
								->get();
							}
						}
					}
				}
			$data['groups'] = $this->ion_auth_model->get_users_groups_new();
			$data['heading'] = $this->lang->line('manage_users');
			$data['template_path'] = $this->config->item('template_admin_page');
			$this->load->view($data['template_path'] . '/auth/index_search', $data);
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
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$config['base_url'] = site_url(). '/user_admin/pages/25/';
			if($this->uri->segment(3) == '')
				{
				$config['per_page'] = '25';
				}
			else
				{
				$config['per_page'] = $this->uri->segment(3);
				}
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['count_users'] = $this->ion_auth_model->count_users();
			$config['total_rows'] = count($data['count_users']->result());
			$this->pagination->initialize($config);
			//list the users
			//$data['users'] = $this->ion_auth->users()->result();
			$data['users'] = $this->ion_auth_model->get_users($config['per_page'], $this->uri->segment(4))->result();
			$data['groups'] = $this->ion_auth_model->get_users_groups_new();
			//list the users
			$data['heading'] = $this->lang->line('manage_users');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/auth/index';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function edit_user()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->form_validation->set_rules('email', 'email', 'required|xss_clean');
			$this->form_validation->set_rules('first_name', 'first_name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'last_name', 'required|xss_clean');
			$this->form_validation->set_rules('company', 'company', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'phone', 'required|xss_clean');
			if($this->form_validation->run() == FALSE)
				{
				$data['users'] = $this->ion_auth->admin_get_user($this->uri->segment(3));
				$data['heading'] = $this->lang->line('label_edit_user');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/auth/edit_user';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				// This should be moved to a model
				$array = array(
				'id' => $this->uri->segment(3),
				'email' => $this->input->post('email'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone')
				);
				$this->db->set($array);
				$this->db->where('id', $this->uri->segment(3));
				$this->db->update('users');
				redirect('user_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function add_to_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->form_validation->set_rules('group_id', 'group_id', 'required|xss_clean');
			$this->form_validation->set_rules('user_id', 'user_id', 'required|xss_clean');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['group_id']))
					{
					redirect('user_admin/#tabs-5');
					}
				else
					{
					$data['heading'] = $this->lang->line('label_add_to_group');
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['users'] = $this->ion_auth->users('','')->result();
					$data['groups'] = $this->ion_auth->groups();
					$this->load->view($data['template_path'] . '/auth/add_to_group', $data);
					}
				}
			else
				{
				$group_id = $this->input->post('group_id');
				$user_id = $this->input->post('user_id');
				$data['groups'] = $this->ion_auth->add_to_group($group_id,$user_id);
				redirect('user_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function manage_groups()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = $this->lang->line('label_manage_groups');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['groups'] = $this->ion_auth->groups();
			$this->load->view($data['template_path'] . '/auth/manage_groups', $data);
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function manage_users_in_group()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = $this->lang->line('label_users_in_group');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['users_in_group'] = $this->ion_auth->users_in_group($this->uri->segment(3));
			$data['page'] = $data['template_path'] . '/auth/users_in_group';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function delete_user_in_group()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->backend_model->protect_module();
			$group_id = $this->uri->segment(3);
			$user_id = $this->uri->segment(4);
			$this->ion_auth->delete_user_in_group($group_id,$user_id);
			redirect('user_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function add_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->form_validation->set_rules('name', 'name', 'required|xss_clean');
			$this->form_validation->set_rules('description', 'description', 'required|xss_clean');
			if($this->form_validation->run() == FALSE)
				{
				if(isset($_POST['name']))
					{
					redirect('user_admin/#tabs-4');
					}
				else
					{
					$data['heading'] = $this->lang->line('label_add_group');
					$data['template_path'] = $this->config->item('template_admin_page');
					$this->load->view($data['template_path'] . '/auth/add_group', $data);
					}
				}
			else
				{
				$this->ion_auth->add_group();
				redirect('user_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	#Added By Shawn Purdy
	function edit_group()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->form_validation->set_rules('name', 'name', 'required|xss_clean');
			$this->form_validation->set_rules('description', 'description', 'required|xss_clean');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('label_edit_group');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['edit_group'] = $this->ion_auth->get_group($this->uri->segment(3));
				$data['page'] = $data['template_path'] . '/auth/edit_group';
				$this->load->vars($data);
				$this->load->view($this->_container);
				
				}
			else
				{
				$group_id = $this->input->post('id');
				$this->ion_auth->update_group($group_id);
				redirect('user_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	//activate the user
	function activate($id, $code=false)
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$activation = $this->ion_auth->activate($id, $code);

			if($activation)
				{
				//redirect them to the auth page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("user_admin");
				}
			else
				{
				//redirect them to the forgot password page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("user_admin/forgot_password");
				}
			}
		else
			{
			echo "access denied";
			}
		}

	//deactivate the user
	function deactivate($id = NULL)
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			// no funny business, force to integer
			$id = (int) $id;

			$this->load->library('form_validation');
			$this->form_validation->set_rules('confirm', 'confirmation', 'required');
			$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

			if ($this->form_validation->run() == FALSE)
				{
				$data['user'] = $this->ion_auth->user($id)->row();
				$data['heading'] = $this->lang->line('label_deactivate_user');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/auth/deactivate';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				// do we really want to deactivate?
				if ($this->input->post('confirm') == 'yes')
					{
					// do we have a valid request?
					if ($id != $this->input->post('id'))
						{
						show_404();
						}

					// do we have the right userlevel?
					if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
						{
						$this->ion_auth->deactivate($id);
						}
					}

				//redirect them back to the auth page
				redirect('user_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	//create a new user
	function create_user()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['title'] = "Create User";
			//validate form input
			$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('phone1', 'First Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'required|xss_clean|min_length[4]|max_length[4]');
			$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
			$get_fields = $this->profile_model->get_fields_register();
			$data['fields'] = $this->profile_model->get_fields_register();
			
			#Create Form Validation
			foreach($get_fields as $gf)
				{
				if($gf->type == 'input')
					{
					if($gf->is_required == 'Y')
						{
						$this->form_validation->set_rules(url_title($gf->name), url_title($gf->name), 'required|xss_clean');
						}
					else
						{
						$this->form_validation->set_rules(url_title($gf->name), url_title($gf->name), 'xss_clean');
						}
					}
				else
					{
					if($gf->is_required == 'Y')
						{
						$this->form_validation->set_rules(url_title($gf->name), url_title($gf->name), 'required|xss_clean');
						}
					else
						{
						$this->form_validation->set_rules(url_title($gf->name), url_title($gf->name), 'xss_clean');
						}
					}
				}

			if ($this->form_validation->run() == true)
				{
				$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$additional_data = array('first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone1') . '-' . $this->input->post('phone2') . '-' . $this->input->post('phone3'),
				);
				}
			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
				{
				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "User Created");
				redirect("user_admin");
				}
			else
				{ 
					//display the create user form
					//set the flash data error message if there is one
					$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

					$data['first_name'] = array('name' => 'first_name',
						'id' => 'first_name',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('first_name'),
					);
					$data['last_name'] = array('name' => 'last_name',
						'id' => 'last_name',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('last_name'),
					);
					$data['email'] = array('name' => 'email',
						'id' => 'email',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('email'),
					);
					$data['company'] = array('name' => 'company',
						'id' => 'company',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('company'),
					);
					$data['phone1'] = array('name' => 'phone1',
						'id' => 'phone1',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('phone1'),
					);
					$data['phone2'] = array('name' => 'phone2',
						'id' => 'phone2',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('phone2'),
					);
					$data['phone3'] = array('name' => 'phone3',
						'id' => 'phone3',
						'type' => 'text',
						'class' => 'field',
						'value' => $this->form_validation->set_value('phone3'),
					);
					$data['password'] = array('name' => 'password',
						'id' => 'password',
						'type' => 'password',
						'class' => 'field',
						'value' => $this->form_validation->set_value('password'),
					);
					$data['password_confirm'] = array('name' => 'password_confirm',
						'id' => 'password_confirm',
						'type' => 'password',
						'class' => 'field',
						'value' => $this->form_validation->set_value('password_confirm'),
					);
					$data['heading'] = $this->lang->line('label_register');
					$data['template_path'] = $this->config->item('template_admin_page');
					$data['page'] = 'auth/create_user_admin';
					$this->load->view($data['template_path'] . '/auth/create_user_admin', $data);
				}
			}
		else
			{
			echo "access denied";
			}
		}
	
	function group_module_permissions()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('read', 'read', 'xss_clean');
			$this->form_validation->set_rules('write', 'write', 'xss_clean');
			$this->form_validation->set_rules('delete', 'delete', 'xss_clean');
			$this->form_validation->set_rules('module_id', 'module_id', 'xss_clean');
			$this->form_validation->set_rules('group_id', 'group_id', 'xss_clean');
			if ($this->form_validation->run() == false)
				{
				$data['heading'] = $this->lang->line('label_group_permissions');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['modules'] = $this->ion_auth->get_modules();
				$data['page'] = $data['template_path'] . '/auth/group_modules';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->ion_auth->update_group_permissions();
				redirect('user_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function ban_user()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$ban_array = array(
				'user_id' => $this->uri->segment(3),
			);
			
			$this->db->set($ban_array);
			$this->db->insert('banned_users');
			$this->load->dbutil();
			$this->dbutil->optimize_table('banned_users');
			redirect('user_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function unban_user()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->db->where('user_id',  $this->uri->segment(3));
			$this->db->delete('banned_users');
			$this->load->dbutil();
			$this->dbutil->optimize_table('banned_users');
			redirect('user_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function delete_user()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			//This will delete all user information that comes with sharpedge
			$this->backend_model->delete_user($this->uri->segment(3));
			
			//call a custom function so added modules with supported user information can be deleted as well. This function is designed to be edited for custom applications
			$this->site_backend_model->delete_user_data($this->uri->segment(3));
			}
		else
			{
			echo "access denied";
			}
		}
		
	function single_user_email()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('mass_subject', 'mass_subject', 'xss_clean');
			$this->form_validation->set_rules('mass_message', 'mass_message', 'xss_clean');
			if ($this->form_validation->run() == false)
				{
				$data['heading'] = $this->lang->line('label_mass_email');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/auth/single_email';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				//Generate an email list of users
				$user_emails = $this->db
				->where('users.id', $this->uri->segment(3))
				->where('profile_fields.user_id', $this->uri->segment(3))
				->select('
						profile_fields.admin_notify,
						users.email
				')
				->from('profile_fields,users')
				->group_by('users.email')
				->get();
				$mails = array();
				$i = 0;
				
				foreach($user_emails->result() as $ue)
					{
					$mails[$i] = $ue->email;
					$notify[$i] = $ue->admin_notify;
					$i++;
					}
					
				for($i2 = 0; $i2 <= count($mails) -1; $i2++)
					{
					if($mails[$i2] == '')
						{
						}
					else
						{
						if($notify[$i2] == 'Y')
							{
							$this->load->library('email');
							$this->email->from($this->config->item('contact_email'));
							$this->email->to($mails[$i2]);
							$this->email->subject($this->input->post('mass_subject'));
							$this->email->message($this->input->post('mass_message'));
							$this->email->send();
							print_r($mails);
							}
						}
					}
				redirect('user_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function mass_email()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_rules('mass_subject', 'mass_subject', 'xss_clean');
			$this->form_validation->set_rules('mass_message', 'mass_message', 'xss_clean');
			if ($this->form_validation->run() == false)
				{
				$data['heading'] = $this->lang->line('label_mass_email');
				$data['template_path'] = $this->config->item('template_admin_page');
				$this->load->view($data['template_path'] . '/auth/mass_email', $data);
				}
			else
				{
				//Generate an email list of users
				//$user_emails = $this->db->get('users');
				$user_emails = $this->db
				->where('users.id = profile_fields.user_id')
				->select('
						profile_fields.admin_notify,
						users.email
				')
				->from('profile_fields,users')
				->group_by('users.email')
				->get();
				$mails = array();
				$i = 0;
				
				foreach($user_emails->result() as $ue)
					{
					$mails[$i] = $ue->email;
					$notify[$i] = $ue->admin_notify;
					$i++;
					}
					
				for($i2 = 0; $i2 <= count($mails) -1; $i2++)
					{
					if($mails[$i2] == '')
						{
						}
					else
						{
						if($notify[$i2] == 'Y')
							{
							$this->load->library('email');
							$this->email->from($this->config->item('contact_email'));
							$this->email->to($mails[$i2]);
							$this->email->subject($this->input->post('mass_subject'));
							$this->email->message($this->input->post('mass_message'));
							$this->email->send();
							}
						}
					}
				redirect('user_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function _get_csrf_nonce()
		{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
		}

	function _valid_csrf_nonce()
		{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
			{
			return TRUE;
			}
		else
			{
			return FALSE;
			}
		}
	}