<h3><?php echo $heading?></h3>
<ul class="thumbnails">
	<?php foreach($gallery->result() as $img): ?>
	<li class="span3">
		<a class="thumbnail lytebox" href="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/normal/<?php echo $img->userfile?>" data-lyte-options="group:<?=$heading?>" date-title="<?php if($this->config->item('language_abbr') == 'en'):?><?php echo $img->desc_one?><?php else:?><?php echo $img->desc_two?><?php endif;?>">
		<img src="<?php echo base_url();?>assets/gallery/photos/<?php echo url_title($heading);?>/thumbs/<?php echo $img->userfile?>" alt="" width="200" height="114" />
		</a>
	</li>
	<?php endforeach;?>
</ul>