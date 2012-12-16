
			<div class="row">
				<div class="span12">
				<!--START INCLUDED CONTENT-->
<?php if(isset($flashmsg) AND $flashmsg!=''):?>
					<div id="flashmsg" class="alert alert-success" style="display:none;">
					<strong><?php echo $flashmsg?></strong>
					</div>
					<div class="clearfix"></div>
<?php endif;?>
				
<?php isset($page) ? $this->load->view($page) : null;?>
				
				<!--END INCLUDED CONTENT-->
				</div>
