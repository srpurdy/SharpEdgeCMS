<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
$config["paypal_ipn_use_live_settings"] = false;
$config["paypal_ipn_live_settings"] = array('email' => 'yourpaypal_email@domain.com',
'url' => 'https://www.paypal.com/cgi-bin/webscr',
'debug' => false
);$config["paypal_ipn_sandbox_settings"] = array('email' => 'yourpaypal_sandbox_email@domain.com',
'url' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
'debug' => true
);?>