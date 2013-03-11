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
		else
			{
			$db_update =  "Database update not required";
			}
			
		$this->update_website_config($version);
		
		return $db_update;
		}
		
	function update_website_config($version)
		{
		$generator = 'SharpEdge Version '.$version.' By PurdyDesigns/NewEdge Development';

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
		. '$config["twitter_url"] = ' . var_export($this->ci->config->item('twitter_url'), true) . ";\n"
		. '$config["facebook_url"] = ' . var_export($this->ci->config->item('facebook_url'), true) . ";\n"
		. '$config["linkedin_url"] = ' . var_export($this->ci->config->item('linkedin_url'), true) . ";\n"
		. '$config["construction"] = ' . var_export($this->ci->config->item('construction'), true) . ";\n" 
		. '$config["allow_register"] = ' . var_export($this->ci->config->item('allow_register'), true) . ";\n"
		. '$config["robots"] = ' . var_export($this->ci->config->item('robots'), true) . ";\n"
		. '$config["description"] = ' . var_export($this->ci->config->item('description'), true) . ";\n"
		. '$config["keywords"] = ' . var_export($this->ci->config->item('keywords'), true) . ";\n"
		. '$config["image_src"] = ' . var_export($this->ci->config->item('image_src'), true) . ";\n"
		. '$config["benchmark"] = ' . var_export($this->ci->config->item('benchmark'), true) . ";\n"
		. '$config["themes_url"] = ' . var_export($this->ci->config->item('themes_url'), true) . ";\n"
		. '$config["assets_url"] = ' . var_export($this->ci->config->item('assets_url'), true) . ";\n"
		. '$config["gallery_url"] = ' . var_export($this->ci->config->item('gallery_url'), true) . ";\n"
		. '$config["global_upload_limit"] = ' . var_export('20000', true) . ";\n"
		. '$config["global_upload_maxwidth"] = ' . var_export('5000', true) . ";\n"
		. '$config["global_upload_maxheight"] = ' . var_export('5000', true) . ";\n"
		. '$config["global_filetypes"] = ' . var_export('jpg|jpeg|gif|png', true) . ";\n"
		. '$config["copyright"] = ' . var_export($this->ci->config->item('copyright'), true) . ";\n"
		. '$config["generator"] = ' . var_export($generator, true) . ";\n" . '?>';	
		write_file(APPPATH . 'config/website_config.php', $data);
		/* use this next update... after 3.36.90
		. '$config["global_upload_limit"] = ' . var_export($this->ci->config->item('global_upload_limit'), true) . ";\n"
		. '$config["global_upload_maxwidth"] = ' . var_export($this->ci->config->item('global_upload_maxwidth'), true) . ";\n"
		. '$config["global_upload_maxheight"] = ' . var_export($this->ci->config->item('global_upload_maxheight'), true) . ";\n"
		. '$config["global_filetypes"] = ' . var_export($this->ci->config->item('global_filetypes'), true) . ";\n"
		*/
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
	}