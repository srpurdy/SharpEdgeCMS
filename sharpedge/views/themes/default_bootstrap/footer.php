
</div>
</div>
<footer class="footer">
<div class="container">
<br />
<p><?php echo $this->config->item('copyright');?><br />
<?php echo $this->config->item('generator');?></p>
</div>
</footer>
<script type="text/javascript">
(function(){
	function getScript(url,success){
	var script=document.createElement('script');
	script.src=url;
	var head=document.getElementsByTagName('head')[0],
	done=false;
		script.onload=script.onreadystatechange = function(){
			if ( !done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') ) {
			done=true;
			success();
			script.onload = script.onreadystatechange = null;
			head.removeChild(script);
			}
		};
	head.appendChild(script);
	}
	
        getScript('<?php echo base_url();?>assets/js/site_<?php require('combine.php'); ?>.js',function(){
			$(document).ready(function(){
				$("img.lazy").lazyload({
					effect : "fadeIn"
				});
				
			$('#paypal_form').trigger('click');
			});
			
			$(document).ready(function(){
				$(document).on('click','.reply_comment',function(e){
					e.preventDefault();
					var reply = $(this);
					var parent_id = reply.data("parent");
					$('#parent').show();
					$('#parent_id').val(parent_id);
					$("html, body").animate({ scrollTop: $('#reply_comment').offset().top }, 1000);
					return false;
					});
					
				$(document).on('click','.product_to_cart',function(e){
					var product_cart = $(this);
					var cart_data = {
						csrf_sharpedgeV320: $("#csrf_protection").val(),
						product: product_cart.data('product')
					};
					
					$('#cart_widget').html('<div class="text-align-center"><img src="<?php echo base_url();?>/assets/images/system_images/loading/dots32.gif" alt="" /></div>');
					$.ajax(
					{
						url: "<?php echo site_url();?>/products/add_to_cart/",
						type: "POST",
						data: cart_data,
						success: function(msg)
						{
							$('#cart_widget').html(msg);
						}
					})
				return false;
				});
				
				$(document).on('click','#update_cart',function(e){
					var rowidInputElements = $('input[name^=rowid]');
					var qtyInputElements = $('input[name^=qty]');
					var cart_data = {
						csrf_sharpedgeV320: $("#csrf_protection").val(),
						rowid: [],
						qty: []
					};
					$.each(rowidInputElements, function(index, el) {
					cart_data.rowid.push($(el).val());
					});
					
					$.each(qtyInputElements, function(index, el) {
					cart_data.qty.push($(el).val());
					});
					
					$('#cart_widget').html('<div class="text-align-center"><img src="<?php echo base_url();?>/assets/images/system_images/loading/dots32.gif" alt="" /></div>');
					$.ajax(
					{
						url: "<?php echo site_url();?>/products/updatecart/",
						type: "POST",
						data: cart_data,
						success: function(msg)
						{
							$('#cart_widget').html(msg);
						}
					})
				return false;
				});
			});
			
			getScript('<?php echo base_url();?>assets/js/flex_slider/jquery.flexslider-min.js',function(){
				$(window).load(function(){
					$('.flexslider_news_landing').flexslider({
						animation: "fade",
						controlNav: "thumbnails",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					});
					
					$('.flexslider_news').flexslider({
						animation: "fade",
						controlNav: "thumbnails",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					});
					
					$('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						$('body').removeClass('loading');
						}
					});
				});
			});
			
			getScript('<?php echo base_url();?>/assets/bootstrap/js/bootstrap.min.js',function(){
			});
			
			getScript('<?php echo base_url();?>/assets/js/lytebox/lytebox.js',function(){
			});
		});
	})();
</script>
<!-- MAIN Template CSS -->
<script type="text/javascript">
(function() {
    var lastTime = 0;
    var vendors = ['webkit', 'moz'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame =
          window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());
var cb = function() {
var l = document.createElement('link'); l.rel = 'stylesheet';
l.href = '<?php echo base_url();?>/themes/<?php echo $theme?>/css/default.css';
var h = document.getElementsByTagName('head')[0]; h.parentNode.insertBefore(l, h);
};
var raf = requestAnimationFrame || mozRequestAnimationFrame ||
  webkitRequestAnimationFrame || msRequestAnimationFrame;
if (raf) raf(cb);
else window.addEventListener('load', cb);
</script>
<noscript><link href="<?php echo base_url();?>/themes/<?php echo $theme;?>/css/default.css" rel="stylesheet"></noscript>
<link rel="stylesheet" property="stylesheet" href="<?php echo base_url();?>assets/js/jquery_ui/themes/<?php echo $j_ui_theme?>/jquery-ui.css" media="screen" type="text/css" />
<link rel="stylesheet" property="stylesheet" href="<?php echo base_url();?>assets/js/lytebox/lytebox.css" media="screen" type="text/css" />

<!-- Google Fonts CSS -->
<?php $fonts = $this->config->item('google_fonts');?>
<link rel="stylesheet" property="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $fonts;?>|Open+Sans+Condensed:700" />

<?php if($this->config->item('disqus_comments') == 1):?>
<script type="text/javascript">
    var disqus_shortname = '<?php echo $this->config->item('disqus_shortname');?>';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//a.disquscdn.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<?php endif;?>
<?php if($this->config->item('google_stats') == 1):?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $this->config->item('google_id');?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php endif;?>
<?php if($admin_logged_in == true):?>
<?php if($this->config->item('benchmark') == 1):?>
<?php $this->output->enable_profiler(TRUE);?>
<?php endif;?>
<?php endif;?>
</body>
