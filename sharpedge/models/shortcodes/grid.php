<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Grid extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
		$size = isset($params['size']) ? $params['size'] : '4';
		$class =isset($params['class']) ? $params['class'] : 'grid-'.$size.'';
		$classp =isset($params['classp']) ? $params['classp'] : '';
		$str = '<div class="col-sm-'.$size.' col-md-'.$size.' '.$classp.'"><div class="'.$class.'">';
        return $str;
    }
}