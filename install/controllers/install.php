<?php
/**
 * @author 		Yorick Peterse - PyroCMS development team
 * @package		PyroCMS
 * @subpackage	Installer
 * @category	Application
 * @since 		v0.9.6.2
 *
 * Installer controller.
 */
######################################################
##	Version 2.0 - For CI 2.1.3 
##	
##	Designed For PHP 5.3+ Should be PHP 5.4 compatable.
##
##  PHP 5.2 may work but is not suggested.
##	
##  Last Updated: Nov 27 2012
##
##	SharpEdge Installer	
######################################################
class Install extends CI_Controller
	{

	function Install()
		{
		parent::__construct();
		$this->load->library('form_validation');
		#Extract Theme Information
		$data['theme'] = "install";
		$data['template'] = "/themes/" . $data['theme'] . "/container";

		#Create the Page
		$this->_container = $data['template'];
		$this->load->vars($data);
		}

	function index()
		{
		$data['heading'] = 'Install SharpEdge';
		$data['page'] = 'install_index';
		$this->load->vars($data);
		$this->load->view($this->_container);
		}

	function database_information()
		{
		#Get Database Information
		$this->session->set_userdata(array(
				'hostname' => $this->input->post('hostname'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'port' => $this->input->post('port')
				));
		
		# Validation Form
		$this->form_validation->set_rules(array(
			array(
				'field' => 'hostname',
				'label'	=> 'hostname',
				'rules'	=> 'trim|required|callback_test_connection'
			),
			array(
				'field' => 'username',
				'label'	=> 'username',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'password',
				'label'	=> 'password',
				'rules'	=> 'trim'
			),
			array(
				'field' => 'port',
				'label'	=> 'port',
				'rules'	=> 'trim|required'
			),
		));
		
		# Do Validation
		if ( $this->form_validation->run() )
			{
			$this->session->set_flashdata('message', 'Connection OK!');
			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_userdata('db_passed', TRUE);
			redirect('install/software_check');
			}
		
		$data['heading'] = 'Database Information';
		$data['page'] = 'db_info';
		$this->load->vars($data);
		$this->load->view($this->_container);
		}

	function test_connection()
		{
		if ( ! $this->sharpedge_install->test_connection() )
			{
			$this->form_validation->set_message('test_connection', 'Database Connection Failed!' . mysql_error());
			return FALSE;
			}
		else
			{
			return TRUE;
			}
		}
	
	function software_check()
		{
		// Did the user enter the DB settings ?
		if ( ! $this->session->userdata('db_passed'))
			{
			// Set the flashdata message
			$this->session->set_flashdata('message', 'Database Connection Failed!');
			$this->session->set_flashdata('message_type','failure');

			// Redirect
			redirect('');
			}
		
		$data->php_min_version	= '5.2';
		$data->php_acceptable	= $this->sharpedge_install->php_acceptable($data->php_min_version);
		$data->php_version		= $this->sharpedge_install->php_version;

		$data->mysql->server_version_acceptable = $this->sharpedge_install->mysql_acceptable('server');
		$data->mysql->client_version_acceptable = $this->sharpedge_install->mysql_acceptable('client');
		$data->mysql->server_version = $this->sharpedge_install->mysql_server_version;
		$data->mysql->client_version = $this->sharpedge_install->mysql_client_version;

		$data->gd_acceptable = $this->sharpedge_install->gd_acceptable();
		$data->gd_version = $this->sharpedge_install->gd_version;
		
		$data->step_passed = $this->sharpedge_install->check_server($data);
		$this->session->set_userdata('software_passed', $data->step_passed);
		
		$data->heading = 'Server Software';
		$data->page = 'software_check';
		$this->load->vars($data);
		$this->load->view($this->_container);
		}

	function user_info()
		{
		if ( ! $this->session->userdata('db_passed') OR ! $this->session->userdata('software_passed'))
			{
			// Redirect the user back to step 2
			redirect('install/software_check');
			}
			
		$this->form_validation->set_rules(array(
			array(
				'field' => 'database',
				'label'	=> 'Database',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'user_name',
				'label'	=> 'Username',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'user_firstname',
				'label'	=> 'First_name',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'user_lastname',
				'label'	=> 'Last_name',
				'rules'	=> 'trim|required'
			),
			array(
				'field' => 'user_email',
				'label'	=> 'Email',
				'rules'	=> 'trim|required|valid_email'
			),
			array(
				'field' => 'user_password',
				'label'	=> 'Password',
				'rules'	=> 'trim|min_length[6]|max_length[20]|required'
			),
			array(
				'field' => 'user_confirm_password',
				'label'	=> 'confirm_password',
				'rules'	=> 'trim|required|matches[user_password]|callback_attempt_install'
			)
		));
		
		if ($this->form_validation->run() == FALSE)
			{
			$data->heading = 'Final';
			$data->page = 'final';
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			$this->session->set_flashdata('message', 'You have successfully installed SharpEdge Content Management System, be sure to delete your install folder!');
			$this->session->set_flashdata('message_type','success');

			// Store the default username and password in the session data
			$this->session->set_userdata('user', array(
				'user_email'	=> $this->input->post('user_email'),
				'user_password'	=> $this->input->post('user_password'),
				'user_firstname'=> $this->input->post('user_firstname'),
				'user_lastname'	=> $this->input->post('user_lastname')
			));

			// Redirect
			redirect('install/complete');
			}
		}

	function attempt_install()
		{
		// If we do not have any validation errors so far
		if ( ! validation_errors() )
			{
			// Let's try to install the system
			$install_results = $this->sharpedge_install->install($_POST);

			// Did the install fail?
			if($install_results['status'] === FALSE)
				{
				// Let's tell them why the install failed
				$this->form_validation->set_message('attempt_install', 'Install Failed!' . $install_results['message']);
				return FALSE;
				}
			// If the install did not fail
			else
				{
				return TRUE;
				}
			}
		}

	function complete()
		{
		$data->heading = 'Complete!';
		$data->page = 'complete';
		$this->load->vars($data);
		$this->load->view($this->_container);
		}
	}
?>