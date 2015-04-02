<?php
###################################################################
##
##	Profile Model
##	Version: 1.00
##
##	Last Edit:
##  April 1 2015
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
class Profile_model extends CI_Model 
	{
    function Profile_model()
		{     
		parent::__construct();
		}

	function get_fields()
		{
		$this->db->order_by('sort_id', 'asc');
		$this->db->where('lang', $this->config->item('language_abbr'));
		$fields = $this->db->get('user_fields');
		return $fields;
		}
		
	function get_fields_register()
		{
		$this->db->order_by('sort_id', 'asc');
		$this->db->where('lang', $this->config->item('language_abbr'));
		$this->db->where('on_register', 'Y');
		$fields = $this->db->get('user_fields');
		return $fields->result();
		}
		
	function get_user_fields($field_id)
		{
		$fields = $this->db
			->where('custom_field_data.field_id', $field_id)
			->where('custom_field_data.user_id', $this->session->userdata('user_id'))
			->select('*')
			->from('custom_field_data')
			->get();
		return $fields;
		}
		
	function edit_forum_profile()
		{
		$edit_forum_profile = $this->db
			->where('user_id', $this->session->userdata('user_id'))
			->select('
				avatar,
				website,
				signature,
				location,
				intrests,
				occupation,
				total_posts,
				timezone,
				daylight_savings,
				display_signatures,
				display_avatars,
				display_name,
				nickname,
				comment_notify,
				admin_notify,
				post_notify
			')
			->from('profile_fields')
			->get();
		return $edit_forum_profile->result();
		}
		
	function update_forum_profile()
		{
		$profile_array = array(
			'website' => $this->input->post('website'),
			'signature' => $this->input->post('signature'),
			'location' => $this->input->post('location'),
			'intrests' => $this->input->post('intrests'),
			'occupation' => $this->input->post('occupation'),
			'display_name' => $this->input->post('display_name'),
			'nickname' => $this->input->post('nickname')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function upload_avatar()
		{
		$upload_array = array(
			'avatar' => $avatar
			);
		$this->db->set($upload_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function update_preferences()
		{
		$profile_array = array(
			'timezone' => $this->input->post('timezones'),
			'daylight_savings' => $this->input->post('daylight_savings')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function update_display_settings()
		{
		$profile_array = array(
			'display_signatures' => $this->input->post('display_signatures'),
			'display_avatars' => $this->input->post('display_avatars'),
			'comment_notify' => $this->input->post('comment_notify'),
			'admin_notify' => $this->input->post('admin_notify'),
			'post_notify' => $this->input->post('post_notify')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function update_custom_fields()
		{
		//Clear out existing data first
		$this->db->delete('custom_field_data', array('user_id' => $this->session->userdata('user_id')));
		
		//Custom Fields
		$get_fields = $this->profile_model->get_fields();
		foreach($get_fields->result() as $gf)
			{
			$custom_array = array(
				'field_id' => $gf->id,
				'user_id' => $this->session->userdata('user_id'),
				'value' => $this->input->post(url_title($gf->name))
			);
			$this->db->set($custom_array);
			$this->db->insert('custom_field_data');
			}
		}
		
	function forum_profile()
		{
		$edit_forum_profile = $this->db
			->where('profile_fields.user_id', $this->uri->segment(3))
			->where('users.id', $this->uri->segment(3))
			->select('
				profile_fields.avatar,
				profile_fields.website,
				profile_fields.signature,
				profile_fields.location,
				profile_fields.intrests,
				profile_fields.occupation,
				profile_fields.total_posts,
				profile_fields.timezone,
				profile_fields.daylight_savings,
				profile_fields.display_signatures,
				profile_fields.display_avatars,
				profile_fields.display_name,
				profile_fields.nickname,
				profile_fields.comment_notify,
				profile_fields.admin_notify,
				profile_fields.post_notify,
				users.first_name,
				users.last_name
			')
			->from('profile_fields,users')
			->get();
		return $edit_forum_profile->result();
		}
	}
?>