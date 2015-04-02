<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Page_parallax extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
    
        $id = isset($params['id']) ? $params['id'] : '0';
		$page = $this->site_frontend_model->get_page($id);
		$close_main = isset($params['close_main']) ? $params['close_main'] : 'N';
		$offset = isset($params['offset']) ? $params['offset'] : '130';
		if($close_main == 'Y')
			{
			$str = '</section></main></div></div>';
			}
		foreach($page->result() as $id)
			{
			$name = isset($params['name']) ? $params['name'] : 'page_parallax'.$id->id;
			$str .= '<a id="pp'.$id->id.'" name="pp'.$id->id.'" style="width:100%;display:block;position:absolute;height:'.$offset.'px; margin-top:-'.$offset.'px"></a><section id="'.$name.'"><div class="container"><div class="row">';
			$str .= '<div class="col-md-12">'.$this->shortcodes->parse($id->text).'</div>';
			}
		$str .= '</div></div></section>';
        return $str;
    }
}