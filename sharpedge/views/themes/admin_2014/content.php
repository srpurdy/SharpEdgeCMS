<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $heading;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                <div class="col-lg-12">
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
