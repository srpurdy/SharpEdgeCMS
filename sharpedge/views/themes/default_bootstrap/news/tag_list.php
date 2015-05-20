<?php foreach($tagged_posts->result() as $id):?>
<article class="news">
<h3><a href="<?php echo site_url();?>/news/comments/<?php echo $id->url_name?>"><?php echo $id->name?></a></h3>

	<div class="news_bottom">
	<?php
		$datestring = "%Y-%m-%d";
		$unix = mysql_to_unix($id->date);
		$human = unix_to_human($unix);
		$date = explode(" ",$unix);
	?>
	<small><?php echo $id->postedby?> <?php echo $this->lang->line('label_blog_on');?> <?php echo date("F j, Y", $date[0]);?>
	<a href="<?php echo site_url();?>/news/comments/<?php echo $id->url_name?><?php if($this->config->item('disqus_comments') == 1):?>/#disqus_thread<?php endif;?>" <?php if($this->config->item('disqus_comments') == 1):?> data-disqus-identifier="<?php echo $id->blog_id;?>" <?php endif;?>><?php echo $id->comment_total?> <?php echo $this->lang->line('label_comments');?></a>
	</small>
	</div>
	
	<div class="news_content">
	<p>
	<?php $blog_str = parse_smileys($id->text, "/assets/images/system_images/smileys/");?>
	<?php $chars = $this->config->item('blog_short_char_limit');?>
	<?php echo truncateHtml($blog_str,$chars);?>
	</p>
	</div>
	
<div class="clearfix"></div>
<br />
<hr />
</article>
<?php endforeach;?>
<div class="clearfix"></div>