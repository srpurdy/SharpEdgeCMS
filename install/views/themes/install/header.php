<!DOCTYPE html>
<?php $base_url_i = str_replace('/install/', '', base_url());?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->config->item('language_abbr');?>" lang="<?php echo $this->config->item('language_abbr');?>">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>SharpEdge - <?php echo $heading?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="cache-control" content="public">
		<link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.ico" /> 
		<!-- MAIN Template CSS -->
		<link rel="stylesheet" href="<?php echo $base_url_i;?>/themes/default_bootstrap/css/default.css" media="screen" type="text/css" />
		
		<!-- MAIN Template JS -->
		<script type="text/javascript" src="<?php echo $base_url_i;?>/assets/js/jquery_ui/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="<?php echo $base_url_i;?>/assets/bootstrap/js/bootstrap.min.js"></script>
	</head>
	
	<body>
	
	<div class="container">