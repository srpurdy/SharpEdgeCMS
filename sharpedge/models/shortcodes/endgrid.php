<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Endgrid extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
		$str = '</div></div>';
        return $str;
    }
}