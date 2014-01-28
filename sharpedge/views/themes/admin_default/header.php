<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->config->item('language_abbr');?>" lang="<?php echo $this->config->item('language_abbr');?>">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<title>SharpEdge CMS | <?php echo $heading?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="content-type" content="text/html; charset=<?php echo config_item('charset');?>" />
		<meta name="robots" content="<?php echo $this->config->item('robots');?>" />
		<meta name="description" content="<?php echo $this->config->item('description');?>" />
		<meta name="keywords" content="<?php echo $this->config->item('keywords');?>" />
		<meta name="generator" content="<?php echo $this->config->item('generator');?>" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/favicon.ico" /> 
		<!-- MAIN Template CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>themes/<?php echo $admin_theme?>/css/default.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>themes/<?php echo $admin_theme?>/css/responsive.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery_ui/themes/<?php echo $j_ui_theme?>/jquery-ui.css" media="screen" type="text/css" />
		<!-- Javascript tools js -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/site_<?php require('combine.php'); ?>.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>themes/<?php echo $admin_theme?>/js/default.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(this).scrollTop(0);
		});
		</script>
		<script type="text/javascript">document.documentElement.className = 'js';</script><!-- HIDE JS ENABLED - S.E.O. HELPER -->
		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			$('#tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
			})
		</script>
	</head>
	
	<body>
	<?php $this->load->view('themes/' . $admin_theme . '/menu');?>
		<div class="main_header">
			<div class="container">
			<h2><?php echo $heading;?></h2>
			</div>
		</div>
		
		<div class="clearfix"></div><br />
		<div class="container se_container min-height">
