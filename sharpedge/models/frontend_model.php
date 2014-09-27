<?php
###################################################################
##
##	Main Frontend Model
##	Version: 1.19
##
##	Last Edit:
##	July 8 2014
##
##	Description:
##	Frontend Global Database Functions, Typically used in mutiple places.
##	
##	Author:
##	By Shawn Purdy
##	
##	Comments:
##	
##
##################################################################
class Frontend_model extends CI_Model 
	{
	
    function Frontend_model()
		{
		parent::__construct();
		}
	
	function get_menu($lang)
		{		
		$cimenu = $this->db
			->where('lang', $lang)
			->where('hide', 'N')
			->select('
				id,
				hide,
				parent_id,
				child_id,
				text,
				link,
				page_link,
				use_page,
				title,
				target,
				orderfield,
				expanded,
				has_child,
				has_sub_child,
				lang
			')
			->from('menu')
			->order_by('orderfield', 'asc')
			->get();
		return $cimenu;
		}

	function get_languages()
		{
		$langs = $this->db->get('languages');
		return $langs;
		}
	
	function dashboard_permissions()
		{
		$i = 0;
		$user_id = $this->session->userdata('user_id');
		$get_group = $this->db
			->where('users_groups.user_id', $user_id)
			->select('users_groups.group_id')
			->from('users_groups')
			->get();
			
		foreach($get_group->result() as $gg)
			{
			$user_group[$i] = $gg->group_id;
			$i++;
			}
			
		$module = 'dashboard';
		$permissions_dash = $this->db
			->where('modules.name', $module)
			->where('modules.id = module_permissions.module_id')
			->where_in('module_permissions.group_id', $user_group)
			->select('
				module_permissions.read
			')
			->from('modules,module_permissions')
			->get();
		return $permissions_dash;
		}

	function admin_modules()
		{
		$this->db->where('is_admin', 'Y');
		$admin_modules = $this->db->get('modules');
		return $admin_modules;
		}
		
	function multi_site_template($site_address)
		{
		/*
		$site = $this->db
			->where('site_address', $site_address)
			->select('theme_folder,site_name')
			->from('sites')
			->get();
		*/
		}

	function get_page_template($page_container)
		{
		$pg_result = $this->config->item('template_page');
		$pg_final = $pg_result.$page_container;
		return $pg_final;
		}
		
	function get_page_mobile_template($page_container)
		{
		$pg_result = $this->config->item('template_mobile_page');
		$pg_final = $pg_result.$page_container;
		return $pg_final;
		}

	function get_license_template()
		{
		$license_template = "/themes/license/license_template";
		return $license_template;
		}

	function get_ctrl_template()
		{
		if($this->uri->segment(2) == 'comments')
			{
		$ctrl_template = $this->db
			->select('container')
			->where('name', $this->uri->segment(2))
			->get('modules'); 
			}
		else
			{
		$ctrl_template = $this->db
			->select('container')
			->where('name', $this->uri->segment(1))
			->get('modules'); 
			}
		if(!$ctrl_template->result())
			{
			}
		else
			{
			foreach($ctrl_template->result() as $pgtmp)
				{
				$pg_temp = $pgtmp->container;
				}
			$pg_result = $this->config->item('template_page');
			$pg_final = $pg_result.$pg_temp;
			return $pg_final;
			}
		}
		
	function get_ctrl_mobile_template()
		{
		$ctrl_template = $this->db
			->select('container')
			->where('name', $this->uri->segment(1))
			->get('modules'); 
		if(!$ctrl_template->result())
			{
			}
		else
			{
			foreach($ctrl_template->result() as $pgtmp)
				{
				$pg_temp = $pgtmp->container;
				}
			$pg_result = $this->config->item('template_mobile_page');
			$pg_final = $pg_result.$pg_temp;
			return $pg_final;
			}
		}

	function news_widget_items()
		{
		$get_posts = $this->db		
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
				blog.name,
				blog.text,
				blog.active,
				blog.postedby,
				blog.date,
				blog.lang,
				blog.tags,
				blog.userfile,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog
			')
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}

	function ctrl_widgets($name)
		{
		if($this->uri->segment(2) == 'comments')
			{
			$ctrl_mod = $this->db
			->select('name')
			->where('name', 'comments')
			->get('modules'); 
			return $ctrl_mod;
			}
		else
			{
			$ctrl_mod = $this->db
			->select('name')
			->where('name', $name)
			->get('modules'); 
			return $ctrl_mod;
			}
		}

	function get_ctrl_widgets($location_name, $module)
		{
		$widget_group = $this->db
			->where('widget_locations.name', $location_name)
			->where('widget_locations.id = module_widgets.location_id')
			->where('module_widgets.rel_id = modules.id')
			->where('modules.name', $module)
			->where('module_widgets.group_id = widget_group_items.group_id')
			//->where('widget_group_items.group_id', $set_id)
			->where('widgets.lang', $this->config->item('language_abbr'))
			->where('widget_group_items.widget_id = widgets.id')
			->select('*')
			->from('widgets,widget_groups,widget_locations,module_widgets,modules')
			->join('widget_group_items', 'widget_group_items.group_id = widget_groups.id')
			->order_by('widget_group_items.sort_id', 'asc')
			->get();
		return $widget_group;
		}

	function gallery_list()
		{
		$gallcat = $this->db
			->select('*')
			->from('gallery_categories')
			->get();
		return $gallcat;
		}

	function get_slideshow($id)
		{
		$slide = $this->db
			->where('id', $id)
			->select('*')
			->from('slideshow_group')
			->get();
		return $slide;
		}

	function get_slideshow_images($id)
		{
		$images = $this->db
			->where('id', $id)
			->select('*')
			->from('slideshow')
			->order_by('sort_id', 'asc')
			->get();
		return $images;
		}

	function get_page_section($pagetitle)
		{
		$page = $this->db
			->select('*')
			->where('url_name', $pagetitle)
			->where('lang', $this->config->item('language_abbr'))
			->get('pages'); 
		return $page;
		}

	function get_ctrl_section($pagetitle)
		{
		$ctrl = $this->db
			->select('*')
			->where('name', $pagetitle)
			->get('modules'); 
		return $ctrl;
		}

	function count_results()
		{
		$count_p = $this->db
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
			')
			->from('
				blog
			')
			//->limit($num, $offset)
			->get();
		return $count_p;
		}

	//Frontend Function
	function get_blogposts($num, $offset)
		{	
		$get_posts = $this->db		
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
				blog.name,
				blog.url_name,
				blog.text,
				blog.active,
				blog.postedby,
				blog.date,
				blog.lang,
				blog.tags,
				blog.userfile,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}
		
	function get_news_tags($blog_id)
		{
		$news_tags = $this->db
			->where_in('post_categories.post_id', $blog_id)
			->where('post_categories.cat_id = blog_categories.id')
			->select('
				post_categories.post_id,
				post_categories.cat_id,
				blog_categories.blog_cat,
				blog_categories.blog_url_cat
			')
			->from('post_categories,blog_categories')
			->get();
		return $news_tags->result_array();
		}
	
	function get_news_images()
		{
		$news_images = $this->db
			->where('active', 'Y')
			->select('*')
			->from('blog')
			->order_by('date', 'desc')
			->limit('5')
			->get();
		return $news_images;
		}
	
	function get_news_images_slideshow()
		{
		$news_images = $this->db
			->where('blog_categories.blog_cat', 'Slideshow')
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			->limit('4')
			->get();
		return $news_images;
		}
	
	function get_news_images_slideshow_landing($uri)
		{
		$landing_uri = $uri . '-Slideshow';
		$news_images = $this->db
			->where('blog_categories.blog_url_cat', $landing_uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			->limit('4')
			->get();
		return $news_images;
		}
	
	function get_featured_news()
		{
		$news_images = $this->db
			->where('blog_categories.blog_url_cat', 'Features')
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			->limit('4')
			//->group_by('blog.blog_id')
			//->join('blog', 'blog.blog_id = post_categories.post_id')
			->get();
		return $news_images;
		}
	
	function get_review_news()
		{
		$news_images = $this->db
			->where('blog_categories.blog_cat', 'Reviews')
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			->limit('4')
			->get();
		return $news_images;
		}
	
	function get_featured_news_landing($uri)
		{
		$landing_uri = $uri . '-Features';
		$news_images = $this->db
			->where('blog_categories.blog_url_cat', $landing_uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			->limit('4')
			->get();
		return $news_images;
		}
	
	//Frontend Function
	function get_blogposts_landing($num, $offset, $uri)
		{	
		$get_posts = $this->db
			->where('blog_categories.blog_url_cat', $uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
				blog.name,
				blog.url_name,
				blog.text,
				blog.active,
				blog.postedby,
				blog.date,
				blog.lang,
				blog.tags,
				blog.userfile,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog,
				blog_categories,
				post_categories
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}
	
	//Frontend Function
	function get_blogposts_homepage($num, $offset, $uri)
		{	
		$get_posts = $this->db
			->where('blog_categories.blog_url_cat', $uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
				blog.name,
				blog.url_name,
				blog.text,
				blog.active,
				blog.postedby,
				blog.date,
				blog.lang,
				blog.tags,
				blog.userfile,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
			')
			->from('
				blog,
				blog_categories,
				post_categories
			')
			->limit($num, $offset)
			->order_by('blog.date', 'desc')
			->get();
		return $get_posts;
		}
	
	function count_results_landing($uri)
		{
		$count_p = $this->db
			->where('blog_categories.blog_url_cat', $uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('
				blog.blog_id,
			')
			->from('
				blog,
				blog_categories,
				post_categories
			')
			//->limit($num, $offset)
			->get();
		return $count_p;
		}
		
	function edit_forum_profile()
		{
		$edit_forum_profile = $this->db
			->where('user_id', $this->session->userdata('user_id'))
			->select('
				avatar,
				website,
				signature,
				location,
				intrests,
				occupation,
				total_posts,
				timezone,
				daylight_savings,
				display_signatures,
				display_avatars,
				display_name,
				nickname
			')
			->from('profile_fields')
			->get();
		return $edit_forum_profile->result();
		}
		
	function forum_profile()
		{
		$edit_forum_profile = $this->db
			->where('profile_fields.user_id', $this->uri->segment(3))
			->where('users.id', $this->uri->segment(3))
			->select('
				profile_fields.avatar,
				profile_fields.website,
				profile_fields.signature,
				profile_fields.location,
				profile_fields.intrests,
				profile_fields.occupation,
				profile_fields.total_posts,
				profile_fields.timezone,
				profile_fields.daylight_savings,
				profile_fields.display_signatures,
				profile_fields.display_avatars,
				profile_fields.display_name,
				profile_fields.nickname,
				users.first_name,
				users.last_name
			')
			->from('profile_fields,users')
			->get();
		return $edit_forum_profile->result();
		}
		
	function update_forum_profile()
		{
		$profile_array = array(
			'website' => $this->input->post('website'),
			'signature' => $this->input->post('signature'),
			'location' => $this->input->post('location'),
			'intrests' => $this->input->post('intrests'),
			'occupation' => $this->input->post('occupation'),
			'display_name' => $this->input->post('display_name'),
			'nickname' => $this->input->post('nickname')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function upload_avatar($avatar)
		{
		$upload_array = array(
			'avatar' => $avatar
			);
		$this->db->set($upload_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function update_preferences()
		{
		$profile_array = array(
			'timezone' => $this->input->post('timezones'),
			'daylight_savings' => $this->input->post('daylight_savings')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function update_display_settings()
		{
		$profile_array = array(
			'display_signatures' => $this->input->post('display_signatures'),
			'display_avatars' => $this->input->post('display_avatars')
		);
		$this->db->set($profile_array);
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('profile_fields');
		}
		
	function get_menu_breadcrumbs($items)
		{
		$items_array = explode(',', $items);
		$bread = $this->db
			->where_in('id', $items_array)
			->select('*')
			->from('menu')
			->get();
		return $bread;
		}
		
	function get_gallery($id)
		{
		$gallery = $this->db
			->where('gallery_categories.id', $id)
			->where('gallery_categories.id = gallery_photos.cat_id')
			->select('
				gallery_categories.name,
				gallery_photos.photo_id,
				gallery_photos.cat_id,
				gallery_photos.userfile,
				gallery_photos.desc_one,
				gallery_photos.desc_two,
				gallery_photos.sort_id
			')
			->from('gallery_photos,gallery_categories')
			->order_by('gallery_photos.sort_id', 'asc')
			->get();
		return $gallery;
		}
		
	function related_news($uri)
		{
		$article = $this->db
			->where('blog.url_name', $uri)
			->where('blog_categories.id = post_categories.cat_id')
			->where('blog.blog_id = post_categories.post_id')
			->select('*')
			->from('blog,blog_categories,post_categories')
			->get();
		$tag_array = array();
		foreach($article->result() as $a)
			{
			$tag_id = $a->cat_id;
			if(in_array($tag_id, $tag_array))
				{
				}
			else
				{
				array_push($tag_array, $tag_id);
				}
			}
		$tag_array = implode(', ', $tag_array);
		
		$related = $this->db
			->where_in('post_categories.cat_id', $tag_array)
			->where('post_categories.post_id = blog.blog_id')
			->select('*,
			(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,')
			->from('blog,post_categories')
			->limit(8)
			->get();
			
		return $related;
		}
		
	function get_single_image($id)
		{
		$single = $this->db
			->where('gallery_photos.photo_id', $id)
			->where('gallery_photos.cat_id = gallery_categories.id')
			->select('
				gallery_categories.name,
				gallery_photos.photo_id,
				gallery_photos.cat_id,
				gallery_photos.userfile,
				gallery_photos.desc_one,
				gallery_photos.desc_two,
				gallery_photos.sort_id
				')
			->from('gallery_photos,gallery_categories')
			->get();
		return $single;
		}
		
	function check_banned($user_id)
		{
		$banned = $this->db
			->where('user_id', $user_id)
			->select('*')
			->from('banned_users')
			->get();
		return $banned;
		}
		
	function get_short_articles_main($tag, $subtag, $limit, $exclude)
		{
		$excluded_ids = '';
		$cat_ids = '';
		$excluded = '';
		//$i = 0;
		//$ex = count($exclude);
		//echo $ex;
		for($i = 0; $i <= count($exclude) - 1; $i++)
			{
			$excluded = $this->db
				->where_in('blog_categories.blog_url_cat', $exclude[$i])
				->where('blog_categories.id = post_categories.cat_id')
				->select('post_categories.cat_id')
				->from('blog_categories,post_categories')
				->get();
			}
			
		foreach($excluded->result() as $e)
			{
			$cat_ids .= $e->cat_id . ',';
			}
			//$cat_ids = implode(',', $cat_ids);
			
		//print_r($cat_ids);
			
		$cat_id = $this->db
			->where_in('post_categories.cat_id', array($cat_ids))
			->where('post_categories.post_id = blog.blog_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			//->group_by('cat_id')
			//->limit($limit)
			->get();
		foreach($cat_id->result() as $c)
			{
			$excluded_ids[] = $c->post_id;
			}
			
		if($subtag == '0')
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
					*,
					(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->limit(6)
				->get();
			}
		else
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag,$subtag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
				*,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->limit(6)
				->get();
			}
		return array($news_images, $excluded_ids);
		}
		
	function get_short_articles($tag, $subtag, $limit, $exclude, $total, $offset)
		{
		$excluded_ids = '';
		$cat_ids = '';
		$excluded = '';
		//$i = 0;
		//$ex = count($exclude);
		//echo $ex;
		for($i = 0; $i <= count($exclude) - 1; $i++)
			{
			$excluded = $this->db
				->where_in('blog_categories.blog_url_cat', $exclude[$i])
				->where('blog_categories.id = post_categories.cat_id')
				->select('post_categories.cat_id')
				->from('blog_categories,post_categories')
				->get();
			}
			
		foreach($excluded->result() as $e)
			{
			$cat_ids .= $e->cat_id . ',';
			}
			//$cat_ids = implode(',', $cat_ids);
			
		//print_r($cat_ids);
			
		$cat_id = $this->db
			->where_in('post_categories.cat_id', array($cat_ids))
			->where('post_categories.post_id = blog.blog_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			//->group_by('cat_id')
			//->limit($limit)
			->get();
		foreach($cat_id->result() as $c)
			{
			$excluded_ids[] = $c->post_id;
			}
			
		if($subtag == '0')
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
					*,
					(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->limit($total, $offset)
				->get();
			}
		else
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag,$subtag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
				*,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->limit($total,$offset)
				->get();
			}
		return array($news_images, $excluded_ids);
		}
		
	function short_count_results($tag, $subtag, $limit, $exclude)
		{
		$excluded_ids = '';
		$cat_ids = '';
		$excluded = '';
		//$i = 0;
		//$ex = count($exclude);
		//echo $ex;
		for($i = 0; $i <= count($exclude) - 1; $i++)
			{
			$excluded = $this->db
				->where_in('blog_categories.blog_url_cat', $exclude[$i])
				->where('blog_categories.id = post_categories.cat_id')
				->select('post_categories.cat_id')
				->from('blog_categories,post_categories')
				->get();
			}
			
		foreach($excluded->result() as $e)
			{
			$cat_ids .= $e->cat_id . ',';
			}
			//$cat_ids = implode(',', $cat_ids);
			
		//print_r($cat_ids);
			
		$cat_id = $this->db
			->where_in('post_categories.cat_id', array($cat_ids))
			->where('post_categories.post_id = blog.blog_id')
			->where('blog.active', 'Y')
			->where('blog.lang', $this->config->item('language_abbr'))
			->select('*')
			->from('blog,blog_categories,post_categories')
			->order_by('date', 'desc')
			//->group_by('cat_id')
			//->limit($limit)
			->get();
		foreach($cat_id->result() as $c)
			{
			$excluded_ids[] = $c->post_id;
			}
			
		if($subtag == '0')
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
					*,
					(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->get();
			}
		else
			{
			$news_images = $this->db
				->where_in('blog_categories.blog_url_cat', array($tag,$subtag))
				->where('blog_categories.id = post_categories.cat_id')
				->where('post_categories.post_id = blog.blog_id')
				->where('blog.active', 'Y')
				->where('blog.lang', $this->config->item('language_abbr'))
				->select('
				*,
				(select count(blog_comments.blog_id) from blog_comments where blog_comments.blog_id = blog.blog_id) as comment_total,
				')
				->from('blog,blog_categories,post_categories')
				->order_by('date', 'desc')
				->group_by('blog_id')
				->get();
			}
		return array($news_images, $excluded_ids);
		}
	}
?>