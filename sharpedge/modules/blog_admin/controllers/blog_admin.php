<?php
###################################################################
##
##	Blog Admin Module
##	Version: 1.16
##
##	Last Edit:
##	Sept 17 2013
##
##	Description:
##	Blog / News Admin Control System.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	Updated to use image_moo instead of image_lib
##
##################################################################
class Blog_admin extends ADMIN_Controller {

	function Blog_admin()
		{
		parent::__construct();
		#Libarays
		$this->load->library('image_lib');
		$this->load->library('image_moo');
		$this->lang->load('recaptcha');
		$this->load->library('recaptcha');
		$this->load->library('pagination');

		#Models
		$this->load->model('blog_admin_model');

		#Helpers
		$this->load->helper('date');
		$this->load->helper('directory');
		
		#Configuration
		$this->load->config('blog_config');
		
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
			$config['base_url'] = site_url(). '/blog_admin/pages/10/';
			if($this->uri->segment(3) == '')
				{
				$config['per_page'] = '10';
				}
			else
				{
				$config['per_page'] = $this->uri->segment(3);
				}
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['query'] = $this->blog_admin_model->show_blog($config['per_page'], $this->uri->segment(4));
			$data['count_posts'] = $this->blog_admin_model->count_posts();
			$config['total_rows'] = count($data['count_posts']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('manage_blog');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  $data['template_path'] . '/blog_admin/blog_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}
		
	function pages()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$config['base_url'] = site_url(). '/blog_admin/pages/'. $this->uri->segment(3) . '/';
			$config['per_page'] = $this->uri->segment(3);
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['query'] = $this->blog_admin_model->show_blog($config['per_page'], $this->uri->segment(4));
			$data['count_posts'] = $this->blog_admin_model->count_posts();
			$config['total_rows'] = count($data['count_posts']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('manage_blog');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  $data['template_path'] . '/blog_admin/blog_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_blog_post()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'required');
			$this->form_validation->set_rules('add_image', 'add_image', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('gallery_display', 'gallery_display', 'xss_clean');
			$this->form_validation->set_rules('gallery_id', 'gallery_id', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run($this) == FALSE)
				{
				$data['heading'] = $this->lang->line('new_blog_post');
				$template_path = $this->config->item('template_admin_page');
				$data['get_galleries'] = $this->blog_admin_model->get_galleries();
				$data['tags'] = $this->blog_admin_model->get_tags();
				$data['get_assets'] = directory_map('./assets/images/uploads/');
				$data['langs'] = $this->blog_admin_model->get_langs();
				
				if(!isset($_POST['add_image']))
					{
					$this->load->view($template_path . '/blog_admin/blog_new_post', $data);
					}
				else
					{
					$data['page'] = $template_path . '/blog_admin/blog_new_post';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				if($this->input->post('add_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/news/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						redirect('blog_admin/#tabs-2');
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();
						
						$thumb_path = 'assets/news/thumbs/' . $data['upload_data']['file_name'];
						$small_path = 'assets/news/small/' . $data['upload_data']['file_name'];
						$medium_path = 'assets/news/medium/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/news/normal/' . $data['upload_data']['file_name'];
					
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_thumbnail_quality'))
							->resize_crop($this->config->item('blog_thumbnail_maxwidth'),$this->config->item('blog_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_normal_quality'))
							->resize_crop($this->config->item('blog_normal_maxwidth'),$this->config->item('blog_normal_maxheight'))
							->save($normal_path, TRUE);
							
						//Create Medium Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_medium_quality'))
							->resize_crop($this->config->item('blog_medium_maxwidth'),$this->config->item('blog_medium_maxheight'))
							->save($medium_path, TRUE);
							
						//Create Small Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_small_quality'))
							->resize_crop($this->config->item('blog_small_maxwidth'),$this->config->item('blog_small_maxheight'))
							->save($small_path, TRUE);
						
						$userfile = $data['upload_data']['file_name'];
						$this->blog_admin_model->blog_insert($userfile);
						$post_id = $this->db->insert_id();
						if($this->input->post('tags') == '')
							{
							}
							else
							{
							for($i = 0; $i < count($_POST['tags']); $i++)
								{
								$new_tag = $_POST['tags'][$i];
								$this->blog_admin_model->import_category($new_tag, $post_id);
								}
							}
						$this->load->dbutil();
						$this->dbutil->optimize_table('blog');
						$msg = $this->lang->line('added');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('blog_admin');
						}
					}
				else
					{
					$userfile = '';
					$this->blog_admin_model->blog_insert($userfile);
					$post_id = $this->db->insert_id();
					if($this->input->post('tags') == '')
						{
						}
						else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->blog_admin_model->import_category($new_tag, $post_id);
							}
						}
					$this->load->dbutil();
					$this->dbutil->optimize_table('blog');
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('blog_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_blog_post()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'required');
			$this->form_validation->set_rules('add_image', 'add_image', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('gallery_display', 'gallery_display', 'xss_clean');
			$this->form_validation->set_rules('gallery_id', 'gallery_id', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run($this) == FALSE)
				{
				$data['query'] = $this->blog_admin_model->edit_blog();
				$data['tags'] = $this->blog_admin_model->get_tags();
				$data['langs'] = $this->blog_admin_model->get_langs();
				$data['get_galleries'] = $this->blog_admin_model->get_galleries();
				$data['get_categories'] = $this->blog_admin_model->get_post_categories($this->uri->segment(3));
				$data['heading'] = $this->lang->line('edit_blog_post');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/blog_admin/blog_edit_post';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				if($this->input->post('update_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/news/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					$userfile2 = 'userfile2';
					if(!$this->upload->do_upload($userfile2))
						{
						$error = array('error' => $this->upload->display_errors());
						$data['query'] = $this->blog_admin_model->edit_blog();
						$data['tags'] = $this->blog_admin_model->get_tags();
						$data['get_galleries'] = $this->blog_admin_model->get_galleries();
						$data['langs'] = $this->blog_admin_model->get_langs();
						$data['template_path'] = $this->config->item('template_admin_page');
						$data['get_categories'] = $this->blog_admin_model->get_post_categories($this->uri->segment(3));
						$data['heading'] = "Edit Post";
						$data['page'] = $data['template_path'] . '/blog_admin/blog_edit_post';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();

						$thumb_path = 'assets/news/thumbs/' . $data['upload_data']['file_name'];
						$small_path = 'assets/news/small/' . $data['upload_data']['file_name'];
						$medium_path = 'assets/news/medium/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/news/normal/' . $data['upload_data']['file_name'];
					
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_thumbnail_quality'))
							->resize_crop($this->config->item('blog_thumbnail_maxwidth'),$this->config->item('blog_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_normal_quality'))
							->resize_crop($this->config->item('blog_normal_maxwidth'),$this->config->item('blog_normal_maxheight'))
							->save($normal_path, TRUE);
							
						//Create Medium Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_medium_quality'))
							->resize_crop($this->config->item('blog_medium_maxwidth'),$this->config->item('blog_medium_maxheight'))
							->save($medium_path, TRUE);
							
						//Create Small Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('blog_small_quality'))
							->resize_crop($this->config->item('blog_small_maxwidth'),$this->config->item('blog_small_maxheight'))
							->save($small_path, TRUE);
						
						$userfile2 = $data['upload_data']['file_name'];
						
						$this->blog_admin_model->blog_update_with_image($userfile2);
					
						#Lets Delete Existing Category Records.
						$this->db->where('post_id', $this->uri->segment(3));
						$this->db->delete('post_categories');
						
						$post_id = $this->uri->segment(3);
						if($this->input->post('tags') == '')
							{
							}
							else
							{
							for($i = 0; $i < count($_POST['tags']); $i++)
								{
								$new_tag = $_POST['tags'][$i];
								$this->blog_admin_model->import_category($new_tag, $post_id);
								}
							}
						$this->load->dbutil();
						$this->dbutil->optimize_table('blog');
						$msg = $this->lang->line('updated');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('blog_admin');
						}
					}
				else
					{
					$this->blog_admin_model->blog_update();
					
					#Lets Delete Existing Category Records.
					$this->db->where('post_id', $this->uri->segment(3));
					$this->db->delete('post_categories');
					
					$post_id = $this->uri->segment(3);
					if($this->input->post('tags') == '')
						{
						}
					else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->blog_admin_model->import_category($new_tag, $post_id);
							}
						}
					$this->load->dbutil();
					$this->dbutil->optimize_table('blog');
					$msg = $this->lang->line('updated');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('blog_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_blog_post()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->blog_admin_model->blog_delete();
			redirect('blog_admin/');
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
			$data['query'] = $this->blog_admin_model->show_categories();
			$data['heading'] = $this->lang->line('blog_cats');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  'cat_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/blog_admin/cat_list', $data);
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
			$this->form_validation->set_rules('blog_cat', 'blog_cat', 'xss_clean|required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('blog_add_cat');
				$template_path = $this->config->item('template_admin_page');
				$data['langs'] = $this->blog_admin_model->get_langs();
				
				if(!isset($_POST['lang']))
					{
					$this->load->view($template_path . '/blog_admin/new_category', $data);
					}
				else
					{
					$data['page'] = $template_path . '/blog_admin/new_category';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
					
				}
			else
				{
				$this->blog_admin_model->cat_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('blog_categories');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('blog_admin/#tabs-3');
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
			$this->form_validation->set_rules('blog_cat', 'blog_cat', 'xss_clean|required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->blog_admin_model->edit_cat();
				$data['heading'] = $this->lang->line('blog_edit_cat');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/blog_admin/edit_category';
				$data['langs'] = $this->blog_admin_model->get_langs();
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->blog_admin_model->cat_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('blog_categories');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('blog_admin/#tabs-3');
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
			$this->blog_admin_model->cat_delete();
			redirect('blog_admin/#tabs-3');
			}
		else
			{
			echo "access denied";
			}
		}

	function manage_comments()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['show_comments'] = $this->blog_admin_model->show_comments();
			$data['heading'] = $this->lang->line('manage_blog_comments');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  'comment_list';
			$this->load->view($data['template_path'] . '/blog_admin/comment_list', $data);
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_comment()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('message', 'message', 'xss_clean|required');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->blog_admin_model->edit_comment();
				$data['heading'] = $this->lang->line('blog_edit_comment');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/blog_admin/edit_comment';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->blog_admin_model->comment_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('blog_comments');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('blog_admin/#tabs-5');
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_comment()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->blog_admin_model->comment_delete();
			redirect('blog_admin/#tabs-5');
			}
		else
			{
			echo "access denied";
			}
		}
		
	function update_thumbnails_display()
		{
		if($this->data['module_read'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$data['heading'] = "Update Thumbnails";
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/blog_admin/update_thumbnails', $data);
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
			$images = $this->db->get('blog');
			foreach($images->result() as $i)
				{
				$thumb_path = 'assets/news/thumbs/' . $i->userfile;
				$small_path = 'assets/news/small/' . $i->userfile;
				$medium_path = 'assets/news/medium/' . $i->userfile;
				$normal_path = 'assets/news/normal/' . $i->userfile;
				$source_path = 'assets/news/'.$i->userfile;
			
				//Create Thumbnail
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('blog_thumbnail_quality'))
					->resize_crop($this->config->item('blog_thumbnail_maxwidth'),$this->config->item('blog_thumbnail_maxheight'))
					->save($thumb_path, TRUE);
					
				//Create Normal Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('blog_normal_quality'))
					->resize_crop($this->config->item('blog_normal_maxwidth'),$this->config->item('blog_normal_maxheight'))
					->save($normal_path, TRUE);
					
				//Create Medium Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('blog_medium_quality'))
					->resize_crop($this->config->item('blog_medium_maxwidth'),$this->config->item('blog_medium_maxheight'))
					->save($medium_path, TRUE);
					
				//Create Small Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('blog_small_quality'))
					->resize_crop($this->config->item('blog_small_maxwidth'),$this->config->item('blog_small_maxheight'))
					->save($small_path, TRUE);
				}
			/*
			foreach($images->result() as $i)
				{
				if($i->userfile = '')
					{
					}
				else
					{
					chmod('assets/news/normal/'.$i->userfile, 0644);
					chmod('assets/news/medium/'.$i->userfile, 0644);
					chmod('assets/news/small/'.$i->userfile, 0644);
					chmod('assets/news/thumbs/'.$i->userfile, 0644);
					}
				}
			*/
			$msg = $this->lang->line('updated');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('blog_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	
	function check_article_name($name)
		{
		$this->db->where('name', $name);
		$articles = $this->db->get('blog');
		foreach($articles->result() as $nname)
			{
			$new_name = $nname->name;
			$url_name = $nname->url_name;
			}
		if ($name == $new_name OR url_title($name) == $url_name)
			{
			$this->form_validation->set_message('name', 'That Article name is already taken. Try a different name');
			return FALSE;
			}
		else
			{
			return TRUE;
			}
		}
}