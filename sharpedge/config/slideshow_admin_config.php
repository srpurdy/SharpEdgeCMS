<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['slideshow_admin'] = 'Slide Shows';
$config['slideshow_admin_level'] = true;
$config['slideshow_admin_menu'] = array(
							'Manage Images' => '/slideshow_admin',
							'Add Image' => '/slideshow_admin#tabs-2',
							'Manage Groups' => '/slideshow_admin#tabs-3',
							'Add Group' => '/slideshow_admin#tabs-4',
);
?>