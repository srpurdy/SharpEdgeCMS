<?php foreach($product_categories->result() as $pro): ?>
<div class="col-xs-3 col-md-4">
<a href="<?php echo site_url();?>/products/category/<?php echo $pro->url_category?>">
<img src="<?php echo base_url();?>assets/products/categories/thumbs/<?php echo $pro->userfile?>" alt="" /></a>
<h6><?php echo $pro->category_name?></h6>
</div>
<?php endforeach;?>