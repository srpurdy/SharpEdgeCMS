<?php
###################################################################
##
##	Video Admin Module
##	Version: 1.01
##
##	Last Edit:
##	June 15 2014
##
##	Description:
##	Video Admin System
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Video_admin extends ADMIN_Controller
	{

	function Video_admin()
		{
		parent::__construct();
		#Libarays
		$this->load->library('image_lib');
		$this->load->library('image_moo');
		$this->load->library('pagination');

		#Models
		$this->load->model('video_admin_model');

		#Helpers
		$this->load->helper('date');
		
		#Configuration
		$this->load->config('video_config');
		
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
			$config['base_url'] = site_url(). '/video_admin/pages/10/';
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
			$data['query'] = $this->video_admin_model->show_videos($config['per_page'], $this->uri->segment(4));
			$data['count_videos'] = $this->video_admin_model->count_videos();
			$config['total_rows'] = count($data['count_videos']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('label_manage_videos');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  $data['template_path'] . '/video_admin/video_list';
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
			$config['base_url'] = site_url(). '/video_admin/pages/'. $this->uri->segment(3) . '/';
			$config['per_page'] = $this->uri->segment(3);
			$config['uri_segment'] = '4';
			$config['num_links'] = '4';
			$config['cur_tag_open'] = '<a class="disabled" href="#">';
			$config['cur_tag_close'] = '</a>';
			$data['query'] = $this->video_admin_model->show_videos($config['per_page'], $this->uri->segment(4));
			$data['count_videos'] = $this->video_admin_model->count_videos();
			$config['total_rows'] = count($data['count_videos']->result());
			$this->pagination->initialize($config);
			$data['heading'] = $this->lang->line('manage_videos');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  $data['template_path'] . '/video_admin/video_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->vars($data);
			$this->load->view($this->_container);
			}
		else
			{
			echo "access denied";
			}
		}

	function new_video()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('date', 'date', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'required');
			$this->form_validation->set_rules('vid', 'vid', 'xss_clean|required');
			$this->form_validation->set_rules('play_time', 'play_time', 'xss_clean');
			$this->form_validation->set_rules('is_segment', 'is_segment', 'xss_clean');
			$this->form_validation->set_rules('add_image', 'add_image', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run($this) == FALSE)
				{
				$data['heading'] = $this->lang->line('label_new_video');
				$template_path = $this->config->item('template_admin_page');
				$data['tags'] = $this->video_admin_model->get_tags();
				$data['langs'] = $this->video_admin_model->get_langs();
				
				if(!isset($_POST['add_image']))
					{
					$this->load->view($template_path . '/video_admin/new_video', $data);
					}
				else
					{
					$data['page'] = $template_path . '/video_admin/new_video';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
				}
			else
				{
				if($this->input->post('add_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/videos/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload())
						{
						redirect('video_admin/#tabs-2');
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();
						
						$thumb_path = 'assets/videos/thumbs/' . $data['upload_data']['file_name'];
						$small_path = 'assets/videos/small/' . $data['upload_data']['file_name'];
						$medium_path = 'assets/videos/medium/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/videos/normal/' . $data['upload_data']['file_name'];
					
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_thumbnail_quality'))
							->resize_crop($this->config->item('video_thumbnail_maxwidth'),$this->config->item('video_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_normal_quality'))
							->resize_crop($this->config->item('video_normal_maxwidth'),$this->config->item('video_normal_maxheight'))
							->save($normal_path, TRUE);
							
						//Create Medium Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_medium_quality'))
							->resize_crop($this->config->item('video_medium_maxwidth'),$this->config->item('video_medium_maxheight'))
							->save($medium_path, TRUE);
							
						//Create Small Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_small_quality'))
							->resize_crop($this->config->item('video_small_maxwidth'),$this->config->item('video_small_maxheight'))
							->save($small_path, TRUE);
						
						$userfile = $data['upload_data']['file_name'];
						$this->video_admin_model->video_insert($userfile);
						$video_id = $this->db->insert_id();
						if($this->input->post('tags') == '')
							{
							}
							else
							{
							for($i = 0; $i < count($_POST['tags']); $i++)
								{
								$new_tag = $_POST['tags'][$i];
								$this->video_admin_model->import_category($new_tag, $video_id);
								}
							}
						$this->load->dbutil();
						$this->dbutil->optimize_table('videos');
						$msg = $this->lang->line('added');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('video_admin');
						}
					}
				else
					{
					$userfile = '';
					$this->video_admin_model->video_insert($userfile);
					$video_id = $this->db->insert_id();
					if($this->input->post('tags') == '')
						{
						}
						else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->video_admin_model->import_category($new_tag, $video_id);
							}
						}
					$this->load->dbutil();
					$this->dbutil->optimize_table('video');
					$msg = $this->lang->line('added');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('video_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function edit_video()
		{
		if($this->data['module_write'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->form_validation->set_message('required', 'The Field %s is Required');
			$this->form_validation->set_rules('name', 'name', 'xss_clean|required');
			$this->form_validation->set_rules('date', 'date', 'xss_clean|required');
			$this->form_validation->set_rules('text', 'text', 'required');
			$this->form_validation->set_rules('vid', 'vid', 'xss_clean|required');
			$this->form_validation->set_rules('play_time', 'play_time', 'xss_clean');
			$this->form_validation->set_rules('is_segment', 'is_segment', 'xss_clean');
			$this->form_validation->set_rules('add_image', 'add_image', 'xss_clean');
			$this->form_validation->set_rules('userfile', 'userfile', 'xss_clean');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_rules('active', 'active', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run($this) == FALSE)
				{
				$data['query'] = $this->video_admin_model->edit_video();
				$data['tags'] = $this->video_admin_model->get_tags();
				$data['langs'] = $this->video_admin_model->get_langs();
				$data['get_categories'] = $this->video_admin_model->get_post_categories($this->uri->segment(3));
				$data['heading'] = $this->lang->line('edit_video');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/video_admin/edit_video';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				if($this->input->post('update_image') == 'Y')
					{
					#Upload file
					$config['upload_path'] = './assets/videos/';
					$config['allowed_types'] = $this->config->item('global_filetypes');
					$config['max_size']	= $this->config->item('global_upload_limit');
					$config['max_width']  = $this->config->item('global_upload_maxwidth');
					$config['max_height']  = $this->config->item('global_upload_maxheight');
					$this->load->library('upload', $config);
					$userfile2 = 'userfile2';
					if(!$this->upload->do_upload($userfile2))
						{
						$error = array('error' => $this->upload->display_errors());
						$data['query'] = $this->video_admin_model->edit_video();
						$data['tags'] = $this->video_admin_model->get_tags();
						$data['langs'] = $this->video_admin_model->get_langs();
						$data['get_categories'] = $this->video_admin_model->get_post_categories($this->uri->segment(3));
						$data['template_path'] = $this->config->item('template_admin_page');
						$data['heading'] = $this->lang->line('edit_video');
						$data['page'] = $data['template_path'] . '/edit_admin/edit_video';
						$this->load->vars($data);
						$this->load->view($this->_container, $error);
						}
					else
						{
						$data = array('upload_data' => $this->upload->data());
						$updatea = $this->upload->data();

						$thumb_path = 'assets/videos/thumbs/' . $data['upload_data']['file_name'];
						$small_path = 'assets/videos/small/' . $data['upload_data']['file_name'];
						$medium_path = 'assets/videos/medium/' . $data['upload_data']['file_name'];
						$normal_path = 'assets/videos/normal/' . $data['upload_data']['file_name'];
					
						//Create Thumbnail
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_thumbnail_quality'))
							->resize_crop($this->config->item('video_thumbnail_maxwidth'),$this->config->item('video_thumbnail_maxheight'))
							->save($thumb_path, TRUE);
							
						//Create Normal Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_normal_quality'))
							->resize_crop($this->config->item('video_normal_maxwidth'),$this->config->item('video_normal_maxheight'))
							->save($normal_path, TRUE);
							
						//Create Medium Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_medium_quality'))
							->resize_crop($this->config->item('video_medium_maxwidth'),$this->config->item('video_medium_maxheight'))
							->save($medium_path, TRUE);
							
						//Create Small Size
						$this->image_moo
							->load($updatea['full_path'])
							->set_jpeg_quality($this->config->item('video_small_quality'))
							->resize_crop($this->config->item('video_small_maxwidth'),$this->config->item('video_small_maxheight'))
							->save($small_path, TRUE);
						
						$userfile2 = $data['upload_data']['file_name'];
						
						$this->video_admin_model->video_update_with_image($userfile2);
					
						#Lets Delete Existing Category Records.
						$this->db->where('video_id', $this->uri->segment(3));
						$this->db->delete('video_post_categories');
						
						$video_id = $this->uri->segment(3);
						if($this->input->post('tags') == '')
							{
							}
							else
							{
							for($i = 0; $i < count($_POST['tags']); $i++)
								{
								$new_tag = $_POST['tags'][$i];
								$this->video_admin_model->import_category($new_tag, $video_id);
								}
							}
						$this->load->dbutil();
						$this->dbutil->optimize_table('videos');
						$msg = $this->lang->line('updated');
						$this->session->set_flashdata('flashmsg', $msg);
						redirect('videos_admin');
						}
					}
				else
					{
					$this->video_admin_model->video_update();
					
					#Lets Delete Existing Category Records.
					$this->db->where('video_id', $this->uri->segment(3));
					$this->db->delete('video_post_categories');
					
					$video_id = $this->uri->segment(3);
					if($this->input->post('tags') == '')
						{
						}
					else
						{
						for($i = 0; $i < count($_POST['tags']); $i++)
							{
							$new_tag = $_POST['tags'][$i];
							$this->video_admin_model->import_category($new_tag, $video_id);
							}
						}
					$this->load->dbutil();
					$this->dbutil->optimize_table('videos');
					$msg = $this->lang->line('updated');
					$this->session->set_flashdata('flashmsg', $msg);
					redirect('video_admin');
					}
				}
			}
		else
			{
			echo "access denied";
			}
		}

	function delete_video()
		{
		if($this->data['module_delete'] == 'Y' OR $this->ion_auth->is_admin())
			{
			$this->video_admin_model->video_delete();
			redirect('video_admin');
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
			$data['query'] = $this->video_admin_model->show_categories();
			$data['heading'] = $this->lang->line('video_cats');
			$data['template_path'] = $this->config->item('template_admin_page');
			$data['page'] =  'cat_list';
			$data['flashmsg'] = $this->session->flashdata('flashmsg');
			$this->load->view($data['template_path'] . '/video_admin/cat_list', $data);
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
			$this->form_validation->set_rules('video_cat', 'video_cat', 'xss_clean|required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['heading'] = $this->lang->line('video_add_cat');
				$template_path = $this->config->item('template_admin_page');
				$data['langs'] = $this->video_admin_model->get_langs();
				
				if(!isset($_POST['lang']))
					{
					$this->load->view($template_path . '/video_admin/new_category', $data);
					}
				else
					{
					$data['page'] = $template_path . '/video_admin/new_category';
					$this->load->vars($data);
					$this->load->view($this->_container);
					}
					
				}
			else
				{
				$this->video_admin_model->cat_insert();
				$this->load->dbutil();
				$this->dbutil->optimize_table('video_categories');
				$msg = $this->lang->line('added');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('video_admin/#tabs-3');
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
			$this->form_validation->set_rules('video_cat', 'video_cat', 'xss_clean|required');
			$this->form_validation->set_rules('lang', 'lang', 'xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert"><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE)
				{
				$data['query'] = $this->video_admin_model->edit_cat();
				$data['heading'] = $this->lang->line('video_edit_cat');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/video_admin/edit_category';
				$data['langs'] = $this->video_admin_model->get_langs();
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->video_admin_model->cat_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('video_categories');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('video_admin/#tabs-3');
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
			$this->video_admin_model->cat_delete();
			redirect('video_admin/#tabs-3');
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
			$data['show_comments'] = $this->video_admin_model->show_comments();
			$data['heading'] = $this->lang->line('manage_video_comments');
			$data['template_path'] = $this->config->item('template_admin_page');
			$this->load->view($data['template_path'] . '/video_admin/comment_list', $data);
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
				$data['query'] = $this->video_admin_model->edit_comment();
				$data['heading'] = $this->lang->line('video_edit_comment');
				$data['template_path'] = $this->config->item('template_admin_page');
				$data['page'] = $data['template_path'] . '/video_admin/edit_comment';
				$this->load->vars($data);
				$this->load->view($this->_container);
				}
			else
				{
				$this->video_admin_model->comment_update();
				$this->load->dbutil();
				$this->dbutil->optimize_table('video_comments');
				$msg = $this->lang->line('updated');
				$this->session->set_flashdata('flashmsg', $msg);
				redirect('video_admin/#tabs-5');
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
			$this->video_admin_model->comment_delete();
			redirect('video_admin/#tabs-5');
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
			$this->load->view($data['template_path'] . '/video_admin/update_thumbnails', $data);
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
			$images = $this->db->get('videos');
			foreach($images->result() as $i)
				{
				$thumb_path = 'assets/videos/thumbs/' . $i->userfile;
				$small_path = 'assets/videos/small/' . $i->userfile;
				$medium_path = 'assets/videos/medium/' . $i->userfile;
				$normal_path = 'assets/videos/normal/' . $i->userfile;
				$source_path = 'assets/videos/'.$i->userfile;
			
				//Create Thumbnail
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('video_thumbnail_quality'))
					->resize_crop($this->config->item('video_thumbnail_maxwidth'),$this->config->item('video_thumbnail_maxheight'))
					->save($thumb_path, TRUE);
					
				//Create Normal Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('video_normal_quality'))
					->resize_crop($this->config->item('video_normal_maxwidth'),$this->config->item('video_normal_maxheight'))
					->save($normal_path, TRUE);
					
				//Create Medium Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('video_medium_quality'))
					->resize_crop($this->config->item('video_medium_maxwidth'),$this->config->item('video_medium_maxheight'))
					->save($medium_path, TRUE);
					
				//Create Small Size
				$this->image_moo
					->load($source_path)
					->set_jpeg_quality($this->config->item('video_small_quality'))
					->resize_crop($this->config->item('video_small_maxwidth'),$this->config->item('video_small_maxheight'))
					->save($small_path, TRUE);
				}
			$msg = $this->lang->line('updated');
			$this->session->set_flashdata('flashmsg', $msg);
			redirect('video_admin');
			}
		else
			{
			echo "access denied";
			}
		}
	}