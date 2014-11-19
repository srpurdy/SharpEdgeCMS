<?php
###################################################################
##
##  Login Widget
##	Version: 1.01
##
##	Last Edit:
##	Oct 28 2014
##
##	Description:
##  
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Login_Widget extends widget
	{
	function run_widget()
		{
		$this->load->config('avatar_config');
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
		$template_path = $this->config->item('template_page');
		$data['current_profile'] = $this->frontend_model->edit_forum_profile();
		$this->render($template_path . '/widget_views/login_widget', $data);
		}       
	}