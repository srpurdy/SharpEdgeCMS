<?php foreach($sub_cats->result() as $pro): ?>
<figure class="col-xs-3 col-md-2">
<a href="<?php echo site_url();?>/gallery/event/<?php echo $pro->url_name?>">
<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo $pro->url_name;?>/thumbs/<?php echo $pro->recent_image?>" alt="" />
</a>
<h6><?php echo word_limiter($pro->name, 3);?></h6>
</figure>
<?php endforeach;?>
<div class="clearfix"></div>
<h3><?php echo $heading?></h3>
<?php foreach($gallery->result() as $img): ?>
<figure class="col-xs-3 col-md-2">
	<a class="thumbnail lytebox" href="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/normal/<?php echo $img->userfile?>" data-lyte-options="group:<?php echo $heading?>" date-title="<?php if($this->config->item('language_abbr') == 'en'):?><?php echo $img->desc_one?><?php else:?><?php echo $img->desc_two?><?php endif;?>">
		<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/thumbs/<?php echo $img->userfile?>" alt="" />
	</a>
</figure>
<?php endforeach;?>