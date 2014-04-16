<h3><?php echo $heading?></h3>
	<?php foreach($videos->result() as $img): ?>
	<div class="col-md-3 thumbnail">
		<img src="<?php echo base_url();?>assets/videos/medium/<?php echo $img->userfile?>" alt="" />
		<h5><a href="<?php echo site_url();?>/videos/video/<?php echo $img->url_name;?>"><?php echo $img->name;?></a></h5>
	</div>
	<?php endforeach;?>