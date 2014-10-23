<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
    
        $id = isset($params['id']) ? $params['id'] : '0';
		$gallery = $this->frontend_model->get_gallery($id);
		$str = '<div style="float:left;">';
		foreach($gallery->result() as $img)
			{
		if($this->config->item("language_abbr") == "en")
			{
			$desc = $img->desc_one;
			}
		else
			{
			$desc = $img->desc_two;
			}
			$str .= '<figure class="col-xs-3 col-md-2"><a class="thumbnail lytebox" href="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/normal/'.$img->userfile.'" data-lyte-options="group:'.$img->name.'" date-title="'.$desc.'"><img src="'.base_url().'assets/gallery/photos/'.url_title($img->name).'/thumbs/'.$img->userfile.'" alt="" /></a></figure>';
			}
		$str .= '</div><div class="clearfix"></div><br />';
        return $str;
    }
}