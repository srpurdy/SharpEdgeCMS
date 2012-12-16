<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function form_ckeditor($data = '', $value = '', $extra = '')
	{
	$CI =& get_instance();

	$ckeditor_basepath = '/assets/js/ckeditor/';

	require_once( $_SERVER["DOCUMENT_ROOT"] . $ckeditor_basepath. 'ckeditor.php' );
	//if data is an array then extract name else instanceName is $data
	$instanceName = ( is_array($data) && isset($data['name'])  ) ? $data['name'] : $data;
	$ckeditor = new CKEditor();
	$ckeditor->Value = html_entity_decode($value);
	$initialValue = $value;
	$ckeditor->basePath = $ckeditor_basepath;

	//todo
	if( is_array($data) )
	{
	}
	$config['toolbar'] = array(
		array('Format', 'Source', 'Maximize', 'ShowBlocks', 'Preview'),
		array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
		array('Find', 'Replace', 'SelectAll', 'SpellChecker', 'Scayt'),
		array('Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'),
		array('NumberedList', 'BulletedList', 'Blockquote', 'CreateDiv', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
		array('Link', 'Unlink', 'Anchor'),
		array('Image','Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar','Iframe')
		);
	session_start();
	$_SESSION['KCFINDER'] = array();
	$_SESSION['KCFINDER']['disabled'] = false;

	return $ckeditor->editor($instanceName, $initialValue, $config);
	}
?>