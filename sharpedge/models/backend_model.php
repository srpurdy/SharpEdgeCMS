<?php
###################################################################
##
##	Main Backend Model
##	Version: 1.02
##
##	Last Edit:
##	Sept 6 2012
##
##	Description:
##	Backend Global Database Functions, Typically used in mutiple places.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Backend_model extends CI_Model 
	{
	
	function Backend_model()
		{
		parent::__construct();
		}

	function protect_module()
		{
		if(!$this->ion_auth->is_admin())
			{
			$get_permissions = $this->get_module_permissions();
			if(!$get_permissions->result())
				{
				redirect('auth/login', 'refresh');
				}
			return $get_permissions;
			}
		}
	
	function get_module_permissions()
		{
		$i = 0;
		$user_id = $this->session->userdata('user_id');
		$get_group = $this->db
			->where('users_groups.user_id', $user_id)
			->select('users_groups.group_id')
			->from('users_groups')
			->get();
			
		foreach($get_group->result() as $gg)
			{
			$user_group[$i] = $gg->group_id;
			$i++;
			}
		
		if(!$get_group->result())
			{
			$user_group = '';
			}
			
		$module = $this->uri->segment(1);
		$permissions = $this->db
			->where('modules.name', $module)
			->where('modules.id = module_permissions.module_id')
			->where_in('module_permissions.group_id', $user_group)
			->select('
				module_permissions.read,
				module_permissions.write,
				module_permissions.delete
			')
			->from('modules,module_permissions')
			->get();
		return $permissions;
		}
	
	function get_user_group($user_id)
		{
		$user_group = $this->db
			->where('users_groups.user_id', $user_id)
			->select('*')
			->from('users_groups')
			->get();
		return $user_group;
		}
	}
?>