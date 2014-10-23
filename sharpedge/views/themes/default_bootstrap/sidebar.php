<aside class="col-md-3">
	<?php if($mod_side_top == ''):?>
	<?php else:?>
		<?php foreach($mod_side_top->result() as $st):?>
			<?php if($st->mode == 'B'):?>
				<?php $bbcode = parse_smileys($st->bbcode, base_url()."assets/images/system_images/smileys/");?>
				<?php $bbcode = parse_bbcode($bbcode);?>
				<?php echo $bbcode?>
			<?php else:?>
				<?php widget::run($st->system_name);?>
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
	
	<?php if($mod_side_bot == ''):?>
	<?php else:?>
		<?php foreach($mod_side_bot->result() as $sb):?>
			<?php if($sb->mode == 'B'):?>
				<?php $bbcode = parse_smileys($sb->bbcode, base_url()."assets/images/system_images/smileys/");?>
				<?php $bbcode = parse_bbcode($bbcode);?>
				<?php echo $bbcode?>
			<?php else:?>
				<?php widget::run($sb->system_name);?>
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
	
</aside>
