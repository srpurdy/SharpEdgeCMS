<h3><?php echo $this->lang->line('label_gallery_page');?></h3><br />
<ul class="thumbnails">
<?php foreach($query->result() as $pro): ?>
<li class="span3">
<div class="thumbnail">
<a href="<?php echo site_url();?>/gallery/event/<?php echo $pro->url_name?>">
<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo $pro->url_name;?>/thumbs/<?php echo $pro->recent_image?>" alt="" width="200" height="114" />
</a>
<h6 style="font-size:0.9em;"><?php echo word_limiter($pro->name, 3);?></h6>
</div>
</li>
<?php endforeach;?>
</ul>