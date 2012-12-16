<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class stopforumspam
	{

	private $ci;
 	private $api_key;
 	private $endpoint = 'http://www.stopforumspam.com/';

	function __construct($api_key = null)
		{
		$this->ci =& get_instance();
		$this->api_key = $api_key;
		}
		
	
	public function add( $args )
		{				
		// should check first if not already in database
		
		// add api key
		$args['api_key'] = $this->api_key;
		
		// url to poll
		$url = $this->endpoint.'add.php?'.http_build_query($args, '', '&');
		
		// execute
		$response = file_get_contents($url);
		
		return (false == $response ? false : true);
		}
		
	 /**
    * Get record from spammers database.
    *
    * @param array $args associative array containing either one (or all) of these: username / email / ip.
    * e.g. $args = array('email' => 'user@example.com', 'ip' => '8.8.8.8', 'username' => 'Spammer?' );
    * @return object Response.
    */
 	public function get( $args )
		{
		// should check first if not already in database
		
		// url to poll
		$url = $this->endpoint.'api?f=json&'.http_build_query($args, '', '&');
		
		// 
		return $this->poll_json( $url );
		}
		
	 	/**
 	* Check if either details correspond to a known spammer. Checking for username is discouraged.
 	*
 	* @param array $args associative array containing either one (or all) of these: username / email / ip
 	* e.g. $args = array('email' => 'user@example.com', 'ip' => '8.8.8.8', 'username' => 'Spammer?' );
 	* @return boolean
 	*/
	public function is_spammer( $args )
	{
		// poll database
		$record = $this->get( $args );
		
		// give the benefit of the doubt
		$spammer = false;
		
		// parse database record
		foreach( $record as $datapoint )
		{
			// not 'success' datapoint AND spammer
			if ( isset($datapoint->appears) && $datapoint->appears == true)
			{
				$spammer = true;
			}
		}
		return $spammer;
	}
 	
 	/**
 	* Get json and decode. Currently used for polling the database, but hoping for future 
 	* json response support, when adding.
 	*
 	* @param string $url The url to get
 	* @return object Response.
 	*/
 	protected static function poll_json( $url )
		{
 		//$json = file_get_contents( $url );
		$curl1 = curl_init();
		curl_setopt ($curl1, CURLOPT_URL, $url);
		curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec($curl1);
		curl_close ($curl1);
 		$object = json_decode($json);
 		//print_r($object);
 		return $object;
		}
	}