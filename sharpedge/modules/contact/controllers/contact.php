<?php
###################################################################
##
##	Contact Module
##	Version: 1.13
##
##	Last Edit:
##  June 30 2015
##
##	Description:
##	Contact Form Frontend System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Contact extends MY_Controller
	{

	function Contact()
		{
		parent::__construct();
		#Config
		$this->config->load('country');
		$this->config->load('contact_config');
		
		#Helpers
		$this->load->helper('country_helper');
		$this->load->helper('form');
		$this->load->helper('url');
		
		#Language
		$this->lang->load('recaptcha');
		
		#Library
		$this->load->library('recaptcha');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('encrypt');
		
		#Models
		$this->load->model('contact_model');
		}

	function index()
		{
		$get_fields = $this->contact_model->get_fields();
		
		#Create Form Validation
		foreach($get_fields->result() as $gf)
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
		
		#Add Form Validation Security Image
		if($this->config->item('security_image') == '1')
			{
			if($this->config->item('security_register') == 'M')
				{
				$this->load->library('mathcaptcha');
				$this->mathcaptcha->init();
				$data['mq'] = $this->mathcaptcha->get_question();
				$this->form_validation->set_rules('math_captcha', 'Math CAPTCHA', 'required|callback__check_math_captcha');
				}
				
			if($this->config->item('security_register') == 'I')
				{
				$this->form_validation->set_rules('recaptcha_response_field', 'recaptcha_response_field', 'xss_clean|required|callback_check_captcha');
				}
			}
		else
			{
			}
			
		$this->form_validation->set_message('required', 'The Field %s is Required');
		$this->form_validation->set_error_delimiters('<h5>', '</h5>');
		if ($this->form_validation->run($this) == FALSE)
			{
			$data['title'] = "All required fields must be filled in";
			$data['addresses'] = $this->contact_model->get_addresses();
			$data['fields'] = $this->contact_model->get_fields();
			$data['heading'] = "Contact Form";
			$data['template_path'] = $this->config->item('template_page');
			$data['page'] = $data['template_path'] . '/contact/contact_view';
			$this->load->vars($data);
			
			#Load Different View Depending on security image
			if($this->config->item('security_image') == '1')
				{
				$this->load->view($this->_container_ctrl, array('recaptcha'=>$this->recaptcha->get_html()));
				}
			else
				{
				$this->load->view($this->_container_ctrl);
				}
			}
		else
			{
			$data['title'] = "";
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$contact_address = $this->encrypt->decode($_REQUEST['contact_address']);
			$email_address = @$_REQUEST['Email-Address'];
			foreach($get_fields->result() as $gf)
				{
				#Fix for multiple languages
				if($gf->is_email == 'Y')
					{
					$get_email = url_title($gf->name);
					$email_address = $_REQUEST[$get_email];
					}
				else
					{
					}
				}
			$sub = $_REQUEST['subject'];
			$headers = 'From: ';
			$headers .= $email_address;
			
			foreach($get_fields->result() as $gf)
				{
				if($gf->type == 'label' OR $gf->type == 'para')
					{
					}
				else
					{
					$name = url_title($gf->name);
					$field[$name] = $_REQUEST[$name];
					}
				}
				
			$mess = $this->config->item('contact_subject');
			$mess .= "\r\n";
			
			foreach($get_fields->result() as $gf)
				{
				if($gf->type == 'label' OR $gf->type == 'para')
					{
					}
				else
					{
					$name = url_title($gf->name);
					$mess .= "$gf->name: " . $field[$name];
					$mess .= "\r\n";
					}
				}
				
			$address = $this->contact_model->get_address($contact_address);
			foreach($address->result() as $adr)
				{
				$new_address = $adr->email;
				mail($new_address, $sub, $mess, $headers);
				break;
				}
				
			if(!$address->result())
				{
				$data['heading'] = "Message Sent";
				$data['template_path'] = $this->config->item('template_page');
				$data['page'] = $data['template_path'] . '/contact/error';
				$this->load->vars($data);
				$this->load->view($this->_container_ctrl);
				}
			else
				{
				$data['heading'] = "Message Sent";
				$data['template_path'] = $this->config->item('template_page');

				$data['page'] = $data['template_path'] . '/contact/sent';
				$this->load->vars($data);
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
	}