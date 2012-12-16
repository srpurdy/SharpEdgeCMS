<?php
###################################################################
##
##	Page Admin Database Model
##	Version: 1.12
##
##	Last Edit:
##	Dec 11 2012
##
##	Description:
##	Page Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Page_admin_model extends CI_Model 
	{
	
	function Page_admin_model()
		{
		parent::__construct();
		}

	function page_index($limit, $offset)
		{
		$page_index = $this->db
			->select('
				pages.id,
				pages.name,
				pages.url_name,
				pages.lang
			')
			->from('pages')
			->limit($limit, $offset)
			->order_by('pages.id', 'asc')
			->get();
		return $page_index;
		}
		
	function count_pages()
		{
		$count_pages = $this->db
			->select('
				pages.id
			')
			->from('
				pages
			')
			->get();
		return $count_pages;
		}

	function page_index_drafts()
		{
		$page_index_drafts = $this->db
			->select('
				page_drafts.id,
				page_drafts.name,
				page_drafts.url_name,
				page_drafts.lang
			')
			->from('page_drafts')
			->order_by('page_drafts.id', 'asc')
			->get();
		return $page_index_drafts;
		}

	function page_has_draft()
		{
		$has_draft = $this->db
			->select('
				page_drafts.url_name,
				page_drafts.lang
			')
			->from('page_drafts')
			->limit('1')
			->get();
		return $has_draft;
		}

	function draft_has_page()
		{
		$has_page = $this->db
			->select('
				pages.url_name,
				pages.lang
			')
			->from('pages')
			->limit('1')
			->get();
		return $has_page;
		}

	function page_edit()
		{
		$page_edit = $this->db->get_where('pages', array('id' => $this->uri->segment(3)));
		return $page_edit;
		}

	function page_draft_edit()
		{
		$page_draft_edit = $this->db->get_where('page_drafts', array('id' => $this->uri->segment(3)));
		return $page_draft_edit;
		}

	function page_update_draft()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('url_name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->set($array);
		$this->db->update('page_drafts');
		}

	function page_update_draft_live()
		{
		#lets update the existing live page with the new data in the draft page
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('url_name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->where('url_name', $this->input->post('url_name'));
		$this->db->where('lang', $this->input->post('lang'));
		$this->db->set($array);
		$this->db->update('pages');

		#lets now delete the old draft page.
		$this->db->delete('page_drafts', array('id' => $this->uri->segment(3)));
		}

	function page_update()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('url_name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->set($array);
		$this->db->update('pages');
		}

	function get_slideshow()
		{
		$slide = $this->db->get('slideshow_group');
		return $slide;
		}

	function page_insert()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->set($array);
		$this->db->insert('pages');
		}

	function page_insert_draft()
		{
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->set($array);
		$this->db->insert('page_drafts');
		}

	function page_insert_draft_live()
		{
		#first lets insert the new live page via the existing draft page.
		$array = array(
			'name' => $this->input->post('name'),
			'text' => $this->input->post('text'),
			'url_name' => url_title($this->input->post('name')),
			'slide_id' => $this->input->post('slide_id'),
			'side_top' => $this->input->post('side_top'),
			'side_bottom' => $this->input->post('side_bottom'),
			'content_top' => $this->input->post('content_top'),
			'content_bottom' => $this->input->post('content_bottom'),
			'container_name' => $this->input->post('container_name'),
			'lang' => $this->input->post('lang'),
			'hide' => $this->input->post('hide'),
			'meta_desc' => $this->input->post('meta_desc'),
			'meta_keywords' => $this->input->post('meta_keywords')
		);
		$this->db->set($array);
		$this->db->insert('pages');

		#now lets delete the old draft page.
		$this->db->delete('page_drafts', array('id' => $this->uri->segment(3)));
		}

	function page_delete()
		{
		$this->db->delete('pages', array('id' => $this->uri->segment(3)));
		}

	function page_draft_delete()
		{
		$this->db->delete('page_drafts', array('id' => $this->uri->segment(3)));
		}

	function get_containers()
		{
		$contain = $this->db->get('containers');
		return $contain;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}

	function get_groups()
		{
		$groups = $this->db->get('widget_groups');
		return $groups;
		}
		
	function find_menu_item($page_name)
		{
		$menu_page = '/pages/views/' . $page_name;
		$this->db->where('page_link', $menu_page);
		$this->db->or_where('link', $menu_page);
		$find_page = $this->db->get('menu');
		return $find_page;
		}
	}
?>