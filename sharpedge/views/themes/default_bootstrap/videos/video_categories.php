<?php foreach($video_categories->result() as $vid): ?>
<div class="col-md-4">
<h4><a class="thumbnail" href="<?php echo site_url();?>/videos/category/<?php echo $vid->video_url_cat?>"><?php echo $vid->video_cat;?></a></h4>
</div>
<?php endforeach;?>