<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['product_admin'] = 'Products';
$config['product_admin_level'] = true;
$config['product_admin_menu'] = array(
							'Manage Products' => '/product_admin',
							'New Product' => '/product_admin#tabs-2',
							'Manage Categories' => '/product_admin#tabs-3',
							'Add Category' => '/product_admin#tabs-4',
							'Manage Orders' => '/product_admin/#tabs-5',
);
?>