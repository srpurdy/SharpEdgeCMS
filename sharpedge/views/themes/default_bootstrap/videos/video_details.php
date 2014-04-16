<h2><?php echo $heading?></h2>
	<?php foreach($video->result() as $img): ?>
	<div class="col-md-12" style="padding:0px;">
		<div class="video-container">
		<iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $img->vid;?>" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="col-md-5" style="padding:0px;">
	<p><?php echo $img->text;?></p>
	</div>
	<?php endforeach;?>