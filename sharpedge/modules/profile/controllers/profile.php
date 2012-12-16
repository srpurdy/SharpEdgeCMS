<?php
###################################################################
##
##	Main Profile Controller
##	Version: 1.00
##
##	Last Edit
##	Sept 25 2012
##
##	Description:
##	Main Module For Forum Display
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################

class Profile extends MY_Controller
	{

	function Profile()
		{
		parent::__construct();
		//Configs
		$this->load->config('avatar_config');
		
		//Helpers
		$this->load->helper('smiley');
		}
		
	function edit_profile()
		{
		$this->form_validation->set_message('required', 'The Field %s is Required');
		$this->form_validation->set_rules('website', 'website', 'xss_clean');
		$this->form_validation->set_rules('location', 'location', 'xss_clean');
		$this->form_validation->set_rules('occupation', 'occupation', 'xss_clean');
		$this->form_validation->set_rules('intrests', 'intrests', 'xss_clean');
		$this->form_validation->set_rules('signature', 'signature', 'xss_clean');
		$this->form_validation->set_rules('nickname', 'nickname', 'xss_clean|callback_check_nickname');
		$this->form_validation->set_rules('display_name', 'display_name', 'xss_clean|callback_display_name');
		$this->form_validation->set_error_delimiters('<h5>', '</h5>');
		if($this->form_validation->run($this) == FALSE)
			{
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['get_forum_profile'] = $this->frontend_model->edit_forum_profile();
			
			if($this->input->post('display_name') == '')
				{
				$data['page'] = $data['template_path'] . '/profile/edit_profile';
				$this->load->view($data['page'], $data);
				}
			else
				{
				$data['heading'] = 'Edit Profile';
				$data['page'] = $data['template_path'] . '/profile/edit_profile';
				$this->load->vars($data);
				$this->load->view($this->_container_ctrl);
				}
			}
		else
			{
			$this->frontend_model->update_forum_profile();
			$this->load->dbutil();
			$this->dbutil->optimize_table('profile_fields');
			redirect('auth/edit_profile/');
			}
		}
		
	function display_name($display_name)
		{
		if($this->input->post('display_name') == 'Y' AND $this->input->post('nickname') == '')
			{
			$this->form_validation->set_message('display_name', 'The nickname field needs to be filled before turning on display nickname.');
			return FALSE;
			}
		else
			{
			return TRUE;
			}
		}
		
	function check_nickname($nickname)
		{
		$this->db->where('nickname', $nickname);
		$nick = $this->db->get('profile_fields');
		
		foreach($nick->result() as $n)
			{
			if($n->user_id == $this->session->userdata('user_id'))
				{
				$name = '';
				}
			else
				{
				$name = $n->nickname;
				}
			}
		if ($nickname != '')
			{
			if (@strcasecmp($nickname, $name) == 0)
				{
				$this->form_validation->set_message('check_nickname', 'That name is already taken. Try a different name');
				return FALSE;
				}
			else
				{
				return TRUE;
				}
			}
		return TRUE;
		}

		
	function edit_avatar()
		{
		#Upload file
		$config['upload_path'] = $this->config->item('ava_upload_directory');
		$config['allowed_types'] = $this->config->item('ava_allow_file_types');
		$config['max_size']	= $this->config->item('ava_max_file_size');
		$config['max_width']  = $this->config->item('ava_max_width');
		$config['max_height']  = $this->config->item('ava_max_height');
		$this->load->library('upload', $config);
		$avatar = 'avatar';
		if(!$this->upload->do_upload($avatar))
			{
			$error = array('error' => $this->upload->display_errors());
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$template_path = $this->config->item('template_mobile_page');
				}
			else
				{
				$template_path = $this->config->item('template_page');
				}
			$this->load->view($template_path . '/profile/avatar_error', $error);
			}
		else
			{
			$data = array('upload_data' => $this->upload->data());
			$avatar = $data['upload_data']['file_name'];
			$this->frontend_model->upload_avatar($avatar);
			$this->load->dbutil();
			$this->dbutil->optimize_table('profile_fields');
			redirect('auth/edit_profile');
			}
		}
		
	function edit_preferences()
		{
		$this->form_validation->set_message('required', 'The Field %s is Required');
		$this->form_validation->set_rules('timezone', 'website', 'xss_clean');
		$this->form_validation->set_rules('daylight_savings', 'location', 'xss_clean');
		$this->form_validation->set_error_delimiters('<h5>', '</h5>');
		if($this->form_validation->run() == FALSE)
			{
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$template_path = $this->config->item('template_mobile_page');
				}
			else
				{
				$template_path = $this->config->item('template_page');
				}
			$data['get_forum_profile'] = $this->frontend_model->edit_forum_profile();
			$this->load->view($template_path . '/profile/edit_preferences', $data);
			}
		else
			{
			$this->frontend_model->update_preferences();
			$this->load->dbutil();
			$this->dbutil->optimize_table('profile_fields');
			redirect('auth/edit_profile#forumpreferences');
			}
		}
		
	function edit_settings()
		{
		$this->form_validation->set_message('required', 'The Field %s is Required');
		$this->form_validation->set_rules('display_signatures', 'display_signatures', 'xss_clean');
		$this->form_validation->set_rules('display_avatars', 'display_avatars', 'xss_clean');
		$this->form_validation->set_error_delimiters('<h5>', '</h5>');
		if($this->form_validation->run() == FALSE)
			{
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$template_path = $this->config->item('template_mobile_page');
				}
			else
				{
				$template_path = $this->config->item('template_page');
				}
			$data['get_forum_profile'] = $this->frontend_model->edit_forum_profile();
			$this->load->view($template_path . '/profile/edit_display_settings', $data);
			}
		else
			{
			$this->frontend_model->update_display_settings();
			$this->load->dbutil();
			$this->dbutil->optimize_table('profile_fields');
			redirect('auth/edit_profile#settings');
			}
		}
		
	function view_profile()
		{
		$data['heading'] = 'User Profile';
		$data['forum_profile'] = $this->frontend_model->forum_profile();
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$template_path = $this->config->item('template_mobile_page');
				}
			else
				{
				$template_path = $this->config->item('template_page');
				}
		$data['page'] = $template_path . '/profile/view_profile';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	}