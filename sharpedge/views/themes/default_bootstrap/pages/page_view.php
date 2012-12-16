<?php if($page_hide == 'Y'):?>
<?php $logged_in = $this->ion_auth->is_admin();?>
<?php if($logged_in == true):?>
<div id='pages'>
<?php $page_str = parse_smileys($page_text, base_url()."assets/images/system_images/smileys/");?>
<?php $page_str = parse_bbcode($page_str);?>
<?php echo $page_str?>
<?php endif;?>
<?php else:?>
<div id='pages'>
<?php $page_str = parse_smileys($page_text, base_url()."assets/images/system_images/smileys/");?>
<?php $page_str = parse_bbcode($page_str);?>
<?php echo $page_str?>
<?php endif;?>
</div>