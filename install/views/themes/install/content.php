			<div class="row">
				<div class="span12">
<?php if($this->session->flashdata('message')): ?>
					<ul class="<?php echo ($this->session->flashdata('message_type')) ? $this->session->flashdata('message_type') : 'success'; ?>">
						<li><?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }; ?></li>
					</ul>
<?php endif; ?>
				<!-- Message type 2 (validation errors) -->
				<?php if ( validation_errors() ): ?>
					<div id="notification">
						<ul class="failure">
							<?php echo validation_errors('<li>', '</li>'); ?>
						</ul>
					</div>
				<?php endif; ?>
				
<!--START INCLUDED CONTENT-->
<?php isset($page) ? $this->load->view($page) : null;?>
<!--END INCLUDED CONTENT-->
				</div>
