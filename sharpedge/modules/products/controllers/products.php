<?php
###################################################################
##
##	Products Module
##	Version: 0.94
##
##	Last Edit:
##	Sept 25 2012
##
##	Description:
##  Products Frontend Display.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Products extends MY_Controller
	{

	function Products()
		{
		parent::MY_Controller();
		$this->load->library('cart');
		$this->load->model('products_model');
		$this->load->config('product_config');
		}

	function index()
		{
		$this->data['product_categories'] = $this->products_model->get_cat();
		$this->data['heading'] = 'Products';
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$this->data['page'] = $data['template_path'] . '/products/product_categories';
		$this->load->vars($this->data);
		$this->load->view($this->_container_ctrl);
		}
	
	function category()
		{
		$data['products'] = $this->products_model->get_products_category();
		$get_heading = $this->db->select('category_name')->where( 'url_category', $this->uri->segment(3) )->get('product_categories');
		$set_heading = $get_heading->row();
		$data['heading'] = $set_heading->category_name;
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['page'] = $data['template_path'] . '/products/products_in_category';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function details()
		{
		$data['product'] = $this->products_model->get_product($this->uri->segment(3));
		$get_heading = $this->db->select('product_name')->where( 'product_id', $this->uri->segment(3) )->get('products');
		$set_heading = $get_heading->row();
		$data['heading'] = $set_heading->product_name;
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['page'] = $data['template_path'] . '/products/product_details';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
		
	function show_cart()
		{
		$data['heading'] = 'Your Cart';
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['cart_contents'] = $this->cart->contents();
		$data['gateways'] = $this->products_model->get_gateways();
		$this->load->view($data['template_path'] . '/products/show_cart', $data);
		}
		
	function add_to_cart()
		{
		//For Debuging post data.
		//print_r($_POST);
		
		//Get the post data and extract the product id numbers.
		$selected_products = $this->input->post('product');
		//print_r($selected_products);
		if(empty($selected_products))
			{
			redirect('products');
			}
		else
			{
			//Do database query to get product information so we can populate the shopping cart.
			$the_product = $this->products_model->get_product($selected_products);
			foreach($the_product->result() as $pr)
				{
				$id = $pr->product_id;
				$qty = 1;
				$price = $pr->price;
				$name = $pr->product_name. ' - ' .url_title($pr->brand_name);
				}
			// add the selected product to the cart
			$product_data = array(
					'id' => $id,
					'qty' => $qty,
					'price' => $price,
					'name' => $name,
					'options' => array()
			);
			//print_r($product_data);
			$this->cart->insert($product_data);
			//We can now safely re-direct to the shopping cart contents.
			//redirect('products/show_cart');
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['cart_contents'] = $this->cart->contents();
			$data['gateways'] = $this->products_model->get_gateways();
			$this->load->view($data['template_path'] . '/products/show_cart', $data);
			}
		}
		
	function add_to_cart_view()
		{
		//For Debuging post data.
		//print_r($_POST);
		
		//Get the post data and extract the product id numbers.
		$selected_products = $this->input->post('product');
		//print_r($selected_products);
		if(empty($selected_products))
			{
			redirect('products');
			}
		else
			{
			//Do database query to get product information so we can populate the shopping cart.
			$the_product = $this->products_model->get_product($selected_products);
			foreach($the_product->result() as $pr)
				{
				$id = $pr->product_id;
				$qty = 1;
				$price = $pr->price;
				$name = $pr->product_name. ' - ' .url_title($pr->brand_name);
				}
			// add the selected product to the cart
			$product_data = array(
					'id' => $id,
					'qty' => $qty,
					'price' => $price,
					'name' => $name,
					'options' => array()
			);
			//print_r($product_data);
			$this->cart->insert($product_data);
			//We can now safely re-direct to the shopping cart contents.
			//redirect('products/show_cart');
			if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
				{
				$data['template_path'] = $this->config->item('template_mobile_page');
				}
			else
				{
				$data['template_path'] = $this->config->item('template_page');
				}
			$data['cart_contents'] = $this->cart->contents();
			$data['gateways'] = $this->products_model->get_gateways();
			$data['page'] = $data['template_path'] . '/products/show_cart_view';
			$this->load->vars($data);
			$this->load->view($this->_container_ctrl);
			//$this->load->view($data['template_path'] . '/products/show_cart', $data);
			}
		}
	
	function updatecart()
		{
		//We will update the total items in the cart.
		$total = $this->cart->total_items();
		//echo $_POST['rowid'];
		for ($i = 0; $i <= $total; $i++)
			{
			$data = array(
					'rowid' => @$_POST['rowid'][$i],
					'qty' => @$_POST['qty'][$i]
			);
			$this->cart->update($data);
			}
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['cart_contents'] = $this->cart->contents();
		$data['gateways'] = $this->products_model->get_gateways();
		$this->load->view($data['template_path'] . '/products/show_cart', $data);
		}
		
	function updatecart_view()
		{
		//We will update the total items in the cart.
		$total = $this->cart->total_items();
		//echo $_POST['rowid'];
		for ($i = 0; $i <= $total; $i++)
			{
			$data = array(
					'rowid' => @$_POST['rowid'][$i],
					'qty' => @$_POST['qty'][$i]
			);
			$this->cart->update($data);
			}
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['cart_contents'] = $this->cart->contents();
		$data['gateways'] = $this->products_model->get_gateways();
		$data['page'] = $data['template_path'] . '/products/show_cart_view';
		$this->load->vars($data);
		$this->load->view($this->_container_ctrl);
		}
	
	function place_order()
		{
		$amount = $this->cart->format_number($this->cart->total());
		$gateway = $this->input->post('gateway_selected');
		redirect($gateway . '/place_order/' . str_replace('.', '-', $amount));
		}
		
	function ajax_gallery()
		{
		$gallery_name = $this->products_model->gallery_name();
		foreach($gallery_name->result() as $gn)
			{
			$data['heading'] = $gn->name;
			}
		if($this->agent->is_mobile() AND $this->config->item('mobile_support') == true OR $this->config->item('mobile_debug') == true)
			{
			$data['template_path'] = $this->config->item('template_mobile_page');
			}
		else
			{
			$data['template_path'] = $this->config->item('template_page');
			}
		$data['post_gallery'] = $this->products_model->get_post_gallery();
		$this->load->view($data['template_path'] . '/products/post_gallery', $data);
		}
	}