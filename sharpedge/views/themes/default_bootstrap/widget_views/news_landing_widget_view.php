<style type="text/css">
.news_block{float:left;} 
</style>
<div class="news_heading news_heading_bg">
<h5>Latest News</h5>
<?$i = 0;?>
<?php foreach($news_widget->result() as $id):?>
<?php if($i % 4 == 0):?>
<div style="clear:both;"></div>
<?php endif;?>
<?$i++;?>
<div class="news_block">
<?php if($i == 1 OR $i == 5 OR $i == 9 OR $i == 13 OR $i == 17 OR $i == 21 OR $i == 25):?>
<div class="news" style="margin-left:0px; padding-left:0px;">
<?php elseif($i % 4 == 0):?>
<div class="news" style="margin-right:0px; padding-right:0px;">
<?php else:?>
<div class="news">
<?php endif;?>
<a href="<?=site_url();?>/news/comments/<?=$id->url_name?>"><img src="<?=base_url()?>assets/news/small/<?=$id->userfile?>" width="160" height="87" alt="" /></a><br />
<h4><a href="<?=site_url();?>/news/comments/<?=$id->url_name?>"><?=$id->name?></a></h4>
<div class="news_content">
<p>
<?php $blog_str = parse_smileys($id->text, "/assets/images/system_images/smileys/");?>
<?php $chars = $this->config->item('blog_short_char_limit');?>
<?php echo truncateHtml($blog_str,$chars);?></p>
</div>
<div style="clear: both;"></div>
<br />
</div>
</div>
<?php endforeach;?>
</div>
<div style="clear: both;"></div>
<div class="pagination"><?php echo $this->pagination->create_links();?></div>
<br />
<div style="clear: both;"></div>
<hr />
<br />