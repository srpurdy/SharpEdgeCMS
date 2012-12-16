<?php

class Photo_Module extends widget
{
	function run_widget()
		{
		if($this->router->fetch_class() == 'pages')
			{
			if($this->config->item('short_url') == 1)
				{
				$data['page_info'] = $this->frontend_model->get_page_section($this->uri->segment(1));
				}
			else
				{
				$data['page_info'] = $this->frontend_model->get_page_section($this->uri->segment(3));
				}
			}
		else
			{
			$data['page_info'] = $this->frontend_model->get_ctrl_section($this->uri->segment(1));
			}
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$template_path = $this->config->item('template_mobile_page');
			}
		else
			{
			$template_path = $this->config->item('template_page');
			}
		$this->render($template_path . '/widget_views/photo_module', $data);
		}
}