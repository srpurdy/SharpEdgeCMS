<?php

class Cart_Widget extends widget
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
		$data['template_path'] = $this->config->item('template_page');
		$data['cart_contents'] = $this->cart->contents();
		$data['gateways'] = $this->products_model->get_gateways();
		$this->render($template_path . '/widget_views/cart_widget_view', $data);
		}
}