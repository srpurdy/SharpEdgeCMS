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
	}