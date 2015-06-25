<?php
###################################################################
##
##	Nav Admin Database Model
##	Version: 2.00
##
##	Last Edit:
##	June 25 2015
##
##	Description:
##	Menu Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Nav_admin_model extends CI_Model
	{
    function Nav_admin_model()
		{
		parent::__construct();
		}
		
	function get_menus()
		{
		$menus = $this->db
			->select('name,ref_name,menu_id')
			->from('nav')
			->order_by('name', 'asc')
			->get();
		return $menus;
		}
	
	function get_menu_items($menu_id)
		{
		$menu_items = $this->db
			->where('menu_id', $menu_id)
			->select('*')
			->from('nav_items')
			->order_by('sort_id', 'asc')
			->get();
		return $menu_items;
		}
		
	function get_current_menu($menu_id)
		{
		$menu = $this->db
			->where('menu_id', $menu_id)
			->select('menu_id, default_nav')
			->from('nav')
			->get();
		return $menu;
		}
		
	function add_menu()
		{
		$nav_new = array(
			'name' => $this->input->post('name'),
			'ref_name' => url_title($this->input->post('name')),
			'default_nav' => 'N'
		);
		$this->db->set($nav_new);
		$this->db->insert('nav');
		
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav');
		}
		
	function set_default_menu()
		{
		$get_all_navs = $this->db->get('nav');
		foreach($get_all_navs->result() as $n)
			{
			$nav = array(
					'default_nav' => 'N'
				);
			$this->db->set($nav);
			$this->db->where('menu_id', $n->menu_id);
			$this->db->update('nav');
			}
			
		$nav_default = array(
				'default_nav' => 'Y'
			);
		$this->db->set($nav_default);
		$this->db->where('menu_id', $this->uri->segment(3));
		$this->db->update('nav');
			
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav');
		}
		
	function delete_menu()
		{
		$this->db->delete('nav', array('menu_id' => $this->uri->segment(3)));
		$this->db->delete('nav_items', array('menu_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav');
		$this->dbutil->optimize_table('nav_items');
		}
		
	function add_item()
		{
		$item = array(
			'menu_id' => $this->input->post('menu_number'),
			'text' => $this->input->post('text'),
			'title' => $this->input->post('text'),
			'link' => $this->input->post('link'),
			'use_page' => $this->input->post('use_page'),
			'page_link' => $this->input->post('page_link'),
			'target' => $this->input->post('target'),
			'lang' => $this->input->post('lang'),
			'active' => $this->input->post('active')
			);
		$this->db->set($item);
		$this->db->insert('nav_items');
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav_items');
		}
		
	function insert_by_pages($page_name)
		{
		$items = array(
			'menu_id' => $this->input->post('menu_number2'),
			'text' => str_replace('-', ' ', $page_name),
			'title' => str_replace('-', ' ', $page_name),
			'link' => '',
			'use_page' => 'Y',
			'page_link' => '/pages/view/'.$page_name,
			'target' => '_self',
			'lang' => 'en',
			'active' => 'Y'
			);
		$this->db->set($items);
		$this->db->insert('nav_items');
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav_items');
		}
		
	function edit_item($id)
		{
		$menu_item = $this->db
			->where('id', $id)
			->select('*')
			->from('nav_items')
			->get();
		return $menu_item;
		}
		
	function update_item()
		{
		$item = array(
			'text' => $this->input->post('text'),
			'title' => $this->input->post('text'),
			'link' => $this->input->post('link'),
			'use_page' => $this->input->post('use_page'),
			'page_link' => $this->input->post('page_link'),
			'target' => $this->input->post('target'),
			'lang' => $this->input->post('lang'),
			'active' => $this->input->post('active')
			);
		$this->db->set($item);
		$this->db->where('id', $this->input->post('item_id'));
		$this->db->update('nav_items');
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav_items');
		}
		
	function delete_menu_item()
		{
		$get_children = $this->db
			->where('parent_id', $this->uri->segment(3))
			->select('id,parent_id,child_id')
			->from('nav_items')
			->get();
		
		foreach($get_children->result() as $gc)
			{
			$get_babies = $this->db
				->where('parent_id', $gc->id)
				->select('id,parent_id,child_id')
				->from('nav_items')
				->get();
				
			foreach($get_babies->result() as $gb)
				{
				$get_babies2 = $this->db
					->where('parent_id', $gb->id)
					->select('id,parent_id,child_id')
					->from('nav_items')
					->get();
					
				foreach($get_babies2->result() as $gb2)
					{
					$this->db->delete('nav_items', array('id' => $gb2->id));
					}
				
				$this->db->delete('nav_items', array('id' => $gb->id));
				}
			
			$this->db->delete('nav_items', array('id' => $gc->id));
			}
			
		$this->db->delete('nav_items', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav_items');
		}
		
	function update_sort_item($item_id, $sort_id, $parent_id, $has_child, $has_sub_child, $child_id)
		{
		$array = array(
			'sort_id' => $sort_id,
			'parent_id' => $parent_id,
			'child_id' => $child_id,
			'has_child' => $has_child,
			'has_sub_child' => $has_sub_child
			);
		$this->db->set($array);
		$this->db->where('id', $item_id);
		$this->db->update('nav_items');
		$this->load->dbutil();
		$this->dbutil->optimize_table('nav_items');
		}
		
	function get_pages()
		{
		$pages = $this->db
			->select('id, name, url_name')
			->from('pages')
			->order_by('name', 'asc')
			->get();
		return $pages;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	}
?>