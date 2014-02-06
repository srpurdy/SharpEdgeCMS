<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
    
        $lat = isset($params['lat']) ? $params['lat'] : '0';
        $lon = isset($params['lon']) ? $params['lon'] : '0';
		$width = isset($params['width']) ? $params['width']: '504';
		$height = isset($params['height']) ? $params['height']: '424';
		$height_g = $height-24;
		$width_g = $width-4;
        
        $str = '<iframe class="gmap" src="http://ongopongo.com/maps/embed.php?z=15&la='.$lat.'&lo='.$lon.'&h='.$height_g.'&w='.$width_g.'&msid=&type=G_NORMAL_MAP&b=no" border="0" style="border:0px; width: '.$width.'px; height: '.$height.'px;"></iframe>';
        return $str;
    }
}