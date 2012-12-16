<?php
###################################################################
##
##	Widget Admin Database Model
##	Version: 1.02
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Widget Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Widget_admin_model extends CI_Model 
	{
	
    function Widget_admin_model()
		{
		parent::__construct();
		}

	function widget_index()
		{
		$this->db->order_by("id", "asc");
		$widget_index = $this->db->get('widgets');
		return $widget_index;
		}

	function widget_edit()
		{
		$widget_edit = $this->db->get_where('widgets', array('id' => $this->uri->segment(3)));
		return $widget_edit;
		}

	function widget_update()
		{
		$this->db->where('id', $this->uri->segment(3));
		$this->db->update('widgets', $this->db->escape($_POST));
		}

	function widget_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'mode' => $this->input->post('mode'),
			'system_name' => $this->input->post('system_name'),
			'bbcode' => $this->input->post('bbcode'),
			'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->insert('widgets', $this->db->escape($_POST));
		}

	function update_group()
		{
		$array = array(
			'name' => $this->input->post('name')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('widget_groups', $this->db->escape($_POST));
		}

	function insert_group()
		{
		$array = array(
			'name' => $this->input->post('name')
		);
		$this->db->set($array);
		$this->db->insert('widget_groups', $this->db->escape($_POST));
		}

	function insert_to_group()
		{
		$array = array(
			'group_id' => $this->input->post('group_id'),
			'widget_id' => $this->input->post('widget_id'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->insert('widget_group_items', $this->db->escape($_POST));
		}

	function update_to_group()
		{
		$array = array(
			'group_id' => $this->input->post('group_id'),
			'widget_id' => $this->input->post('widget_id'),
			'sort_id' => $this->input->post('sort_id')
		);
		$this->db->set($array);
		$this->db->where('gm_id', $this->input->post('gm_id'));
		$this->db->update('widget_group_items', $this->db->escape($_POST));
		}

	function widget_delete()
		{
		$this->db->delete('widgets', array('id' => $this->uri->segment(3)));
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function get_widgets()
		{
		$widgets = $this->db->get('widgets');
		return $widgets;
		}

	function get_groups()
		{
		$groups = $this->db->get('widget_groups');
		return $groups;
		}

	function get_widgets_in_group()
		{
		$widget_group = $this->db
		->where('widget_group_items.group_id', $this->uri->segment(3))
		->where('widget_group_items.widget_id = widgets.id')
		->select('
			widgets.name,
			widgets.id,
			widget_group_items.gm_id,
			widget_group_items.group_id,
			widget_group_items.widget_id
		')
		->from('widgets,widget_groups')
		->join('widget_group_items', 'widget_group_items.group_id = widget_groups.id')
		->get();
		return $widget_group;
		}

	function edit_group()
		{
		$this->db->where('id', $this->uri->segment(3));
		$edit_set = $this->db->get('widget_groups');
		return $edit_set;
		}

	function delete_group()
		{
		$this->db->delete('widget_groups', array('id' => $this->uri->segment(3)));
		}

	function edit_in_group()
		{
		$this->db->where('gm_id', $this->uri->segment(3));
		$edit_group = $this->db->get('widget_group_items');
		return $edit_group;
		}

	function delete_group_item()
		{
		$this->db->delete('widget_group_items', array('gm_id' => $this->uri->segment(3)));
		}
	}
?>