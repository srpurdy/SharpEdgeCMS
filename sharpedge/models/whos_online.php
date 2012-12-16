<?php

class Whos_online extends CI_Model 
	{
	
	function Whos_online()
		{     
		parent::__construct();
		}

	function online_users()
		{
		// we will store all our currently logged in users' names and IDs in this array.
		$online_users_full = array();
		$online_users = array();

		$total = 0;
		$total_users = 0;
		$total_visitors = 0;


		// This query requires php5. See the user guide re: database library, making queries.
		// 'ci_sessions' is the default session table name, replace with yours.
		$this->db->select('user_data');
		$query = $this->db->get('ci_sessions');

		// let's get all the logged in users' names and id numbers.
		if ( $query->num_rows() > 0)
			{
			foreach ( $query->result() as $serial_data)
				{
				$session_data = unserialize($serial_data->user_data);

				// ignore all session data that are NULL or otherwise not an array
				// and we only want session data that has an user name and user id.
				if (is_array($session_data))
					{
					if ( isset($session_data['user_id']) && isset($session_data['first_name']) && isset($session_data['last_name']) && isset($session_data['group_name']) && isset($session_data['display_name']) && isset($session_data['nickname']) )
						{
						$online_users[] = array (
							'user_id' => $session_data['user_id'],
							'first_name' => ucwords($session_data['first_name']),
							'last_name' => ucwords($session_data['last_name']),
							'display_name' => $session_data['display_name'],
							'nickname' => $session_data['nickname'],
							'group_name' => $session_data['group_name'],
						);
						++$total;
						++$total_users;
						}
					}
				else 
					{
					++$total;
					++$total_visitors;
					}
				}
			$query->free_result();
			}

		// we can send this array off to the view along with other data...
		//$view_data['online_users'] = $online_users;
		//$this->load->view('online_user_list' ,$view_data);
		$online_users_full = array(
			'users' => $online_users,
			'total' => $total,
			'total_users' => $total_users,
			'total_visitors' => $total_visitors,
		);

		return $online_users_full;
		}
	}