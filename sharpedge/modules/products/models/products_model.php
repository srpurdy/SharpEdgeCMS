<?php
###################################################################
##
##	Product Database Model
##	Version: 0.94
##
##	Last Edit:
##	Sept 7 2012
##
##	Description:
##	Product Database System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Products_model extends CI_Model 
	{
	
    function Products_model()
		{     
		parent::__construct();
		}

	function get_cat()
		{
		$this->db->where('product_categories.lang', $this->config->item('language_abbr'));
		$this->db->order_by('id', 'desc');
		$cat = $this->db->get('product_categories');
		return $cat;
		}
		
	function get_products_category()
		{
		$products = $this->db
			->where('product_categories.url_category', $this->uri->segment(3))
			->where('product_categories.id = products_in_category.cat_id')
			->where('products_in_category.product_id = products.product_id')
			->where('products.lang', $this->config->item('language_abbr'))
			->where('products.hide', 'N')
			->select('
				products.product_id,
				products.product_name,
				products.userfile,
				products.brand_name,
				products.price,
				products.desc,
				products.download,
				products.sort_id,
				products.hide,
				products.stock
			')
			->from('products,product_categories,products_in_category')
			->order_by('products.sort_id', 'asc')
			->get();
		return $products;
		}
		
	function get_product($id)
		{
		$this->db->where('product_id', $id);
		$product = $this->db->get('products');
		return $product;
		}
		
	function get_gateways()
		{
		$this->db->where('active', 'Y');
		$gateways = $this->db->get('gateways');
		return $gateways;
		}
		
	function get_post_gallery()
		{
		$post_gallery = $this->db
			->where('cat_id', $this->uri->segment(3))
			->select('
				userfile,
				desc_one,
				desc_two,
				sort_id,
				photo_id
			')
			->from('gallery_photos')
			->get();
		return $post_gallery;
		}
		
	function gallery_name()
		{
		$gallery_name = $this->db
			->where('id', $this->uri->segment(3))
			->select('name')
			->from('gallery_categories')
			->get();
		return $gallery_name;
		}
	}
?>