<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Nav extends CI_Model
{
    function __construct ()
    {
        parent::__construct();
    }
    
    public function run($params = array()){
    
        $id = isset($params['id']) ? $params['id'] : '0';
		$theme = isset($params['theme']) ? $params['theme'] : 'navbar-default';
		$pos = isset($params['pos']) ? $params['pos'] : '';
		$get_nav = $this->frontend_model->get_nav_by_id($id);
		$type = isset($params['type']) ? $params['type'] : 'bar'; //bar or pills
		if($type == 'bar')
			{
			$str = '<div class="clearfix"></div><div class="navbar '.$theme.' '.$pos.'">';
			$str .= '<div class="navbar-inner">';
			$str .= '<div class="navbar-header">
							<button class="navbar-toggle" data-toggle="collapse" data-target="#main_menu_'.$id.'" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							</div>';
							
			$str .= '<nav id="main_menu_'.$id.'" class="navbar-collapse collapse">';
			$str .= '<ul class="nav navbar-nav">';
			}
		elseif($type == 'pills')
			{
			$str .= '<div class="clearfix"></div><ul class="nav nav-pills nav-stacked">';
			}
		elseif($type == 'tabs')
			{
			$str .= '<div class="clearfix"></div><ul class="nav nav-tabs">';
			}
		foreach($get_nav->result() as $link)
			{
			if($link->parent_id == '0')
				{
				if($this->config->item('short_url') == 1)
					{
					$page_link = str_replace('pages/view/', '', $link->page_link);
					}
				else
					{
					$page_link = $link->page_link;
					}
				$str .= '<li ';
				if($link->has_child == 'Y')
					{
					$str .= 'class="dropdown';
					if( ($this->config->item('language_abbr') . $page_link) == $this->config->item('language_abbr') . $this->uri->uri_string() )
						{
						$str .= ' active';
						if( ($link->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
							{
							$str .= ' active';
							}
						}
					$str .= '"';
					}
				if($link->has_child == 'N')
					{
					if( ($this->config->item('language_abbr') . $page_link) == $this->config->item('language_abbr') . $this->uri->uri_string() )
						{
						$str .= 'class="active"';
						if( ($link->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
							{
							$str .= 'class="active"';
							}
						}
					}
				$str .= '><a href="';
				if($link->use_page == 'Y')
					{
					$str .= site_url() . @$subpage_link;
					}
				else
					{
					$str .= $link->link;
					}
				$str .= '">';
				$str .= $link->text;
				$str .= '</a>';
				if($link->has_child == 'Y')
					{
					$str .= '<ul class="dropdown-menu">';
					foreach($get_nav->result() as $sublink)
						{
						if($sublink->parent_id == $link->id AND $sublink->child_id == '0')
							{
							if($this->config->item('short_url') == 1)
								{
								$subpage_link = str_replace('pages/view/', '', $sublink->page_link);
								}
							else
								{
								$subpage_link = $sublink->page_link;
								}
							$str .= '<li ';
							if($sublink->has_child == 'Y')
								{
								$str .= 'class="dropdown';
								if( ($this->config->item('language_abbr') . $subpage_link) == $this->config->item('language_abbr') . $this->uri->uri_string() )
									{
									$str .= ' active';
									if( ($sublink->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
										{
										$str .= ' active';
										}
									}
								$str .= '"';
								}
							if($sublink->has_child == 'N')
								{
								if( ($this->config->item('language_abbr') . $subpage_link) == $this->config->item('language_abbr') . $this->uri->uri_string() )
									{
									$str .= 'class="active"';
									if( ($sublink->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
										{
										$str .= 'class="active"';
										}
									}
								}
							$str .= '><a href="';
							if($sublink->use_page == 'Y')
								{
								$str .= site_url() . $subpage_link;
								}
							else
								{
								$str .= $sublink->link;
								}
							$str .= '">';
							$str .= $sublink->text;
							$str .= '</a>';
							if($sublink->has_sub_child == 'Y')
								{
								$str .= '<ul class="dropdown-menu sub-menu">';
								foreach($get_nav->result() as $sublink2)
									{
									if($sublink2->child_id == $sublink->id)
										{
										if($this->config->item('short_url') == 1)
											{
											$subpage_link2 = str_replace('pages/view/', '', $sublink2->page_link);
											}
										else
											{
											$subpage_link2 = $sublink2->page_link;
											}
										$str .= '<li ';
										if($sublink2->has_child == 'Y')
											{
											$str .= 'class="dropdown';
											if( ($this->config->item('language_abbr') . $subpage_link2) == $this->config->item('language_abbr') . $this->uri->uri_string() )
												{
												$str .= ' active';
												if( ($sublink2->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
													{
													$str .= ' active';
													}
												}
											$str .= '"';
											}
										if($sublink2->has_child == 'N')
											{
											if( ($this->config->item('language_abbr') . $subpage_link2) == $this->config->item('language_abbr') . $this->uri->uri_string() )
												{
												$str .= 'class="active"';
												if( ($sublink2->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
													{
													$str .= 'class="active"';
													}
												}
											}
										$str .= '><a href="';
										if($sublink2->use_page == 'Y')
											{
											$str .= site_url() . $subpage_link2;
											}
										else
											{
											$str .= $sublink2->link;
											}
										$str .= '">';
										$str .= $sublink2->text;
										$str .= '</a>';
										if($sublink2->has_sub_child == 'Y')
											{
											$str .= '<ul class="dropdown-menu sub-menu2">';
											foreach($get_nav->result() as $sublink3)
												{
												if($sublink3->child_id == $sublink2->id)
													{
													if($this->config->item('short_url') == 1)
														{
														$subpage_link3 = str_replace('pages/view/', '', $sublink3->page_link);
														}
													else
														{
														$subpage_link3 = $sublink3->page_link;
														}
													$str .= '<li ';
													if($sublink3->has_child == 'Y')
														{
														$str .= 'class="dropdown';
														if( ($this->config->item('language_abbr') . $subpage_link3) == $this->config->item('language_abbr') . $this->uri->uri_string() )
															{
															$str .= ' active';
															if( ($sublink3->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
																{
																$str .= ' active';
																}
															}
														$str .= '"';
														}
													if($sublink3->has_child == 'N')
														{
														if( ($this->config->item('language_abbr') . $subpage_link3) == $this->config->item('language_abbr') . $this->uri->uri_string() )
															{
															$str .= 'class="active"';
															if( ($sublink3->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() )
																{
																$str .= 'class="active"';
																}
															}
														}
													$str .= '><a href="';
													if($sublink3->use_page == 'Y')
														{
														$str .= site_url() . $subpage_link3;
														}
													else
														{
														$str .= $sublink3->link;
														}
													$str .= '">';
													$str .= $sublink3->text;
													$str .= '</a>';
													}
												}
											$str .= '</ul>';
											}
										$str .= '</li>';
										}
									}
								$str .= '</ul>';
								}
							$str .= '</li>';
							}
						}
					$str .= '</ul>';
					}
				$str .= '</li>';
				}
			$str .= '</li>';
			}
		$str .= '</ul></nav></div></div>';
        return $str;
    }
}