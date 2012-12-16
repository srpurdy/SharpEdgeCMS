<?php

class Facebook_Widget extends widget
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
		$this->render($template_path . '/widget_views/facebook_widget_view');
		}
}