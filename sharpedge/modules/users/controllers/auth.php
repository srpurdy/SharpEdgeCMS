<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists('Controller'))
{
    class Controller extends MX_Controller {} //this is the part you forgot
}

class Auth extends MY_Controller
	{

	function __construct()
		{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->lang->load('recaptcha');
		$this->load->library('recaptcha');
		$this->load->library('mathcaptcha');
		$this->load->helper('url');
		
		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :

		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		}

	//redirect if needed, otherwise display the user list
	function index()
		{
		
		if (!$this->ion_auth->logged_in())
			{
			//redirect them to the login page
			redirect('auth/login');
			}
		elseif (!$this->ion_auth->is_admin())
			{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'));
			}
		else
			{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id);
			}
	
			
			//list the users
			$data['heading'] = "Manage Users";
			$data['users'] = $this->ion_auth->get_users_array();
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/index';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		}

	//log the user in
	function login()
		{
		$data['title'] = "Login";
		$prev_uri = $this->input->post('prev_uri');
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
			{ 
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
				{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				if($prev_uri == '/auth/login')
					{
					redirect($this->config->item('base_url'));
					}
				else
					{
					redirect($this->config->item('base_url') . $prev_uri);
					}
				}
			else
				{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			}
		else
			{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'class' => 'field',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'class' => 'field',
				'type' => 'password',
			);

			$data['heading'] = "Login";
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/login';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		}
	
	public function facebook()
		{
		$this->oauth2_login('facebook');
		}
	
	public function oauth2_login($providername)
		{
		$this->load->config('facebook_login');
		$key_data = $this->config->item($providername);
        $secret_data = $this->config->item($providername);
		$key = $key_data[0];
		$secret = $secret_data[0];
 
        $this->load->helper('url_helper');
 
        $this->load->library('oauth2');
 
        $provider = $this->oauth2->provider($providername, array('id' => $key,'secret' => $secret));
		
        if ( ! $this->input->get('code'))
			{
            // By sending no options it'll come back here
            $url = $provider->authorize();
			redirect($url);
			}
        else
			{
            // Howzit?
            try
				{
                $token = $provider->access($_GET['code']);
                $user = $provider->get_user_info($token);
                $this->saveData($providername,$token,$user);
				}
 
            catch (OAuth2_Exception $e)
				{
				show_error('That didnt work: '.$e);
				}
			}
		}
 
 
    private function saveData($providername,$token,$user)
		{
		//print_r($user);
		//StopForumSpam Check
		$this->load->library('stopforumspam');
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$email_address = array_key_exists('email',$user)? $user['email']:'';
		$info_array = array('email' => $email_address, 'ip' => $ip_address);
		$is_spam = $this->stopforumspam->is_spammer($info_array);
		if($is_spam == true)
			{
			//We Will Log These Events here, A GUI for adding these users to the SFS Database will be used.
			$this->load->model('log_model');
			$this->log_model->log_spam($email_address,$ip_address);
			redirect("auth/login");
			}
		else
			{
			$first_name = array_key_exists('first_name',$user)? $user['first_name']:null;
			$last_name = array_key_exists('last_name',$user)? $user['last_name']:null;
			$username = $user['uid'];
			$email = $email_address;

			$additional_data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'company' => '',
				'phone' => '',
			);
			
			$location = array_key_exists('location',$user)? $user['location']:null;
			$this->db->where('username', $username);
			$check_fb_user = $this->db->get('users');
			if($check_fb_user->result())
				{
				$password = '';
				if ($this->ion_auth->login_fb($username, $password, false))
					{
					redirect("/");
					}
				else
					{
					redirect('auth/login');
					}
				}
			else
				{
				$password = mt_rand(10000000, 99999999);
				$this->ion_auth->register_fb($username, $password, $email, $additional_data, $location);
				$this->ion_auth->login($username, $password, false);
				$this->load->library('email');
				$message = 'Welcome login details are: Email:' . $email . ' password:'. $password;
				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
				$this->email->to($email);
				$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Welcome');
				$this->email->message($message);
				redirect("auth/login");
				}
			}
		}

	//log the user out
	function logout()
		{	
		$data['title'] = "Logout";
		session_start();
		$_SESSION['KCFINDER'] = array();
		$_SESSION['KCFINDER']['disabled'] = true;
		session_destroy();
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth/login');
		}

	//change password
	function change_password()
		{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
			{
			redirect('auth/login');
			}
		
		//$user = $this->ion_auth->current()->row();
		//$user = $this->ion_auth->user($this->session->userdata('user_id'));

		if ($this->form_validation->run() == false)
			{
			//display the form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'class' => 'field',
				'id'   => 'old',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name' => 'new',
				'class' => 'field',
				'id'   => 'new',
				'type' => 'password',
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'class' => 'field',
				'id'   => 'new_confirm',
				'type' => 'password',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'class' => 'field',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $this->session->userdata('user_id'),
			);

			//render
			$data['heading'] = "Change Password";
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/change_password';
			$this->load->view($data['template_path'] . '/auth/change_password', $data);
			}
		else
			{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
			//if the password was successfully changed
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->logout();
			}
			else
				{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password');
				}
			}
		}

	//forgot password
	function forgot_password()
		{
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
			{
			//setup the input
			$data['email'] = array('name' => 'email',
				'class' => 'field',
				'id' => 'email',
			);
			//set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['heading'] = "Forgot Password?";
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/forgot_password';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		else
			{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
				{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login"); //we should display a confirmation page here instead of the login page
				}
			else
				{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password");
				}
			}
		}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
		{
		if (!$code)
			{
			show_404();
			}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
			{  
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

			if ($this->form_validation->run() == false)
				{
				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
					{
					$template_path = $this->config->item('template_mobile_page');
					}
				else
					{
					$template_path = $this->config->item('template_page');
					}
					
				$this->data['page'] = $template_path . '/auth/reset_password';
				$this->load->vars($this->data);
				$this->load->view($this->_container_ctrl);
				}
			else
				{
				// do we have a valid request?
				if ($user->id != $this->input->post('user_id')) 
					{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error('This form post did not pass our security checks.');

					} 
				else 
					{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{ 
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code);
					}
					}
				}
			}
		else
			{ 
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password");
			}
		}

	//activate the user
	function activate($id, $code=false)
		{
		if ($code !== false)
			{
			$activation = $this->ion_auth->activate($id, $code);
			}
		else if ($this->ion_auth->is_admin())
			{
			$activation = $this->ion_auth->activate($id);
			}

		if ($activation)
			{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/login");
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
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
			{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->user($id)->row();
			$data['template_path'] = $this->config->item('template_page');
			$this->load->view($data['template_path'] . '/auth/deactivate_user', $data);
			}
		else
			{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
				{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
					{
					show_error('This form post did not pass our security checks.');
					}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
					{
					$this->ion_auth->deactivate($id);
					}
				}

			//redirect them back to the auth page
			redirect('auth/login');
			}
		}

	//create a new user
	function create_user()
		{
		$data['title'] = "Create User";
		//validate form input
		if($this->config->item('security_register') == 'M')
			{
			$this->load->library('mathcaptcha');
			$this->mathcaptcha->init();
			$data['mq'] = $this->mathcaptcha->get_question();
			$this->form_validation->set_rules('math_captcha', 'Math CAPTCHA', 'required|callback__check_math_captcha');
			}
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		if($this->config->item('phone_enabled') == 'Y')
			{
			$this->form_validation->set_rules('phone1', 'First Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'xss_clean|min_length[4]|max_length[4]');
			}
		if($this->config->item('security_register') == 'I')
			{
			$this->form_validation->set_rules('recaptcha_response_field', 'recaptcha_response_field', 'xss_clean|required|callback_check_captcha');
			}
		if($this->config->item('company_enabled') == 'Y')
			{
			$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
			}
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		if ($this->form_validation->run($this) == true)
			{
			//StopForumSpam Check
			$this->load->library('stopforumspam');
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$email_address = $this->input->post('email');
			$location = '';
			$info_array = array('email' => $email_address, 'ip' => $ip_address);
			$is_spam = $this->stopforumspam->is_spammer($info_array);
			if($is_spam == true)
				{
				//We Will Log These Events here, A GUI for adding these users to the SFS Database will be used.
				$this->load->model('log_model');
				$this->log_model->log_spam($email_address,$ip_address);
				redirect("auth/login");
				}
			else
				{
				$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$additional_data = array('first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone1') . '-' . $this->input->post('phone2') . '-' . $this->input->post('phone3'),
				);
				$this->ion_auth->register($username, $password, $email, $additional_data, $location);
				$this->session->set_flashdata('message', "User Created");
				redirect("auth/login");
				}
			}
		else
			{ 
			//display the create user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['first_name'] = array('name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$data['last_name'] = array('name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('email'),
			);
			$data['company'] = array('name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('company'),
			);
			$data['phone1'] = array('name' => 'phone1',
				'id' => 'phone1',
				'type' => 'text',
				'class' => 'span1',
				'value' => $this->form_validation->set_value('phone1'),
			);
			$data['phone2'] = array('name' => 'phone2',
				'id' => 'phone2',
				'type' => 'text',
				'class' => 'span1',
				'value' => $this->form_validation->set_value('phone2'),
			);
			$data['phone3'] = array('name' => 'phone3',
				'id' => 'phone3',
				'type' => 'text',
				'class' => 'span1',
				'value' => $this->form_validation->set_value('phone3'),
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('password'),
			);
			$data['password_confirm'] = array('name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'class' => 'span2',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			$data['heading'] = "Register User";
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/create_user';
			$this->load->vars($data);
			if($this->config->item('security_register') == 'I')
				{
				$this->load->view($this->_container_ctrl, array('recaptcha'=>$this->recaptcha->get_html()));
				}
			else
				{
				$this->load->view($this->_container_ctrl);
				}
			}
		}
	
	function check_captcha($val)
		{
		if ($this->recaptcha->check_answer($this->input->ip_address(),$this->input->post('recaptcha_challenge_field'),$val))
			{
			return TRUE;
			}
		else
			{
			$this->form_validation->set_message('check_captcha',$this->lang->line('recaptcha_incorrect_response'));
			return FALSE;
			}
		}
		
	function _check_math_captcha($str)
		{
		if ($this->mathcaptcha->check_answer($str))
			{
			return TRUE;
			}
		else
			{
			$this->form_validation->set_message('_check_math_captcha', 'Enter a valid math captcha response.');
			return FALSE;
			}
		}
	
	function edit_profile()
		{
		if (!$this->ion_auth->logged_in())
			{
			//redirect them to the login page
			redirect('auth/login');
			}
			$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		if($this->config->item('phone_enabled') == 'Y')
			{
			$this->form_validation->set_rules('phone1', 'First Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
			$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'xss_clean|min_length[4]|max_length[4]');
			}
		if($this->config->item('company_enabled') == 'Y')
			{
			$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
			}
		if($this->form_validation->run($this) == false)
			{
			$data['heading'] = "Edit Profile";
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['page'] = $data['template_path'] . '/auth/edit_user_public';
			$data['users'] = $this->ion_auth_model->edit_get_user();
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			}
		else
			{
			$this->ion_auth_model->update_profile();
			redirect('auth/edit_profile');
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
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
			{
			return TRUE;
			}
		else
			{
			return FALSE;
			}
		}
	}