<?php

class News_Landing_Widget extends widget
{
   function run_widget()
   {
	$this->load->library('pagination');
	$this->load->config('blog_config');
	if($this->config->item('short_url') == 1)
		{
		$config['base_url'] = site_url(). '/' . $this->uri->segment(1) . '/';
		$uri = $this->uri->segment(1);
		}
	else
		{
		$config['base_url'] = site_url(). '/pages/view/' . $this->uri->segment(3) . '/';
		$uri = $this->uri->segment(3);
		}
	$config['per_page'] = '20';
	$config['num_links'] = '4';
	$config['cur_tag_open'] = '<a class="disabled" href="#">';
	$config['cur_tag_close'] = '</a>';
	if($this->config->item('short_url') == 1)
		{
		$config['uri_segment'] = '2';
		$data['news_widget'] = $this->frontend_model->get_blogposts_landing($config['per_page'],$this->uri->segment(2),$uri);
		}
	else
		{
		$config['uri_segment'] = '4';
		$data['news_widget'] = $this->frontend_model->get_blogposts_landing($config['per_page'],$this->uri->segment(4),$uri);
		}
	$data['featured_news'] = $this->frontend_model->get_featured_news_landing($uri);
	$count_posts = $this->frontend_model->count_results_landing($uri);
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
	$this->render($template_path . '/widget_views/news_landing_widget_view', $data);
   }       
}