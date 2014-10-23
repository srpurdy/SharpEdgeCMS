<?php

class News_Module extends widget
{
	function run_widget()
		{
		$this->load->library('pagination');
		$this->load->config('blog_config');
		
		if($this->config->item('short_url') == 1)
			{
			if($this->router->fetch_class() == 'main')
				{
				$config['base_url'] = site_url(). '/' . $this->config->item('homepage_string') . '/';
				$config['uri_segment'] = '2';
				}
			$config['base_url'] = site_url(). '/' . $this->uri->segment(1) . '/';
			$config['uri_segment'] = '2';
			}
		else
			{
			if($this->router->fetch_class() == 'main')
				{
				$config['base_url'] = site_url(). '/pages/view/' . $this->config->item('homepage_string') . '/';
				$config['uri_segment'] = '4';
				}
			$config['base_url'] = site_url(). '/pages/view/' . $this->uri->segment(3) . '/';
			$config['uri_segment'] = '4';
			}
			
		$config['per_page'] = $this->config->item('blog_per_page');
		$config['num_links'] = '4';
		$config['cur_tag_open'] = '<a class="disabled" href="#">';
		$config['cur_tag_close'] = '</a>';
		
		if($this->config->item('short_url') == 1)
			{
			$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment(2));
			$bid = 0;
			if($data['news_widget']->result())
				{
				foreach($data['news_widget']->result() as $nw)
					{
					//We got a result
					$blog_id[$bid] = $nw->blog_id;
					$bid++;
					}
				}
			else
				{
				$blog_id[$bid] = '0';
				}
			$news_tags = $this->frontend_model->get_news_tags($blog_id);
			$tid = 0;
			if($news_tags)
				{
				for($tid = 0; $tid <= count($news_tags) -1; $tid++)
					{
					$data['tags'][$tid] = $news_tags[$tid];
					}
				}
			else
				{
				$tid = 0;
				$data['tags'][$tid] = '';
				}
			}
		else
			{
			$data['news_widget'] = $this->frontend_model->get_blogposts($config['per_page'],$this->uri->segment(4));
			$bid = 0;
			if($data['news_widget']->result())
				{
				foreach($data['news_widget']->result() as $nw)
					{
					//We got a result
					$blog_id[$bid] = $nw->blog_id;
					$bid++;
					}
				}
			else
				{
				$blog_id[$bid] = '0';
				}
			$news_tags = $this->frontend_model->get_news_tags($blog_id);
			$tid = 0;
			if($news_tags)
				{
				for($tid = 0; $tid <= count($news_tags) -1; $tid++)
					{
					$data['tags'][$tid] = $news_tags[$tid];
					}
				}
			else
				{
				$tid = 0;
				$data['tags'][$tid] = '';
				}
			}
		
		$count_posts = $this->frontend_model->count_results();
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
		$config['total_rows'] =  count($count_posts->result());
		$this->pagination->initialize($config);
		$this->render($template_path . '/widget_views/news_module', $data);
		}
}