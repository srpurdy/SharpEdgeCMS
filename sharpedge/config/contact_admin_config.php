<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config['contact_admin'] = 'Contacts';
$config['contact_admin_level'] = true;
$config['contact_admin_menu'] = array(
							'Manage Fields' => '/contact_admin',
							'Add Field' => '/contact_admin#tabs-2',
							'Manage Contacts' => '/contact_admin#tabs-3',
							'Add Contact' => '/contact_admin#tabs-4',
);
?>