<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=138801749505399";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-page" data-href="<?php echo $this->config->item('facebook_url');?>" data-width="300" data-height="300" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo $this->config->item('facebook_url');?>"><a href="<?php echo $this->config->item('facebook_url');?>"><?php echo $this->config->item('sitename');?></a></blockquote></div></div>