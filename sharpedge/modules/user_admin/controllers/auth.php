<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_admin extends ADMIN_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('users/ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
	$this->backend_model->protect_module();
	//set the flash data error message if there is one
	$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

	//list the users
	$data['heading'] = "Manage Users";
	$data['users'] = $this->ion_auth->get_users_array();
	$data['template_path'] = $this->config->item('template_admin_page');
	$data['page'] = $data['template_path'] . '/auth/index';
	$this->load->vars($data);
	$this->load->view($this->_container);
	}

	//activate the user
	function activate($id, $code=false)
	{
		$activation = $this->ion_auth->activate($id, $code);

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth");
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password");
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->get_user($id);
			$data['heading'] = "Deactivate User?";
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
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
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
			redirect('auth');
		}
	}

	//create a new user
	function create_user()
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
		{ //check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', "User Created");
			redirect("auth");
		}
		else
		{ //display the create user form
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
			$data['heading'] = "Register User";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] = $data['template_path'] . '/auth/create_user';
			$this->load->vars($data);
			$this->load->view($this->_container);
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