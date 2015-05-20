<?php foreach($query->result() as $id):?>
<article class="news">
<h3><?php echo $id->name?></h3>
<div class="news_bottom clearfix"><?php echo $id->postedby?> <?php echo $this->lang->line('label_blog_on');?> <?php echo $id->date?>
<a href="<?php echo site_url();?>news/comments/<?php echo $id->blog_id?>"> <?php echo $this->lang->line('label_comments');?></a>
<?php echo widget::run('addthis_widget');?>
</article>

<div class="news_content">
<?$blog_str = htmlentities($id->text,ENT_QUOTES,"UTF-8");?>
<?$blog_str = nl2br($blog_str);?>
<?$blog_str = parse_smileys($blog_str, "/assets/images/system_images/smileys/");?>
<?$blog_str = parse_bbcode($blog_str);?>
<?php echo $blog_str;?>
</div>
<br /><br />
<?php endforeach;?>