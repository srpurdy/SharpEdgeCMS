
</div>
</div>
<footer class="footer">
<div class="container">
<br />
<p><?php echo $this->config->item('copyright');?><br />
<?php echo $this->config->item('generator');?> & Omega Communications</p>
</div>
</footer>
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
