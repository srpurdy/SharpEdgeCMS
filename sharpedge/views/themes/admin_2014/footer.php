
</div>
</div>
<div class="footer">
<div class="container">
<br />
<p>Copyright &copy; 2008-2014 Omega Communications / NewEdge Development All Rights Reserved<br />
<?php echo $this->config->item('generator');?></p>
</div>
</div>
<input type="hidden" value="<?php echo $this->security->get_csrf_hash() ?>" id="csrf_protection" />
<?php $logged_in = $this->ion_auth->is_admin();
if($logged_in == true):?>
<?php if($this->config->item('benchmark') == 1):?>
<?$this->output->enable_profiler(TRUE);?>
<?php endif;?>
<?php endif;?>
</body>
