<div id="fb-root"></div>
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-like-box" data-href="<?php echo $this->config->item('facebook_url');?>" data-width="290" data-colorscheme="light" data-show-faces="true" data-stream="true" data-header="true"></div>