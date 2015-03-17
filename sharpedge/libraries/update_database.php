<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class update_database
	{

	private $ci;

	function __construct()
		{
		$this->ci =& get_instance();
		}

	function process_sql($version,$old_version)
		{
		if($old_version == '3.34.40')
			{
			$db_update =  "Updated database 3.34.40 to 3.34.42";
			/*
			$module_array = array(
				'name' => 'Test',
				'content_top' => '0',
				'content_bottom' => '0',
				'side_top' => '0',
				'side_bottom' => '0',
				'slide_id' => '0',
				'container' => '/ctrl_container',
				'is_admin' => 'N',
				'enabled' => 'Y',
				'version' => '0.000'
			);
			$this->ci->db->set($module_array);
			$this->ci->db->insert('modules');
			*/
			}
		else if($old_version == '3.34.43')
			{
			$db_update =  "Updated database 3.34.43 to 3.34.44";
			}
		else if($old_version == '3.34.84')
			{
			$this->three_three_four_nine_zero();
			$db_update =  "Updated database 3.34.84 to 3.34.90";
			}
		else if($old_version == '3.34.95')
			{
			$this->three_three_four_nine_seven();
			$db_update =  "Updated database 3.34.95 to 3.34.97";
			}
		else if($old_version == '3.35.01')
			{
			$this->three_three_six_zero_zero();
			$db_update =  "Updated database 3.35.01 to 3.36.00";
			}
		else if($old_version == '3.36.17')
			{
			$this->three_three_six_two_eight();
			$db_update =  "Updated database 3.36.17 to 3.36.28";
			}
		else if($old_version == '3.36.58')
			{
			$this->three_three_six_seven_zero();
			$db_update =  "Updated database 3.36.58 to 3.36.70";
			}
		else if($old_version == '3.36.94')
			{
			$this->three_three_seven_zero_zero();
			$db_update =  "Updated database 3.36.94 to 3.37.00";
			}
		else if($old_version == '3.37.22')
			{
			$this->three_three_seven_three_zero();
			$db_update =  "Updated database 3.37.22 to 3.37.30";
			}
		else if($old_version == '3.38.22')
			{
			$this->three_three_nine_zero_zero();
			$db_update =  "Updated database 3.38.22 to 3.39.00";
			}
		else if($old_version == '3.39.12')
			{
			$this->three_four_zero_zero_zero();
			$db_update =  "Updated database 3.39.12 to 3.40.00";
			}
		else if($old_version == '3.40.00')
			{
			$this->three_four_zero_one_zero();
			$db_update =  "Updated database 3.40.00 to 3.40.10";
			}
		else if($old_version == '3.40.21')
			{
			$this->three_four_zero_four_zero();
			$db_update =  "Updated database 3.40.21 to 3.40.40";
			}
		else if($old_version == '3.40.46')
			{
			$this->three_four_one_zero_zero();
			$db_update =  "Updated database 3.40.46 to 3.41.00";
			}
		else if($old_version == '3.41.00')
			{
			$this->three_four_one_one_zero();
			$db_update =  "Updated database 3.41.00 to 3.41.10";
			}
		else if($old_version == '3.41.10')
			{
			$this->three_four_one_two_four();
			$db_update =  "Updated database 3.41.10 to 3.41.24";
			}
		else if($old_version == '3.41.40')
			{
			$this->three_four_one_four_one();
			$db_update =  "Updated database 3.41.40 to 3.41.41";
			}
		else
			{
			$db_update =  "Database update not required";
			}
			
		$this->update_website_config($version);
		
		return $db_update;
		}
		
	function update_website_config($version)
		{
		$generator = 'SharpEdge Version '.$version.' By NewEdge Development & Omega Communications';
		
		$this->ci->config->load('website_config', true);
		$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
		. '$config["sitename"] = ' . var_export($this->ci->config->item('sitename'), true) . ";\n" 
		. '$config["site_slogan"] = ' . var_export($this->ci->config->item('site_slogan'), true) . ";\n"
		. '$config["contact_email"] = ' . var_export($this->ci->config->item('contact_email'), true) . ";\n" 
		. '$config["homepage_string"] = ' . var_export($this->ci->config->item('homepage_string'), true) . ";\n" 
		. '$config["short_url"] = ' . var_export($this->ci->config->item('short_url'), true) . ";\n" 
		. '$config["google_stats"] = ' . var_export($this->ci->config->item('google_stats'), true) . ";\n" 
		. '$config["google_id"] = ' . var_export($this->ci->config->item('google_id'), true) . ";\n" 
		. '$config["twitter"] = ' . var_export($this->ci->config->item('twitter'), true) . ";\n" 
		. '$config["facebook"] = ' . var_export($this->ci->config->item('facebook'), true) . ";\n" 
		. '$config["linkedin"] = ' . var_export($this->ci->config->item('linkedin'), true) . ";\n"
		. '$config["googleplus"] = ' . var_export($this->ci->config->item('googleplus'), true) . ";\n"
		. '$config["pinterest"] = ' . var_export($this->ci->config->item('pinterest'), true) . ";\n"
		. '$config["twitter_url"] = ' . var_export($this->ci->config->item('twitter_url'), true) . ";\n"
		. '$config["facebook_url"] = ' . var_export($this->ci->config->item('facebook_url'), true) . ";\n"
		. '$config["linkedin_url"] = ' . var_export($this->ci->config->item('linkedin_url'), true) . ";\n"
		. '$config["googleplus_url"] = ' . var_export($this->ci->config->item('googleplus_url'), true) . ";\n"
		. '$config["pinterest_url"] = ' . var_export($this->ci->config->item('pinterest_url'), true) . ";\n"
		. '$config["construction"] = ' . var_export($this->ci->config->item('construction'), true) . ";\n" 
		. '$config["allow_register"] = ' . var_export($this->ci->config->item('allow_register'), true) . ";\n"
		. '$config["security_register"] = ' . var_export($this->ci->config->item('security_register'), true) . ";\n"
		. '$config["phone_enabled"] = ' . var_export($this->ci->config->item('phone_enabled'), true) . ";\n"
		. '$config["company_enabled"] = ' . var_export($this->ci->config->item('company_enabled'), true) . ";\n"
		. '$config["robots"] = ' . var_export($this->ci->config->item('robots'), true) . ";\n"
		. '$config["description"] = ' . var_export($this->ci->config->item('description'), true) . ";\n"
		. '$config["keywords"] = ' . var_export($this->ci->config->item('keywords'), true) . ";\n"
		. '$config["image_src"] = ' . var_export($this->ci->config->item('image_src'), true) . ";\n"
		. '$config["benchmark"] = ' . var_export($this->ci->config->item('benchmark'), true) . ";\n"
		. '$config["themes_url"] = ' . var_export($this->ci->config->item('themes_url'), true) . ";\n"
		. '$config["assets_url"] = ' . var_export($this->ci->config->item('assets_url'), true) . ";\n"
		. '$config["gallery_url"] = ' . var_export($this->ci->config->item('gallery_url'), true) . ";\n"
		. '$config["global_upload_limit"] = ' . var_export($this->ci->config->item('global_upload_limit'), true) . ";\n"
		. '$config["global_upload_maxwidth"] = ' . var_export($this->ci->config->item('global_upload_maxwidth'), true) . ";\n"
		. '$config["global_upload_maxheight"] = ' . var_export($this->ci->config->item('global_upload_maxheight'), true) . ";\n"
		. '$config["global_filetypes"] = ' . var_export($this->ci->config->item('global_filetypes'), true) . ";\n"
		. '$config["copyright"] = ' . var_export($this->ci->config->item('copyright'), true) . ";\n"
		. '$config["generator"] = ' . var_export($generator, true) . ";\n" . '?>';	
		write_file(APPPATH . 'config/website_config.php', $data);
		}
		
	function three_three_four_nine_zero()
		{
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'email' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '150',
					 ),
				'ip_address' => array(
					 'type' =>'VARCHAR',
					 'constraint' => '100',
					 ),
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('spam_log', TRUE);
		}
		
	function three_three_four_nine_seven()
		{
		$ci =& get_instance();
		
	    $ci->db->query("ALTER TABLE module_permissions ADD INDEX (module_id)");
		$ci->db->query("ALTER TABLE module_permissions ADD INDEX (group_id)");
		
		$ci->db->query("ALTER TABLE users ADD INDEX (username)");
		$ci->db->query("ALTER TABLE users ADD INDEX (email)");
		
		$ci->db->query("ALTER TABLE blog ADD INDEX (url_name)");
		}
		
	function three_three_six_zero_zero()
		{
		$ci =& get_instance();
		
		//Add New URL Column and Sort id
		$ci->db->query("ALTER TABLE gallery_categories ADD COLUMN url_name varchar(125)");
		$ci->db->query("ALTER TABLE gallery_categories ADD COLUMN sort_id int(11)");
		
		//Add Indexes
		$ci->db->query("ALTER TABLE gallery_categories ADD INDEX (url_name)");
		$ci->db->query("ALTER TABLE gallery_categories ADD INDEX (sort_id)");
		
		//Extract Existing Gallery Categories
		$galleries = $ci->db->get('gallery_categories');
		
		foreach($galleries->result() as $g)
			{
			//We will add a new url_category column to the gallery categories.
			$gallery_name = $g->name;
			$gallery_id = $g->id;
			$gallery_array = array(
					'id' => $gallery_id,
					'name' => $gallery_name,
					'url_name' => url_title($gallery_name),
					'sort_id' => '0'
			);
			$ci->db->set($gallery_array);
			$ci->db->where('id', $gallery_id);
			$ci->db->update('gallery_categories');
			}
		}
		
	function three_three_six_two_eight()
		{
		$ci =& get_instance();
		$module_array = array(
			'name' => 'log_admin',
			'content_top' => '0',
			'content_bottom' => '0',
			'side_top' => '0',
			'side_bottom' => '0',
			'slide_id' => '0',
			'container' => '',
			'is_admin' => 'Y',
			'enabled' => 'Y',
			'version' => '0.000'
		);
		$ci->db->set($module_array);
		$ci->db->insert('modules');
		}
		
	function three_three_six_seven_zero()
		{
		//create new tables
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'group_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
				'location_id' => array(
					 'type' =>'INT',
					 'constraint' => 11,
					 ),
				'rel_id' => array(
					 'type' =>'INT',
					 'constraint' => 11,
					 ),
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('module_widgets', TRUE);
		
		$fields2 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'group_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
				'location_id' => array(
					 'type' =>'INT',
					 'constraint' => 11,
					 ),
				'rel_id' => array(
					 'type' =>'INT',
					 'constraint' => 11,
					 ),
		);
		
		$ci->dbforge->add_field($fields2);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('page_widgets', TRUE);
		
		$fields3 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'name' => array(
					 'type' => 'VARCHAR',
					 'constraint' => '100',
					 ),
		);
		
		$ci->dbforge->add_field($fields3);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('widget_locations', TRUE);
		
		//add indexes
		$ci->db->query("ALTER TABLE module_widgets ADD INDEX (group_id)");
		$ci->db->query("ALTER TABLE module_widgets ADD INDEX (location_id)");
		$ci->db->query("ALTER TABLE module_widgets ADD INDEX (rel_id)");
		$ci->db->query("ALTER TABLE page_widgets ADD INDEX (group_id)");
		$ci->db->query("ALTER TABLE page_widgets ADD INDEX (location_id)");
		$ci->db->query("ALTER TABLE page_widgets ADD INDEX (rel_id)");
		
		//create widget locations
		$array1 = array(
			'name' => 'side_top',
		);
		$ci->db->set($array1);
		$ci->db->insert('widget_locations');
		
		$array2 = array(
			'name' => 'side_bottom',
		);
		$ci->db->set($array2);
		$ci->db->insert('widget_locations');
		
		$array3 = array(
			'name' => 'content_top',
		);
		$ci->db->set($array3);
		$ci->db->insert('widget_locations');
		
		$array4 = array(
			'name' => 'content_bottom',
		);
		$ci->db->set($array4);
		$ci->db->insert('widget_locations');
		
		//Now extract all existing pages (and create new data for new widget system based on old data)
		$pages = $ci->db->get('pages');
		foreach($pages->result() as $p)
			{
			if(!$p->side_top == 0)
				{
				$p_w_array1 = array(
					'group_id' => $p->side_top,
					'location_id' => '1',
					'rel_id' => $p->id
				);
				$ci->db->set($p_w_array1);
				$ci->db->insert('page_widgets');
				}
			
			if(!$p->side_bottom == 0)
				{
				$p_w_array2 = array(
					'group_id' => $p->side_bottom,
					'location_id' => '2',
					'rel_id' => $p->id
				);
				$ci->db->set($p_w_array2);
				$ci->db->insert('page_widgets');
				}
			
			if(!$p->content_top == 0)
				{
				$p_w_array3 = array(
					'group_id' => $p->content_top,
					'location_id' => '3',
					'rel_id' => $p->id
				);
				$ci->db->set($p_w_array3);
				$ci->db->insert('page_widgets');
				}
			
			if(!$p->content_bottom == 0)
				{
				$p_w_array4 = array(
					'group_id' => $p->content_bottom,
					'location_id' => '4',
					'rel_id' => $p->id
				);
				$ci->db->set($p_w_array4);
				$ci->db->insert('page_widgets');
				}
			}
			
		//all modules
		$modules = $ci->db->get('modules');
		foreach($modules->result() as $m)
			{
			if(!$m->side_top == 0)
				{
				$m_w_array1 = array(
					'group_id' => $m->side_top,
					'location_id' => '1',
					'rel_id' => $m->id
				);
				$ci->db->set($m_w_array1);
				$ci->db->insert('module_widgets');
				}
			
			if(!$m->side_bottom == 0)
				{
				$m_w_array2 = array(
					'group_id' => $m->side_bottom,
					'location_id' => '2',
					'rel_id' => $m->id
				);
				$ci->db->set($m_w_array2);
				$ci->db->insert('module_widgets');
				}
			
			if(!$m->content_top == 0)
				{
				$m_w_array3 = array(
					'group_id' => $m->content_top,
					'location_id' => '3',
					'rel_id' => $m->id
				);
				$ci->db->set($m_w_array3);
				$ci->db->insert('module_widgets');
				}
				
			if(!$m->content_bottom == 0)
				{
				$m_w_array4 = array(
					'group_id' => $m->content_bottom,
					'location_id' => '4',
					'rel_id' => $m->id
				);
				$ci->db->set($m_w_array4);
				$ci->db->insert('module_widgets');
				}
			}
		}
		
	function three_three_seven_zero_zero()
		{
		$ci =& get_instance();
		$module_array = array(
			'name' => 'tools_admin',
			'content_top' => '0',
			'content_bottom' => '0',
			'side_top' => '0',
			'side_bottom' => '0',
			'slide_id' => '0',
			'container' => '',
			'is_admin' => 'Y',
			'enabled' => 'Y',
			'version' => '0.000'
		);
		$ci->db->set($module_array);
		$ci->db->insert('modules');
		}
		
	function three_three_seven_three_zero()
		{
		$ci =& get_instance();
		
		//Add New URL Column and Sort id
		$ci->db->query("ALTER TABLE pages ADD COLUMN restrict_access enum('Y','N') DEFAULT 'N'");
		$ci->db->query("ALTER TABLE pages ADD COLUMN user_group int(11)");
		
		$ci->db->query("ALTER TABLE page_drafts ADD COLUMN restrict_access enum('Y','N') DEFAULT 'N'");
		$ci->db->query("ALTER TABLE page_drafts ADD COLUMN user_group int(11)");
		}
		
	function three_three_nine_zero_zero()
		{
		//create new tables
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'user_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('banned_users', TRUE);
		
		$ci->db->query("ALTER TABLE gallery_categories ADD COLUMN parent_id int(11)");
		
		$ci->db->query("ALTER TABLE banned_users ADD INDEX (user_id)");
		$ci->db->query("ALTER TABLE gallery_categories ADD INDEX (parent_id)");
		}
		
	function three_four_zero_zero_zero()
		{
		$ci =& get_instance();
		$module_array = array(
			'name' => 'video_admin',
			'content_top' => '0',
			'content_bottom' => '0',
			'side_top' => '0',
			'side_bottom' => '0',
			'slide_id' => '0',
			'container' => '',
			'is_admin' => 'Y',
			'enabled' => 'Y',
			'version' => '0.000'
		);
		$ci->db->set($module_array);
		$ci->db->insert('modules');
		
		$module_array2 = array(
			'name' => 'videos',
			'content_top' => '0',
			'content_bottom' => '0',
			'side_top' => '0',
			'side_bottom' => '0',
			'slide_id' => '0',
			'container' => '/ctrl_container',
			'is_admin' => 'N',
			'enabled' => 'Y',
			'version' => '0.000'
		);
		$ci->db->set($module_array2);
		$ci->db->insert('modules');
		
		//create new tables
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'video_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'date' => array(
					 'type' => 'DATETIME'
					 ),
				'vid' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 100
					 ),
				'postedby' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 ),
				'name' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 ),
				'url_name' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 ),
				'play_time' => array(
					 'type' => 'INT',
					 'constraint' => 11
					 ),
				'text' => array(
					 'type' => 'TEXT',
					 'null' => TRUE
					 ),
				'lang' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 20
					 ),
				'userfile' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 )
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('video_id', TRUE);
		$ci->dbforge->create_table('videos', TRUE);
		
		$fields2 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'video_cat' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 ),
				'video_url_cat' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150
					 ),
				'lang' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 20
					 )
		);
		
		$ci->dbforge->add_field($fields2);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('video_categories', TRUE);
		
		$fields3 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'cat_id' => array(
					 'type' => 'INT',
					 'constraint' => 11
					 ),
				'video_id' => array(
					 'type' => 'INT',
					 'constraint' => 11
					 )
		);
		
		$ci->dbforge->add_field($fields3);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('video_post_categories', TRUE);
		
		$fields4 = array(
				'comment_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'datetime' => array(
					 'type' => 'DATETIME'
					 ),
				'video_id' => array(
					 'type' => 'INT',
					 'constraint' => 11
					 ),
				'message' => array(
					 'type' => 'TEXT',
					 'null' => TRUE
					 ),
				'postedby' => array(
					 'type' => 'INT',
					 'constraint' => 11
					 )
		);
		
		$ci->dbforge->add_field($fields4);
		$ci->dbforge->add_key('comment_id', TRUE);
		$ci->dbforge->create_table('video_comments', TRUE);
		
		$ci->db->query("ALTER TABLE videos ADD COLUMN is_segment enum('Y','N') DEFAULT 'N'");
		$ci->db->query("ALTER TABLE videos ADD COLUMN active enum('Y','N') DEFAULT 'Y'");
		$ci->db->query("ALTER TABLE video_comments ADD COLUMN active enum('Y','N') DEFAULT 'Y'");
		$ci->db->query("ALTER TABLE videos ADD INDEX (date)");
		$ci->db->query("ALTER TABLE videos ADD INDEX (url_name)");
		$ci->db->query("ALTER TABLE videos ADD INDEX (lang)");
		$ci->db->query("ALTER TABLE videos ADD INDEX (is_segment)");
		$ci->db->query("ALTER TABLE videos ADD INDEX (active)");
		$ci->db->query("ALTER TABLE video_categories ADD INDEX (video_url_cat)");
		$ci->db->query("ALTER TABLE video_categories ADD INDEX (lang)");
		$ci->db->query("ALTER TABLE video_post_categories ADD INDEX (cat_id)");
		$ci->db->query("ALTER TABLE video_post_categories ADD INDEX (video_id)");
		$ci->db->query("ALTER TABLE video_comments ADD INDEX (video_id)");
		$ci->db->query("ALTER TABLE video_comments ADD INDEX (active)");
		
		}
		
	function three_four_zero_one_zero()
		{
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$ci->db->query("ALTER TABLE blog_comments ADD COLUMN parent_id int(11) DEFAULT '0'");
		
		$comments = $ci->db->get('blog_comments');
		foreach($comments->result() as $c)
			{
			$comm = array(
				'parent_id' => '0'
			);
			$ci->db->set($comm);
			$ci->db->where('comment_id', $c->comment_id);
			$ci->db->update('blog_comments');
			}
		}
		
	function three_four_zero_four_zero()
		{
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'product_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => 150,
					)
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('shipping_by_product', TRUE);
		
		$ci->db->query("ALTER TABLE shipping_by_product ADD INDEX (product_id)");
		$ci->db->query("ALTER TABLE shipping_by_product ADD COLUMN price decimal(10,2)");
		}
		
	function three_four_one_zero_zero()
		{
		//create new tables
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$fields = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'order_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
					 
				'CustomNotes' => array(
					 'type' => 'TEXT',
					 'null' => TRUE,
					 ),
				'InternalNotes' => array(
					 'type' => 'TEXT',
					 'null' => TRUE,
					 ),
		);
		
		$ci->dbforge->add_field($fields);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('ss_orders', TRUE);
		
		$ci->db->query("ALTER TABLE ss_orders ADD INDEX (order_id)");
		$ci->db->query("ALTER TABLE ss_orders ADD COLUMN ShippingMethod enum('USPS', 'UPS', 'FedEx')");
		$ci->db->query("ALTER TABLE ss_orders ADD COLUMN PaymentMethod enum('PayPal', 'Credit Card', 'Check')");
		
		$ci->db->query("ALTER TABLE orders ADD COLUMN TaxAmount decimal(10,2)");
		$ci->db->query("ALTER TABLE orders ADD COLUMN date datetime");
		$ci->db->query("ALTER TABLE orders ADD COLUMN user_id int(11)");
		
		$ci->db->query("ALTER TABLE products ADD COLUMN SKU varchar(50)");
		$ci->db->query("ALTER TABLE products ADD COLUMN Weight decimal(10,2)");
		$ci->db->query("ALTER TABLE products ADD COLUMN WeightUnits enum('Pounds', 'Ounces', 'Grams')");
		$ci->db->query("ALTER TABLE products ADD COLUMN size_by enum('name', 'number')");
		
		$fields2 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'user_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
				'name' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'company' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 100,
					 ),
				'phone1' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 25,
					 ),
				'phone2' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 25,
					 ),
				'email' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'address1' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'address2' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'city' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 100,
					 ),
				'state' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 100,
					 ),
				'postal' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 50,
					 ),
				'country' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 50,
					 ),
		);
		
		$ci->dbforge->add_field($fields2);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('ss_customer_info', TRUE);
		
		$ci->db->query("ALTER TABLE ss_customer_info ADD INDEX (user_id)");
		
		$fields3 = array(
				'id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => TRUE
					 ),
				'order_id' => array(
					 'type' => 'INT',
					 'constraint' => 11,
					 ),
				'LabelDate' => array(
					 'type' => 'DATETIME',
					 ),
				'ShippingDate' => array(
					 'type' => 'DATETIME',
					 ),
				'Carrier' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'Service' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
				'TrackingNumber' => array(
					 'type' => 'VARCHAR',
					 'constraint' => 150,
					 ),
		);
		
		$ci->dbforge->add_field($fields3);
		$ci->dbforge->add_key('id', TRUE);
		$ci->dbforge->create_table('ss_ship_notify', TRUE);
		
		$ci->db->query("ALTER TABLE products ADD COLUMN ShippingCost decimal(10,2)");
		$ci->db->query("ALTER TABLE ss_ship_notify ADD INDEX (order_id)");
		}
		
	function three_four_one_one_zero()
		{
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$ci->db->query("ALTER TABLE pages ADD COLUMN views int(11)");
		$ci->db->query("ALTER TABLE blog ADD COLUMN views int(11)");
		}
		
	function three_four_one_two_four()
		{
		$this->ci->config->load('template_config', true);
		$data = '<?php' . "\n" . 'if (!defined("BASEPATH")) exit("No direct script access allowed");' . "\n"
		. '$config["theme"] = ' . var_export($this->ci->config->item('theme'), true) . ";\n"
		. '$config["admin_theme"] = ' . var_export($this->ci->config->item('admin_theme'), true) . ";\n"
		. '$config["j_ui_theme"] = ' . var_export($this->ci->config->item('j_ui_theme'), true) . ";\n"
		. '?>';
		write_file(APPPATH . 'config/template_config.php', $data);
		
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$ci->db->query("ALTER TABLE profile_fields ADD COLUMN admin_notify enum('Y','N') DEFAULT 'Y'");
		$ci->db->query("ALTER TABLE profile_fields ADD COLUMN post_notify enum('Y','N') DEFAULT 'Y'");
		}
		
	function three_four_one_four_one()
		{
		$ci =& get_instance();
		$ci->load->dbforge();
		
		$ci->db->query("ALTER TABLE pages ADD COLUMN user_id int(11) DEFAULT '0'");
		$ci->db->query("ALTER TABLE pages ADD COLUMN page_type enum('normal', 'league', 'youtube') DEFAULT 'normal'");
		$ci->db->query("ALTER TABLE blog ADD COLUMN user_id int(11) DEFAULT '0'");
		$ci->db->query("ALTER TABLE pages ADD INDEX (user_id)");
		$ci->db->query("ALTER TABLE blog ADD INDEX (user_id)");
		}
	}