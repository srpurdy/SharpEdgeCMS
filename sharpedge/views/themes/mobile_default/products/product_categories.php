<ul class="thumbnails">
<?php foreach($product_categories->result() as $pro): ?>
<li class="span2b">
<div class="thumbnail">
<a href="<?php echo site_url();?>/products/category/<?php echo $pro->url_category?>">
<img src="<?php echo base_url();?>assets/products/categories/thumbs/<?php echo $pro->userfile?>" alt="" width="145" height="83" />
<?php echo $pro->category_name?></a>
</div>
</li>
<?php endforeach;?>
</ul>