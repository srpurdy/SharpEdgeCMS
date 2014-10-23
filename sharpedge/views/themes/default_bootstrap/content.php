
			<div class="row">
				<main class="col-md-9">

				<!--START INCLUDED CONTENT-->
				
				<?php isset($page) ? $this->load->view($page) : null;?>
				
				<!--END INCLUDED CONTENT-->

<?php if($mod_con_bot == ''):?>
<?php else:?>
<?php foreach($mod_con_bot->result() as $cb):?>
<?php if($cb->mode == 'B'):?>
<?php $bbcode = parse_smileys($cb->bbcode, base_url()."assets/images/system_images/smileys/");?>
<?php $bbcode = parse_bbcode($bbcode);?>
					<?php echo $bbcode?>
<?php else:?>
					<?php widget::run($cb->system_name);?>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>

				</main>
