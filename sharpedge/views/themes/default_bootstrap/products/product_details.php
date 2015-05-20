<h3><?php echo $heading?></h3>
	<?php foreach($product->result() as $img): ?>
	<div class="col-xs-3 col-md-5 remove_padding">
		<a href="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" rel="lytebox"><img src="<?php echo base_url();?>assets/products/normal/<?php echo $img->userfile?>" alt="" /></a>
	</div>
	<div class="col-xs-3 col-md-5">
	<h5><?php echo $img->product_name;?></h5>
	<div class="alert alert-success"><?php if($img->currency == 'CAD' OR $img->currency == 'USD'):?>$<?php endif;?><?php if($img->currency == 'GBP'):?>&pound;<?php endif;?><?php if($img->price == '0.00'):?><?php else:?><?php echo $img->price;?><?php endif;?></div>
		<p>
		<?php if($img->stock == -1):?>
		<?php echo $this->lang->line('label_many_stock');?>
		<?php elseif($img->stock == 0):?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_out_of_stock');?>
		<?php else:?>
		<?php echo $img->stock;?> <?php echo $this->lang->line('label_in_stock');?>
		<?php endif;?>
		</p>
		<?php $product_desc = $img->desc;?>
		<p><?php echo $product_desc;?></p>
		<?php if($this->config->item('product_allow_cart') == true):?>
			<?php echo form_open('products/add_to_cart_view');?>
			<fieldset>
			<input type="hidden" name="product" value="<?php echo $img->product_id?>"/>
			<button class="btn btn-primary pull-left product_to_cart" data-product="<?php echo $img->product_id?>"><span class="glyphicon glyphicon-shopping-cart"></span></button>
			</fieldset>
			<?php echo form_close();?>
		<?php endif;?>
	</div>
	<?php endforeach;?>
<div class="clearfix"></div><br />
<div id="post_gallery">
</div>
<script type="text/javascript">
// Our simplified "load" function accepts a URL and CALLBACK parameter.
load('/products/ajax_gallery/'+ <?php echo $img->gallery_id;?>, function(xhr) {
    document.getElementById('post_gallery').innerHTML = xhr.responseText;
});
 
function load(url, callback) {
        var xhr;
         
        if(typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
        else {
            var versions = ["MSXML2.XmlHttp.5.0", 
                            "MSXML2.XmlHttp.4.0",
                            "MSXML2.XmlHttp.3.0", 
                            "MSXML2.XmlHttp.2.0",
                            "Microsoft.XmlHttp"]
 
             for(var i = 0, len = versions.length; i < len; i++) {
                try {
                    xhr = new ActiveXObject(versions[i]);
                    break;
                }
                catch(e){}
             } // end for
        }
         
        xhr.onreadystatechange = ensureReadiness;
         
        function ensureReadiness() {
            if(xhr.readyState < 4) {
                return;
            }
             
            if(xhr.status !== 200) {
                return;
            }
 
            // all is well  
            if(xhr.readyState === 4) {
                callback(xhr);
            }           
        }
         
        xhr.open('GET', url, true);
        xhr.send('');
    }
</script>