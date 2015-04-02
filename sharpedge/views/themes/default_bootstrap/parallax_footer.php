<footer class="footer">
<div class="container">
<br />
<p><?php echo $this->config->item('copyright');?><br />
<?php echo $this->config->item('generator');?></p>
</div>
</footer>
<!-- MAIN Template CSS -->
<link rel="stylesheet" property="stylesheet" href="<?php echo base_url();?>themes/<?php echo $theme?>/css/default.css" media="screen" type="text/css" />
<link rel="stylesheet" property="stylesheet" href="<?php echo base_url();?>assets/js/jquery_ui/themes/<?php echo $j_ui_theme?>/jquery-ui.css" media="screen" type="text/css" />
<link rel="stylesheet" property="stylesheet" href="<?php echo base_url();?>assets/js/lytebox/lytebox.css" media="screen" type="text/css" />

<!-- Google Fonts CSS -->
<?php $fonts = explode("|", $this->config->item('google_fonts'));?>
<?php for($f = 0; $f < count($fonts); $f++):?>
<link rel="stylesheet" property="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=<?php echo $fonts[$f];?>" />
<?php endfor;?>
<link rel="stylesheet" property="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" />
<script type="text/javascript">
$(document).ready(function()
	{
		 $("img.lazy").lazyload({
			effect : "fadeIn"
		});
	});
</script>
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
