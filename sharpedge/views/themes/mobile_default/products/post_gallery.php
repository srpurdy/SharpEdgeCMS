<ul class="thumbnails">
<?php foreach($post_gallery->result() as $img):?>
	<li class="span2b">
		<a class="thumbnail lytebox" href="<?=base_url();?>assets/gallery/photos/<?=url_title($heading);?>/normal/<?=$img->userfile?>" data-lyte-options="group:<?=$heading?>" date-title="<?php if($this->config->item('language_abbr') == 'en'):?><?=$img->desc_one?><?php else:?><?=$img->desc_two?><?php endif;?>">
		<img src="<?=base_url();?>assets/gallery/photos/<?=url_title($heading);?>/thumbs/<?=$img->userfile?>" alt="" width="200" height="114" />
		</a>
	</li>
	<?php endforeach;?>
</ul>