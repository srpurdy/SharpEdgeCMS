<?php
###################################################################
##
##  Shopping Cart Widget
##	Version: 1.01
##
##	Last Edit:
##	Oct 28 2014
##
##	Description:
##  
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Cart_Widget extends widget
	{
	function run_widget()
		{
		$template_path = $this->config->item('template_page');
		$data['template_path'] = $this->config->item('template_page');
		$data['cart_contents'] = $this->cart->contents();
		$data['gateways'] = $this->products_model->get_gateways();
		$this->render($template_path . '/widget_views/cart_widget_view', $data);
		}
	}