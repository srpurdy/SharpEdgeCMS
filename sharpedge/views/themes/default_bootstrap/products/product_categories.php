<ul class="thumbnails">
<?php foreach($product_categories->result() as $pro): ?>
<li>
<div class="thumbnail">
<a href="<?php echo site_url();?>/products/category/<?php echo $pro->url_category?>">
<img src="<?php echo base_url();?>assets/products/categories/thumbs/<?php echo $pro->userfile?>" alt="" width="300" height="171" /></a>
<h6><?php echo $pro->category_name?></h6>
</div>
</li>
<?php endforeach;?>
</ul>