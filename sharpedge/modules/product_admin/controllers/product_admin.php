<?php
###################################################################
##
##	Product Admin Module
##	Version: 1.00
##
##	Last Edit:
##	July 16 2014
##
##	Description:
##	Product Admin Control System.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	Shipping Options
##
##################################################################
class Product_admin extends ADMIN_Controller
	{

	function Product_admin()
		{
		parent::__construct();
		#Libarays
		$this->load->library('image_lib');
		$this->load->library('image_moo');

		#Models
		$this->load->model('product_admin_model');

		#Helpers
		$this->load->helper('date');
		$this->load->helper('directory');
		
		#Configuration
		$this->load->config('product_config');
		
		#Load Module User Protection
		$check_perm = $this->backend_model->protect_module();
		$this->data['module_read'] = 'N';
		$this->data['module_write'] = 'N';
		$this->data['module_delete'] = 'N';
		$check_perm = $this->backend_model->get_module_permissions();
		if($check_perm->result())
			{
			foreach($check_perm->result() as $pm)
				{
				$this->data['module_read'] = $pm->read;
				$this->data['module_write'] = $pm->write;
				$this->data['module_delete'] = $pm->delete;
				}
			}
		else
			{
			$this->data['module_read'] = 'N';
			$this->data['module_write'] = 'N';
			$this->data['module_delete'] = 'N';
			}
		}

	function index()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['query'] = $this->product_admin_model->show_products();
			$template_path = $this->config->item('template_admin_page');
			$data['heading'] = "Manage Products";
			$data['page'] =  $template_path . '/product_admin/product_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_product()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('product_name', 'product_name', 'xss_clean|required');
			$this->form_validation->set_rules('brand_name', 'brand_name', 'xss_clean');
			$this->form_validation->set_rules('price', 'price', 'xss_clean|required');
			$this->form_validation->set_rules('desc', 'desc', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "New Product";
				$template_path = $this->config->item('template_admin_page');
				$data['page'] = $template_path . '/product_admin/new_product';
				$data['tags'] = $this->product_admin_model->get_tags();
				$data['downloads'] = $this->product_admin_model->get_downloads();
				$data['galleries'] = $this->product_admin_model->get_galleries();
				$data['langs'] = $this->product_admin_model->get_langs();
				if($this->input->post('add_image') == '')
					{
					$this->load->view($data['page'], $data);
					}
				else
					{
					$this->load->vars($data);
					$this->load->view($this->_container, $error);
					}
				}
			else
				{
				if($this->input->post('add_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = 'assets/products/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						$error = array('error' => $this->upload->display_errors());
						$template_path = $this->config->item('template_admin_page');
						$data['heading'] = 'Add Image';
						$data['page'] = $template_path . '/product_admin/new_product';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();
						
						$thumb_path = 'assets/products/thumbs/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/products/normal/' . $data['upload_data']['file_name'];
						
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_thumbnail_quality'))
							->resize_crop($this->config->item('product_thumbnail_maxwidth'),$this->config->item('product_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_normal_quality'))
							->resize($this->config->item('product_normal_maxwidth'),$this->config->item('product_normal_maxheight'))
							->save($normal_path, TRUE);
						
						$userfile = $data['upload_data']['file_name'];
						}
					}
				else
					{
					$userfile = '';
					}
					
					$this->product_admin_model->product_insert($userfile);
					$post_id = $this->db->insert_id();
					
					if($this->input->post('tags') == '')
						{
						}
					else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->product_admin_model->import_category($new_tag, $post_id);
							}
						}
						
					if($this->input->post('downloads') == '')
						{
						}
					else
						{
						for($i = 0; $i < count($_POST['downloads']); $i++)
							{
							$new_download = $_POST['downloads'][$i];
							$this->product_admin_model->import_download($new_download, $post_id);
							}
						}
						
				$this->load->dbutil();
				$this->dbutil->optimize_table('products');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_product()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('product_name', 'product_name', 'xss_clean|required');
			$this->form_validation->set_rules('brand_name', 'brand_name', 'xss_clean');
			$this->form_validation->set_rules('price', 'price', 'xss_clean');
			$this->form_validation->set_rules('desc', 'desc', 'xss_clean');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->product_admin_model->edit_product();
				$data['tags'] = $this->product_admin_model->get_tags();
				$data['downloads'] = $this->product_admin_model->get_downloads();
				$data['galleries'] = $this->product_admin_model->get_galleries();
				$data['get_downloads'] = $this->product_admin_model->downloads_in_product($this->uri->segment(3));
				$data['langs'] = $this->product_admin_model->get_langs();
				$data['get_categories'] = $this->product_admin_model->get_post_categories($this->uri->segment(3));
				$template_path = $this->config->item('template_admin_page');
				$data['heading'] = "Edit Product";
				$data['page'] = $template_path . '/product_admin/edit_product';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				if($this->input->post('update_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = 'assets/products/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						$error = array('error' => $this->upload->display_errors());
						$template_path = $this->config->item('template_admin_page');
						$data['heading'] = 'Add Image';
						$data['page'] = $template_path . '/product_admin/edit_product';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();
						
						$thumb_path = 'assets/products/thumbs/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/products/normal/' . $data['upload_data']['file_name'];
						
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_thumbnail_quality'))
							->resize_crop($this->config->item('product_thumbnail_maxwidth'),$this->config->item('product_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_normal_quality'))
							->resize($this->config->item('product_normal_maxwidth'),$this->config->item('product_normal_maxheight'))
							->save($normal_path, TRUE);
							
						$userfile = $data['upload_data']['file_name'];
						}
					}
				else
					{
					$userfile = '';
					}
					
				$this->product_admin_model->product_update($userfile);
				
				#Lets Delete Existing Category Records.
				$this->db->where('product_id', $this->uri->segment(3));
				$this->db->delete('products_in_category');
				
				#Lets Delete Existing Category Records.
				$this->db->where('product_id', $this->uri->segment(3));
				$this->db->delete('product_downloads');
				$downloads = '';
				$post_id = $this->uri->segment(3);
				
				if($this->input->post('tags') == '')
					{
					}
				else
					{
					for($i = 0; $i < count($_POST['tags']); $i++)
						{
						$new_tag = $_POST['tags'][$i];
						$this->product_admin_model->import_category($new_tag, $post_id);
						}
					}
					
				if($this->input->post('downloads') == '')
					{
					}
				else
					{
					for($i = 0; $i < count($_POST['downloads']); $i++)
						{
						$new_download = $_POST['downloads'][$i];
						$this->product_admin_model->import_download($new_download, $post_id);
						}
					}
					
				$this->load->dbutil();
				$this->dbutil->optimize_table('products');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_product()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->product_admin_model->product_delete();
			redirect('product_admin');
			}
		else
			{
			echo "access denied";
			}
		}

	function manage_categories()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['query'] = $this->product_admin_model->show_categories();
			$template_path = $this->config->item('template_admin_page');
			$data['heading'] = "Manage Categories";
			$data['page'] =  'cat_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($template_path . '/product_admin/cat_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_category()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('category_name', 'category_name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "New Category";
				$template_path = $this->config->item('template_admin_page');
				$data['page'] = $template_path . '/product_admin/new_category';
				$data['langs'] = $this->product_admin_model->get_langs();
				if($this->input->post('add_image') == '')
					{
					$this->load->view($data['page'], $data);
					}
				else
					{
					$this->load->vars($data);
					$this->load->view($this->_container, $error);
					}
				}
			else
				{
				if($this->input->post('add_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = 'assets/products/categories/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						$error = array('error' => $this->upload->display_errors());
						$template_path = $this->config->item('template_admin_page');
						$data['heading'] = 'Add Image';
						$data['page'] = $template_path . '/product_admin/new_category';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$updatea = $this->upload->data();
						$data = array('upload_data' => $this->upload->data());
						
						$category_path = 'assets/products/categories/thumbs/' . $data['upload_data']['file_name'];
						
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_category_quality'))
							->resize_crop($this->config->item('product_category_maxwidth'),$this->config->item('product_category_maxheight'))
							->save($category_path, TRUE);
						
						$userfile = $data['upload_data']['file_name'];
						}
					}
				else
					{
					$userfile = '';
					}
					
				$this->product_admin_model->cat_insert($userfile);
				$this->load->dbutil();
				$this->dbutil->optimize_table('product_categories');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_category()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('category_name', 'category_name', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->product_admin_model->edit_cat();
				$template_path = $this->config->item('template_admin_page');
				$data['heading'] = "Edit Category";
				$data['page'] = $template_path . '/product_admin/edit_category';
				$data['langs'] = $this->product_admin_model->get_langs();
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				if($this->input->post('update_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = 'assets/products/categories/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						$error = array('error' => $this->upload->display_errors());
						$template_path = $this->config->item('template_admin_page');
						$data['heading'] = 'Add Image';
						$data['page'] = $template_path . '/product_admin/new_category';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$updatea = $this->upload->data();
						$data = array('upload_data' => $this->upload->data());
						
						$category_path = 'assets/products/categories/thumbs/' . $data['upload_data']['file_name'];
						
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('product_category_quality'))
							->resize_crop($this->config->item('product_category_maxwidth'),$this->config->item('product_category_maxheight'))
							->save($category_path, TRUE);
							
						$userfile = $data['upload_data']['file_name'];
						}
					}
				else
					{
					$userfile = '';
					}
				$this->product_admin_model->cat_update($userfile);
				$this->load->dbutil();
				$this->dbutil->optimize_table('product_categories');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin/#tabs-3');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_category()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->product_admin_model->cat_delete();
			redirect('product_admin/#tabs-3');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function manage_shipping()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['query'] = $this->product_admin_model->show_shipping();
			$template_path = $this->config->item('template_admin_page');
			$data['heading'] = "Manage Shipping";
			$data['page'] =  $template_path .'/product_admin/shipping_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_shipping()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('price', 'price', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = "New Shipping";
				$template_path = $this->config->item('template_admin_page');
				$this->load->view($template_path . '/product_admin/new_shipping', $data);
				}
			else
				{	
				$this->product_admin_model->ship_insert();
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin/manage_shipping/'. $this->uri->segment(3));
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_shipping()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('price', 'price', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->product_admin_model->edit_shipping();
				$template_path = $this->config->item('template_admin_page');
				$data['heading'] = "Edit Category";
				$data['page'] = $template_path . '/product_admin/edit_shipping';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->product_admin_model->ship_update();
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin/manage_shipping/' . $this->uri->segment(3));
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_shipping()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->product_admin_model->ship_delete();
			redirect('product_admin/manage_shipping/' . $this->uri->segment(3));
			}
		else
			{
			echo "access denied";
			}
		}
	
	function manage_orders()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['query'] = $this->product_admin_model->get_all_orders();
			$data['heading'] = "Manage Orders";
			$data['page'] =  'order_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$template_path = $this->config->item('template_admin_page');
			$this->load->view($template_path . '/product_admin/order_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}
	
	function edit_order()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('order_number', 'order_number', 'xss_clean|required');
			$this->form_validation->set_rules('total_amount', 'total_amount', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<h5>', '</h5>');
			if($this->form_validation->run() == FALSE)
				{
				$data['edit_order'] = $this->product_admin_model->edit_order();
				$data['ordered_items'] = $this->product_admin_model->get_order_items($this->uri->segment(3));
				$template_path = $this->config->item('template_admin_page');
				$data['heading'] = "Edit Order";
				$data['page'] = $template_path . '/product_admin/edit_order';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->product_admin_model->update_order();
				$this->load->dbutil();
				$this->dbutil->optimize_table('orders');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('product_admin');
				}
			}
		else
			{
			echo "access denied";
			}
		}
		
	function view_invoice()
		{
		}
	
	function delete_order()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->product_admin_model->delete_order();
			redirect('product_admin');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function update_thumbnails()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->db->select('userfile');
			$images = $this->db->get('products');
			foreach($images->result() as $i)
				{
				$thumb_path = 'assets/products/thumbs/' . $i->userfile;
				$normal_path = 'assets/products/normal/' . $i->userfile;
				$source_path = 'assets/products/' . $i->userfile;
						
				//Create Thumbnail
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('product_thumbnail_quality'))
					->resize_crop($this->config->item('product_thumbnail_maxwidth'),$this->config->item('product_thumbnail_maxheight'))
					->save($thumb_path, TRUE);
					
				//Create Normal Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('product_normal_quality'))
					->resize($this->config->item('product_normal_maxwidth'),$this->config->item('product_normal_maxheight'))
					->save($normal_path, TRUE);
				}
			$msg = $this->lang->line('updated');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('product_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	}