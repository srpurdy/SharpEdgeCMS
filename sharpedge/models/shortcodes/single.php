<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Single extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
		//[ai:single id=56|size=thumb|full_size=true|align=left]
        $id = isset($params['id']) ? $params['id'] : '0';
		//thumb or normal
		$size = isset($params['size']) ? $params['size'] : 'thumb';
		$full_size = isset($params['full_size']) ? $params['full_size'] : 'true';
		$align = isset($params['align']) ? $params['align'] : 'left';
		$single = $this->frontend_model->get_single_image($id);
		$str = '';
		foreach($single->result() as $img)
			{
			if($this->config->item("language_abbr") == "en")
				{
				$desc = $img->desc_one;
				}
			else
				{
				$desc = $img->desc_two;
				}
			if($size == 'thumb' AND $full_size == 'true')
				{
				$str .= '<a class="lytebox" href="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/normal/'.$img->userfile.'" data-lyte-options="group:'.$img->name.'" date-title="'.$desc.'"><img align="'.$align.'" src="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/thumbs/'.$img->userfile.'" alt="" /></a>';
				}
			else if ($size == 'thumb' AND $full_size == 'false')
				{
				$str .= '<img align="'.$align.'" src="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/thumbs/'.$img->userfile.'" alt="" />';
				}
			else if ($size == 'normal')
				{
				$str .= '<img align="'.$align.'" src="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/normal/'.$img->userfile.'" alt="" />';
				}
			}
        return $str;
    }
}