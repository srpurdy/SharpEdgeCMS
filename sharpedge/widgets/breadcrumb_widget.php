<?php

class Breadcrumb_Widget extends widget
{
	function run_widget()
		{
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
		$menu_bread = $this->frontend_model->get_menu($this->config->item('language_abbr'));
		$active = '0';
		
		foreach($menu_bread->result() as $link)
			{
			if($link->parent_id == '0')
				{
				if($this->config->item('short_url') == 1)
					{
					$page_link = str_replace('pages/view/', '', $link->page_link);
					}
				else
					{
					$page_link = $link->page_link;
					}
					
				if(($this->config->item('language_abbr') . $page_link) == $this->config->item('language_abbr') . $this->uri->uri_string())
					{
					$active = $link->id;
					}
					
				if(($link->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string())
					{
					$active = $link->id;
					}
				}
				
			if($link->has_child == 'Y')
				{
				foreach($menu_bread->result() as $sublink)
					{
					if($sublink->parent_id == $link->id  AND $sublink->child_id == '0')
						{
						if($this->config->item('short_url') == 1)
							{
							$subpage_link = str_replace('pages/view/', '', $sublink->page_link);
							}
						else
							{
							$subpage_link = $sublink->page_link;
							}
							
						if(($this->config->item('language_abbr') . $subpage_link) == $this->config->item('language_abbr') . $this->uri->uri_string())
							{
							$active =  $sublink->parent_id . ',' . $sublink->id;
							}

						if(($sublink->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string())
							{
							$active = $sublink->parent_id . ',' . $sublink->id;
							}
							
						if($sublink->has_sub_child == 'Y')
							{
							foreach($menu_bread->result() as $sublink2)
								{
								if($sublink2->child_id == $sublink->id)
									{
									if($this->config->item('short_url') == 1)
										{
										$subpage_link2 = str_replace('pages/view/', '', $sublink2->page_link);
										}
									else
										{
										$subpage_link2 = $sublink2->page_link;
										}
										
									if(($this->config->item('language_abbr') . $subpage_link2) == $this->config->item('language_abbr') . $this->uri->uri_string())
										{
										$active = $sublink2->parent_id . ',' . $sublink2->id . ',' . $sublink2->child_id;
										}

									if(($sublink2->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string())
										{
										$active = $sublink2->parent_id . ',' . $sublink2->id . ',' . $sublink2->child_id;
										}
									}
								}
							}
						}
					}
				}
			}
		$data['breadcrumbs'] = $this->frontend_model->get_menu_breadcrumbs($active);
		
		$this->render($template_path . '/widget_views/breadcrumb_view', $data);
		}
}