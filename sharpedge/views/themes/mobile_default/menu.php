<div id="navigation">
<ul class="level_1">
<?php foreach($menu->result() as $link): 
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
  <li><a style="display: inline;" <?php if( ('/'.$link->link) == $this->uri->uri_string() ){ echo 'class="select"';}?> id="nav_<?php echo url_title($link->text)?>" href="<?php if($link->use_page == 'Y'):?><?php echo site_url();?><?php echo $page_link?><?php else:?><?php echo $link->link?><?php endif;?>" title="<?php echo $link->text?>"><?php echo $link->text?></a>
<?php if($link->has_child == 'Y'):?>
<ul class="level_2">
<?php foreach($menu->result() as $sublink):
if($sublink->parent_id == $link->id):?>
<?php if($this->config->item('short_url') == 1)
{
$subpage_link = str_replace('pages/view/', '', $sublink->page_link);
}
else
{
$subpage_link = $sublink->page_link;
}
?>
  <li><a style="display: block;" href="<?php if($sublink->use_page == 'Y'):?><?php echo site_url();?><?php echo $subpage_link?><?php else:?><?php echo $sublink->link?><?php endif;?>" title="<?php echo $sublink->text?>" ><?php echo $sublink->text?></a>
<?php if($sublink->has_sub_child == 'Y'):?>
<ul class="level_3">
<?php foreach($menu->result() as $sublink2):
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
<li><a style="display: block;" href="<?php if($sublink2->use_page == 'Y'):?><?php echo site_url();?><?php echo $subpage_link2?><?php else:?><?php echo $sublink2->link?><?php endif;?>" title="<?php echo $sublink2->text?>"><?php echo $sublink2->text?></a></li>
<?php endif; endforeach; ?>
</ul>
<!--level_2-->
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
</div>
<!--navigaion-->