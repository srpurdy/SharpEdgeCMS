<?php
###################################################################
##
##	Product Admin Model
##	Version: 1.01
##
##	Last Edit:
##	Nov 23 2014
##
##	Description:
##	Product Admin Control System.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Product_admin_model extends CI_Model 
	{
	
    function Product_admin_model()
		{     
		parent::__construct();
		}

	//Admin Function
	function get_tags()
		{
		$tags = $this->db->get('product_categories');
		return $tags;
		}
	
	function get_downloads()
		{
		$downloads = $this->db->get('downloads');
		return $downloads;
		}

	function show_products()
		{
		$products = $this->db
			->where('products.hide', 'N')
			->select('
				products.product_id,
				products.product_name,
				products.brand_name,
				products.price,
				products.desc,
				products.download,
				products.sort_id,
				products.hide,
				products.stock,
				products.lang,
				products.SKU,
				products.Weight,
				products.WeightUnits,
			')
			->from('products')
			->order_by('products.product_id', 'asc')
			->get();
		return $products;
		}

	function product_insert($userfile)
		{
		$array = array(
			'product_name' => $this->input->post('product_name'),
			'brand_name' => $this->input->post('brand_name'),
			'price' => $this->input->post('price'),
			'gallery_id' => $this->input->post('gallery_id'),
			'userfile' => $userfile,
			'desc' => $this->input->post('desc'),
			'download' => $this->input->post('download'),
			'sort_id' => $this->input->post('sort_id'),
			'hide' => $this->input->post('hide'),
			'stock' => $this->input->post('stock'),
			'lang' => $this->input->post('lang'),
			'SKU' => $this->input->post('SKU'),
			'Weight' => $this->input->post('Weight'),
			'WeightUnits' => $this->input->post('WeightUnits')
			);
		$this->db->set($array);
		$this->db->insert('products');
		$this->load->dbutil();
		$this->dbutil->optimize_table('products');
		}

	function product_update($userfile)
		{
		if($userfile == '')
			{
			$userfile = $this->input->post('current_file');
			}
		$array = array(
			'product_id' => $this->input->post('product_id'),
			'product_name' => $this->input->post('product_name'),
			'brand_name' => $this->input->post('brand_name'),
			'price' => $this->input->post('price'),
			'gallery_id' => $this->input->post('gallery_id'),
			'userfile' => $userfile,
			'desc' => $this->input->post('desc'),
			'download' => $this->input->post('download'),
			'sort_id' => $this->input->post('sort_id'),
			'hide' => $this->input->post('hide'),
			'stock' => $this->input->post('stock'),
			'lang' => $this->input->post('lang'),
			'SKU' => $this->input->post('SKU'),
			'Weight' => $this->input->post('Weight'),
			'WeightUnits' => $this->input->post('WeightUnits')
		);
		$this->db->set($array);
		$this->db->where('product_id', $this->input->post('product_id'));
		$this->db->update('products');
		$this->load->dbutil();
		$this->dbutil->optimize_table('products');
		}

	function product_delete()
		{
		$this->db->delete('products', array('product_id' => $this->uri->segment(3)));
		$this->db->delete('products_in_category', array('product_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('products');
		$this->dbutil->optimize_table('products_in_category');
		}

	function edit_product()
		{
		$edit_product = $this->db->get_where('products', array('product_id' => $this->uri->segment(3)));
		return $edit_product;
		}

	//Categories
	function show_categories()
		{
		$show_cat = $this->db
			->select('*')
			->from('
				product_categories
			')
			->get();		
		return $show_cat;
		}

	function cat_insert($userfile)
		{
		$array = array(
			'category_name' => $this->input->post('category_name'),
			'parent_id' => $this->input->post('parent_id'),
			'url_category' => url_title($this->input->post('category_name')),
			'userfile' => $userfile,
			'desc' => $this->input->post('desc'),
			'sort_id' => $this->input->post('sort_id'),
			'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->insert('product_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('product_categories');
		}

	function cat_update($userfile)
		{
		if($userfile == '')
			{
			$userfile = $this->input->post('current_file');
			}
		$array = array(
			'id' => $this->input->post('id'),
			'parent_id' => $this->input->post('parent_id'),
			'category_name' => $this->input->post('category_name'),
			'url_category' => url_title($this->input->post('category_name')),
			'userfile' => $userfile,
			'desc' => $this->input->post('desc'),
			'sort_id' => $this->input->post('sort_id'),
			'lang' => $this->input->post('lang')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('product_categories');
		$this->load->dbutil();
		$this->dbutil->optimize_table('product_categories');
		}

	function cat_delete()
		{
		$this->db->delete('product_categories', array('id' => $this->uri->segment(3)));
		$this->db->delete('products_in_category', array('cat_id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('product_categories');
		$this->dbutil->optimize_table('products_in_category');
		}

	function edit_cat()
		{
		$edit_cat = $this->db->get_where('product_categories', array('id' => $this->uri->segment(3)));
		return $edit_cat;
		}

	function get_langs()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	
	function get_all_orders()
		{
		$orders = $this->db->get('orders');
		return $orders;
		}
	
	function edit_order()
		{
		$edit_order = $this->db->get_where('orders', array('id' => $this->uri->segment(3)));
		return $edit_order;
		}
	
	function update_order()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'order_number' => $this->input->post('order_number'),
			'total_amount' => $this->input->post('total_amount'),
			'paid' => $this->input->post('paid')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('orders');
		$this->load->dbutil();
		$this->dbutil->optimize_table('orders');
		}
	
	function delete_order()
		{
		$this->db->delete('order_items', array('id' => $this->uri->segment(3)));
		$this->db->delete('orders', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('orders');
		$this->dbutil->optimize_table('order_items');
		}
		
	function get_order_items($uri)
		{
		$items = $this->db
			->where('order_id', $uri)
			->select('*')
			->from('order_items')
			->get();
		return $items;
		}

	function import_category($category, $product_id)
		{
		#lets insert the category if no record is found.
		$product_cat = array(
			'cat_id' => $category,
			'product_id' => $product_id
		);
		$this->db->set($product_cat);
		$this->db->insert('products_in_category');
		}

	function get_post_categories($uri)
		{
		$get_cats = $this->db->get_where('products_in_category', array('product_id' => $this->uri->segment(3)));
		return $get_cats;
		}
	
	function import_download($download_id, $product_id)
		{
		#lets insert the download if no record is found.
		$product_down = array(
			'product_id' => $product_id,
			'download_id' => $download_id
		);
		$this->db->set($product_down);
		$this->db->insert('product_downloads');
		}

	function downloads_in_product($uri)
		{
		$get_cats = $this->db->get_where('product_downloads', array('product_id' => $this->uri->segment(3)));
		return $get_cats;
		}
		
	function get_galleries()
		{
		$galleries = $this->db
			->select('
				id,
				name
			')
			->from('gallery_categories')
			->get();
		return $galleries;
		}
		
	function show_shipping()
		{
		$shipping = $this->db
			->where('product_id', $this->uri->segment(3))
			->select('*')
			->from('shipping_by_product')
			->get();
		return $shipping;
		}
	
	function ship_insert()
		{
		$array = array(
			'product_id' => $this->input->post('product_id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price')
		);
		$this->db->set($array);
		$this->db->insert('shipping_by_product');
		$this->load->dbutil();
		$this->dbutil->optimize_table('shipping_by_product');
		}
		
	function ship_update()
		{
		$array = array(
			'id' => $this->input->post('id'),
			'product_id' => $this->input->post('product_id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price')
		);
		$this->db->set($array);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('shipping_by_product');
		$this->load->dbutil();
		$this->dbutil->optimize_table('shipping_by_product');
		}
		
	function ship_delete()
		{
		$this->db->delete('shipping_by_product', array('id' => $this->uri->segment(3)));
		$this->load->dbutil();
		$this->dbutil->optimize_table('shipping_by_product');
		}
		
	function edit_shipping()
		{
		$edit_ship = $this->db->get_where('shipping_by_product', array('id' => $this->uri->segment(4)));
		return $edit_ship;
		}
	}
?>