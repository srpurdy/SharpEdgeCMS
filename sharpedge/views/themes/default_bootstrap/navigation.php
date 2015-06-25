			<div class="navbar navbar-default">
				<div class="navbar-inner">
					
						<div class="navbar-header">
						<button class="navbar-toggle" data-toggle="collapse" data-target="#main_menu" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						</div>
						
						<nav id="main_menu" class="navbar-collapse collapse">
							<ul class="nav navbar-nav">
<?php foreach($nav->result() as $link): 
if($link->parent_id == '0'):?>
<?php if($this->config->item('short_url') == 1)
{
$page_link = str_replace('pages/view/', '', $link->page_link);
}
else
{
$page_link = $link->page_link;
}
?>
							<li <?php if($link->has_child == 'Y'):?>class="dropdown<?php if( ($this->config->item('language_abbr') . $page_link) == $this->config->item('language_abbr') . $this->uri->uri_string() ){ echo ' active';}?> <?php if( ($link->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?>"<?php endif;?> <?php if($link->has_child == 'N'):?><?php if( ($this->config->item('language_abbr') . $page_link) == $this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'class="active"';}?><?php if( ($link->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'class="active"';}?><?php endif;?>><a href="<?php if($link->use_page == 'Y'):?><?php echo site_url();?><?php echo $page_link?><?php else:?><?php echo $link->link?><?php endif;?>"><?php echo $link->text?></a>
<?php if($link->has_child == 'Y'):?>
								<ul class="dropdown-menu">
<?php foreach($nav->result() as $sublink):
if($sublink->parent_id == $link->id AND $sublink->child_id == '0'):?>
<?php if($this->config->item('short_url') == 1)
{
$subpage_link = str_replace('pages/view/', '', $sublink->page_link);
}
else
{
$subpage_link = $sublink->page_link;
}
?>
								<li><a class="<?php if( ($this->config->item('language_abbr') . $subpage_link) == $this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?><?php if( ($sublink->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?>" href="<?php if($sublink->use_page == 'Y'):?><?php echo site_url();?><?php echo $subpage_link?><?php else:?><?php echo $sublink->link?><?php endif;?>"><?php echo $sublink->text?></a>
<?php if($sublink->has_sub_child == 'Y'):?>
									<ul class="dropdown-menu sub-menu">
<?php foreach($nav->result() as $sublink2):
if($sublink2->child_id == $sublink->id):?>
<?php if($this->config->item('short_url') == 1)
{
$subpage_link2 = str_replace('pages/view/', '', $sublink2->page_link);
}
else
{
$subpage_link2 = $sublink2->page_link;
}
?>
									<li><a class="<?php if( ($this->config->item('language_abbr') . $subpage_link2) == $this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?><?php if( ($sublink2->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?>" href="<?php if($sublink2->use_page == 'Y'):?><?php echo site_url();?><?php echo $subpage_link2?><?php else:?><?php echo $sublink2->link?><?php endif;?>"><?php echo $sublink2->text?></a>
<?php if($sublink2->has_sub_child == 'Y'):?>
									<ul class="dropdown-menu sub-menu2">
<?php foreach($nav->result() as $sublink3):
if($sublink3->child_id == $sublink2->id):?>
<?php if($this->config->item('short_url') == 1)
{
$subpage_link3 = str_replace('pages/view/', '', $sublink3->page_link);
}
else
{
$subpage_link3 = $sublink3->page_link;
}
?>
									<li><a class="<?php if( ($this->config->item('language_abbr') . $subpage_link3) == $this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?><?php if( ($sublink3->link) == '/'.$this->config->item('language_abbr') . $this->uri->uri_string() ){ echo 'active';}?>" href="<?php if($sublink3->use_page == 'Y'):?><?php echo site_url();?><?php echo $subpage_link3?><?php else:?><?php echo $sublink3->link?><?php endif;?>"><?php echo $sublink3->text?></a></li>
<?php endif; endforeach; ?>									
									</ul>
<?php endif; ?>						
									<!--level_4-->
									</li>
<?php endif; endforeach; ?>
									</ul>
									<!--level_3-->
<?php endif; ?>
								</li>
<?php endif; endforeach; ?>
								</ul>
								<!--level_2-->
<?php endif; ?>
								</li>
<?php endif; endforeach; echo "\n" ?>
							</ul>
							<!--level_1-->
						</nav>
				</div>
			</div>