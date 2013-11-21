<div class="row">
<div class="col-md-12">
<?php if($mod_con_top == ''):?>
<?php else:?>
<?php foreach($mod_con_top->result() as $ct):?>
<?php if($ct->mode == 'B'):?>
<?php $bbcode = parse_smileys($ct->bbcode, base_url()."assets/images/system_images/smileys/");?>
<?php $bbcode = parse_bbcode($bbcode);?>
<?php echo $bbcode?>
<?php else:?>
<?php widget::run($ct->system_name);?>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>
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
</div>