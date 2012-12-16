<script type="text/javascript" src="http://widgets.twimg.com/j/2/widget.js"></script><script type="text/javascript">
<?php $twitter_user = explode('/', $this->config->item('twitter_url'));?>
new TWTR.Widget({version:2,type:'profile',rpp:5,interval:6000,width:290,height:300,theme:{shell:{background:'#a90000',color:'#FFFFFF'},tweets:{background:'#ffffff',color:'#222222',links:'#e60400'}},features:{scrollbar:false,loop:false,live:false,hashtags:true,timestamp:true,avatars:false,behavior:'all'}}).render().setUser('<?=$twitter_user[4];?>').start();
</script>