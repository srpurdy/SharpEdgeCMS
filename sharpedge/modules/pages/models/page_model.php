<?php

class Page_model extends CI_Model 
	{
    function Page_model()
		{     
		parent::__construct();
		}

	#Gets the page from uri segment 3 (pages/view/(segment3)/
	function page_section($pagetitle)
		{
		$page = $this->db
			->select('
				id,
				name,
				url_name,
				text,
				container_name,
				lang,
				side_top,
				slide_id,
				side_bottom,
				content_top,
				content_bottom,
				meta_desc,
				meta_keywords,
				hide
			')
			->where('url_name', $pagetitle)
			->where('lang', $this->config->item('language_abbr'))
			->get('pages');
		return $page;
		}

	#Gets the Page Name
	function page_heading()
		{
		
		if($this->config->item('short_url') == 1)
			{
			$seg = $this->uri->segment(1);
			}
		else
			{
			$seg = $this->uri->segment(3);
			}
			
		$get_heading = $this->db->select('name')->where('url_name', $seg)->where('lang', $this->config->item('language_abbr'))->get('pages');
		$set_heading = $get_heading->row();
		$page_heading = $set_heading->name;
		return $page_heading;
		}

	#Get Page widgets
	function get_page_widgets($set_id)
		{
		$widget_group = $this->db
		->where('widget_group_items.group_id', $set_id)
		->where('widgets.lang', $this->config->item('language_abbr'))
		->where('widget_group_items.widget_id = widgets.id')
		->select('
			widgets.id,
			widgets.name,
			widgets.mode,
			widgets.system_name,
			widgets.bbcode,
			widgets.lang,
			widget_groups.id,
			widget_group_items.group_id,
			widget_group_items.widget_id,
			widget_group_items.sort_id
		')
		->from('widgets,widget_groups')
		->join('widget_group_items', 'widget_group_items.group_id = widget_groups.id')
		->order_by('widget_group_items.sort_id', 'asc')
		->get();
		return $widget_group;
		}
	}
?>