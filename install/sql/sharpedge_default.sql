CREATE TABLE IF NOT EXISTS `blog`(
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `mod_display` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `gallery_display` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `gallery_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userfile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `postedby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `url_name` (`url_name`),
  KEY `user_id` (`user_id`),
  KEY `lang` (`lang`),
  KEY `date` (`date`),
  KEY `active` (`active`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- command split --

INSERT INTO `blog` (`blog_id`, `user_id`, `mod_display`, `gallery_display`, `gallery_id`, `name`, `url_name`, `userfile`, `text`, `active`, `postedby`, `date`, `tags`, `lang`, `views` ) VALUES
(1, 0, 'Y', 'N', '0', 'Welcome News Article', 'Welcome-News-Article', '', 'Hello', 'Y', 'Admin istrator', '2011-04-12 06:41:37', 'a:1:{i:0;s:11:"News-Events";}', 'en', 0);

-- command split --

CREATE TABLE IF NOT EXISTS `blog_categories`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_cat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `blog_url_cat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `blog_url_cat` (`blog_url_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- command split --

INSERT INTO `blog_categories` (`id`, `blog_cat`, `blog_url_cat`, `lang`) VALUES
(5000000, 'News + Events', 'News-Events', 'en'),
(5000001, 'Features', 'Features', 'en'),
(5000002, 'Slideshow', 'Slideshow', 'en');

-- command split --

CREATE TABLE IF NOT EXISTS `post_categories` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`cat_id` int(11) NOT NULL,
	`post_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `cat_id` (`cat_id`),
	KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

INSERT INTO `post_categories` (`id`, `cat_id`, `post_id`) VALUES
(1, 5000000, 1);

-- command split --

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `postedby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `blog_id` (`blog_id`),
  KEY `parent_id` (`parent_id`),
  KEY `user_id` (`user_id`),
  KEY `datetime` (`datetime`),
  KEY `active` (`active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` char(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL,
  `user_data` text NOT NULL,
  `previous_id` varchar(40) NOT NULL,
  `last_rotate` varchar(100) NOT NULL,
  `last_write` varchar(100) NOT NULL,
  UNIQUE KEY `session_id` (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- command split --

CREATE TABLE IF NOT EXISTS `contact_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- command split --

INSERT INTO `contact_addresses` (`id`, `contact_name`, `email`) VALUES
(1, 'Default Contact', 'sales@purdydesigns.com');

-- command split --

CREATE TABLE IF NOT EXISTS `contact_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('input','text','select','radio','array','label','para') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'input',
  `array_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_required` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `alignment` enum('left','right','center') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'left',
  `is_email` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `sort_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sort_id` (`sort_id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- command split --

INSERT INTO `contact_fields` (`id`, `name`, `lang`, `type`, `array_name`, `is_required`, `alignment`, `is_email`, `sort_id`) VALUES
(1, 'Full Name', 'en', 'input', '', 'Y', 'left', 'N', 0),
(2, 'Email Address', 'en', 'input', '', 'Y', 'left', 'Y', 100),
(3, 'Message', 'en', 'text', '', 'Y', 'center', 'N', 200);

-- command split --

CREATE TABLE IF NOT EXISTS `containers` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `container_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- command split --

INSERT INTO `containers` (`c_id`, `container_name`) VALUES
(1, '/container');

-- command split --

CREATE TABLE IF NOT EXISTS `downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `download_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `userfile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  `isProduct` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`download_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `gateways` (
  `gateway_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`gateway_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- command split --

INSERT INTO `gateways` (`gateway_id`, `name`, `module_name`, `active`) VALUES
(5000001, 'Paypal', 'paypal', 'Y');

-- command split --

CREATE TABLE IF NOT EXISTS `ipn_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listener_name` varchar(3) DEFAULT NULL COMMENT 'Either IPN or API',
  `transaction_type` varchar(16) DEFAULT NULL COMMENT 'The type of call being made to the listener',
  `transaction_id` varchar(19) DEFAULT NULL COMMENT 'The unique transaction ID generated by PayPal',
  `status` varchar(16) DEFAULT NULL COMMENT 'The status of the call',
  `message` varchar(512) DEFAULT NULL COMMENT 'Explanation of the call status',
  `ipn_data_hash` varchar(32) DEFAULT NULL COMMENT 'MD5 hash of the IPN post data',
  `detail` text COMMENT 'Detail text (potentially JSON) on this call',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ipn_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify_version` varchar(64) DEFAULT NULL COMMENT 'IPN Version Number',
  `verify_sign` varchar(127) DEFAULT NULL COMMENT 'Encrypted string used to verify the authenticityof the tansaction',
  `test_ipn` int(11) DEFAULT NULL,
  `protection_eligibility` varchar(24) DEFAULT NULL COMMENT 'Which type of seller protection the buyer is protected by',
  `charset` varchar(127) DEFAULT NULL COMMENT 'Character set used by PayPal',
  `btn_id` varchar(40) DEFAULT NULL COMMENT 'The PayPal buy button clicked',
  `address_city` varchar(40) DEFAULT NULL COMMENT 'City of customers address',
  `address_country` varchar(64) DEFAULT NULL COMMENT 'Country of customers address',
  `address_country_code` varchar(2) DEFAULT NULL COMMENT 'Two character ISO 3166 country code',
  `address_name` varchar(128) DEFAULT NULL COMMENT 'Name used with address (included when customer provides a Gift address)',
  `address_state` varchar(40) DEFAULT NULL COMMENT 'State of customer address',
  `address_status` varchar(20) DEFAULT NULL COMMENT 'confirmed/unconfirmed',
  `address_street` varchar(200) DEFAULT NULL COMMENT 'Customer''s street address',
  `address_zip` varchar(20) DEFAULT NULL COMMENT 'Zip code of customer''s address',
  `first_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s first name',
  `last_name` varchar(64) DEFAULT NULL COMMENT 'Customer''s last name',
  `payer_business_name` varchar(127) DEFAULT NULL COMMENT 'Customer''s company name, if customer represents a business',
  `payer_email` varchar(127) DEFAULT NULL COMMENT 'Customer''s primary email address. Use this email to provide any credits',
  `payer_id` varchar(13) DEFAULT NULL COMMENT 'Unique customer ID.',
  `payer_status` varchar(20) DEFAULT NULL COMMENT 'verified/unverified',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT 'Customer''s telephone number.',
  `residence_country` varchar(2) DEFAULT NULL COMMENT 'Two-Character ISO 3166 country code',
  `business` varchar(127) DEFAULT NULL COMMENT 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
  `receiver_email` varchar(127) DEFAULT NULL COMMENT 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
  `receiver_id` varchar(13) DEFAULT NULL COMMENT 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
  `custom` varchar(255) DEFAULT NULL COMMENT 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
  `invoice` varchar(127) DEFAULT NULL COMMENT 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
  `memo` varchar(255) DEFAULT NULL COMMENT 'Memo as entered by your customer in PayPal Website Payments note field.',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `auth_id` varchar(19) DEFAULT NULL COMMENT 'Authorization identification number',
  `auth_exp` varchar(28) DEFAULT NULL COMMENT 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `auth_amount` int(11) DEFAULT NULL COMMENT 'Authorization amount',
  `auth_status` varchar(20) DEFAULT NULL COMMENT 'Status of authorization',
  `num_cart_items` int(11) DEFAULT NULL COMMENT 'If this is a PayPal shopping cart transaction, number of items in the cart',
  `parent_txn_id` varchar(19) DEFAULT NULL COMMENT 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
  `payment_date` varchar(28) DEFAULT NULL COMMENT 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
  `payment_status` varchar(20) DEFAULT NULL COMMENT 'Payment status of the payment',
  `payment_type` varchar(10) DEFAULT NULL COMMENT 'echeck/instant',
  `pending_reason` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=pending',
  `reason_code` varchar(20) DEFAULT NULL COMMENT 'This variable is only set if payment_status=reversed',
  `remaining_settle` int(11) DEFAULT NULL COMMENT 'Remaining amount that can be captured with Authorization and Capture',
  `shipping_method` varchar(64) DEFAULT NULL COMMENT 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
  `shipping` decimal(10,2) DEFAULT NULL COMMENT 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places',
  `transaction_entity` varchar(20) DEFAULT NULL COMMENT 'Authorization and capture transaction entity',
  `txn_id` varchar(19) DEFAULT NULL COMMENT 'A unique transaction ID generated by PayPal',
  `txn_type` varchar(20) DEFAULT NULL COMMENT 'cart/express_checkout/send-money/virtual-terminal/web-accept',
  `exchange_rate` decimal(10,2) DEFAULT NULL COMMENT 'Exchange rate used if a currency conversion occured',
  `mc_currency` varchar(3) DEFAULT NULL COMMENT 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
  `mc_fee` decimal(10,2) DEFAULT NULL COMMENT 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `payment_fee` decimal(10,2) DEFAULT NULL COMMENT 'USD transaction fee associated with the payment',
  `payment_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full USD amount of the customers payment transaction, before payment_fee is subtracted',
  `settle_amount` decimal(10,2) DEFAULT NULL COMMENT 'Amount that is deposited into the account''s primary balance after a currency conversion',
  `settle_currency` varchar(3) DEFAULT NULL COMMENT 'Currency of settle amount. Three digit currency code',
  `auction_buyer_id` varchar(64) DEFAULT NULL COMMENT 'The customer''s auction ID.',
  `auction_closing_date` varchar(28) DEFAULT NULL COMMENT 'The auction''s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
  `auction_multi_item` int(11) DEFAULT NULL COMMENT 'The number of items purchased in multi-item auction payments',
  `for_auction` varchar(10) DEFAULT NULL COMMENT 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
  `subscr_date` varchar(28) DEFAULT NULL COMMENT 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
  `subscr_effective` varchar(28) DEFAULT NULL COMMENT 'Date when a subscription modification becomes effective',
  `period1` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D',
  `period2` varchar(10) DEFAULT NULL COMMENT '(Optional) Trial period',
  `period3` varchar(10) DEFAULT NULL COMMENT 'Regular subscription interval in days, weeks, months, years',
  `amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 1 for USD',
  `amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for Trial period 2 for USD',
  `amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription  period 1 for USD',
  `mc_amount1` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 1 regardless of currency',
  `mc_amount2` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for trial period 2 regardless of currency',
  `mc_amount3` decimal(10,2) DEFAULT NULL COMMENT 'Amount of payment for regular subscription period regardless of currency',
  `recurring` varchar(1) DEFAULT NULL COMMENT 'Indicates whether rate recurs (1 is yes, blank is no)',
  `reattempt` varchar(1) DEFAULT NULL COMMENT 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
  `retry_at` varchar(28) DEFAULT NULL COMMENT 'Date PayPal will retry a failed subscription payment',
  `recur_times` int(11) DEFAULT NULL COMMENT 'The number of payment installations that will occur at the regular rate',
  `username` varchar(64) DEFAULT NULL COMMENT '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
  `password` varchar(24) DEFAULT NULL COMMENT '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
  `subscr_id` varchar(19) DEFAULT NULL COMMENT 'ID generated by PayPal for the subscriber',
  `case_id` varchar(28) DEFAULT NULL COMMENT 'Case identification number',
  `case_type` varchar(28) DEFAULT NULL COMMENT 'complaint/chargeback',
  `case_creation_date` varchar(28) DEFAULT NULL COMMENT 'Date/Time the case was registered',
  `order_status` enum('PAID','WAITING','REJECTED') DEFAULT NULL COMMENT 'Additional variable to make payment_status more actionable',
  `discount` decimal(10,2) DEFAULT NULL COMMENT 'Additional variable to record the discount made on the order',
  `shipping_discount` decimal(10,2) DEFAULT NULL COMMENT 'Record the discount made on the shipping',
  `ipn_track_id` varchar(127) DEFAULT NULL COMMENT 'Internal tracking variable added in April 2011',
  `transaction_subject` varchar(255) DEFAULT NULL COMMENT 'Describes the product for a button-based purchase',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueTransactionID` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ipn_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_name` varchar(127) DEFAULT NULL COMMENT 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
  `item_number` varchar(127) DEFAULT NULL COMMENT 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
  `quantity` varchar(127) DEFAULT NULL COMMENT 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
  `mc_gross` decimal(10,2) DEFAULT NULL COMMENT 'Full amount of the customer''s payment',
  `mc_handling` decimal(10,2) DEFAULT NULL COMMENT 'Total handling charge associated with the transaction',
  `mc_shipping` decimal(10,2) DEFAULT NULL COMMENT 'Total shipping amount associated with the transaction',
  `tax` decimal(10,2) DEFAULT NULL COMMENT 'Amount of tax charged on payment',
  `cost_per_item` decimal(10,2) DEFAULT NULL COMMENT 'Cost of an individual item',
  `option_name_1` varchar(64) DEFAULT NULL COMMENT 'Option 1 name as requested by you',
  `option_selection_1` varchar(200) DEFAULT NULL COMMENT 'Option 1 choice as entered by your customer',
  `option_name_2` varchar(64) DEFAULT NULL COMMENT 'Option 2 name as requested by you',
  `option_selection_2` varchar(200) DEFAULT NULL COMMENT 'Option 2 choice as entered by your customer',
  `option_name_3` varchar(64) DEFAULT NULL COMMENT 'Option 3 name as requested by you',
  `option_selection_3` varchar(200) DEFAULT NULL COMMENT 'Option 3 choice as entered by your customer',
  `option_name_4` varchar(64) DEFAULT NULL COMMENT 'Option 4 name as requested by you',
  `option_selection_4` varchar(200) DEFAULT NULL COMMENT 'Option 4 choice as entered by your customer',
  `option_name_5` varchar(64) DEFAULT NULL COMMENT 'Option 5 name as requested by you',
  `option_selection_5` varchar(200) DEFAULT NULL COMMENT 'Option 5 choice as entered by your customer',
  `option_name_6` varchar(64) DEFAULT NULL COMMENT 'Option 6 name as requested by you',
  `option_selection_6` varchar(200) DEFAULT NULL COMMENT 'Option 6 choice as entered by your customer',
  `option_name_7` varchar(64) DEFAULT NULL COMMENT 'Option 7 name as requested by you',
  `option_selection_7` varchar(200) DEFAULT NULL COMMENT 'Option 7 choice as entered by your customer',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content_top` int(11) NOT NULL,
  `content_bottom` int(11) NOT NULL,
  `side_top` int(11) NOT NULL,
  `side_bottom` int(11) NOT NULL,
  `slide_id` int(11) NOT NULL DEFAULT '0',
  `container` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '/ctrl_container',
  `is_admin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `enabled` enum('Y', 'N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `version` decimal(4,3) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

-- command split --

INSERT INTO `modules` (`id`, `name`, `content_top`, `content_bottom`, `side_top`, `side_bottom`, `slide_id`, `container`, `is_admin`, `enabled`, `version`) VALUES
(5000001, 'gallery', 0, 0, 0, 0, 0, '/full_ctrl_container', 'N', 'Y', 0.000),
(5000002, 'news', 0, 0, 0, 0, 0, '/full_ctrl_container', 'N', 'Y', 0.000),
(5000003, 'auth', 0, 0, 0, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000004, 'search', 0, 0, 0, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000005, 'comments', 0, 0, 0, 0, 0, '/full_ctrl_container', 'N', 'Y', 0.000),
(5000006, 'users', 0, 0, 0, 0, 0, '/full_ctrl_container', 'N', 'Y', 0.000),
(5000007, 'contact', 0, 0, 0, 0, 0, '/full_ctrl_container', 'N', 'Y', 0.000),
(5000008, 'dashboard', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000009, 'user_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000010, 'languages', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000011, 'widget_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000012, 'module_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000013, 'page_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000014, 'blog_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000015, 'gallery_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000016, 'slideshow_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000017, 'menu_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000018, 'contact_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000019, 'gateway_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000020, 'product_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000021, 'download_admin', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000023, 'template', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000024, 'configuration', 0, 0, 0, 0, 0, '', 'Y', 'Y', 0.000),
(5000026, 'products', 0, 0, 5000004, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000027, 'paypal', 0, 0, 0, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000028, 'profile', 0, 0, 0, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000029, 'updater', 0, 0, 0, 0, 0, '/ctrl_container', 'Y', 'Y', 0.000),
(5000030, 'log_admin', 0, 0, 0, 0, 0, '/ctrl_container', 'Y', 'Y', 0.000),
(5000031, 'tools_admin', 0, 0, 0, 0, 0, '/ctrl_container', 'Y', 'Y', 0.000),
(5000032, 'video_admin', 0, 0, 0, 0, 0, '/ctrl_container', 'Y', 'Y', 0.000),
(5000033, 'videos', 0, 0, 0, 0, 0, '/ctrl_container', 'N', 'Y', 0.000),
(5000034, 'userfields_admin', 0, 0, 0, 0, 0, '/ctrl_container', 'Y', 'Y', 0.000);

-- command split --

CREATE TABLE IF NOT EXISTS `module_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `location_id` (`location_id`),
  KEY `rel_id` (`rel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- command split --

INSERT INTO `module_widgets` (`id`, `group_id`, `location_id`, `rel_id`) VALUES
(1, 5000004, 1, 5000026);

-- command split --

CREATE TABLE IF NOT EXISTS `module_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `read` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `write` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `delete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

INSERT INTO `module_permissions` (`id`, `module_id`, `group_id`, `read`, `write`, `delete`) VALUES
(1, 5000008, 2, 'N', 'N', 'N'),
(2, 5000009, 2, 'N', 'N', 'N'),
(3, 5000010, 2, 'N', 'N', 'N'),
(4, 5000011, 2, 'N', 'N', 'N'),
(5, 5000012, 2, 'N', 'N', 'N'),
(6, 5000013, 2, 'N', 'N', 'N'),
(7, 5000014, 2, 'N', 'N', 'N'),
(8, 5000015, 2, 'N', 'N', 'N'),
(9, 5000016, 2, 'N', 'N', 'N'),
(10, 5000017, 2, 'N', 'N', 'N'),
(11, 5000018, 2, 'N', 'N', 'N'),
(12, 5000019, 2, 'N', 'N', 'N'),
(13, 5000020, 2, 'N', 'N', 'N'),
(14, 5000021, 2, 'N', 'N', 'N'),
(15, 5000022, 2, 'N', 'N', 'N'),
(16, 5000023, 2, 'N', 'N', 'N'),
(17, 5000024, 2, 'N', 'N', 'N'),
(18, 5000025, 2, 'N', 'N', 'N'),
(19, 5000029, 2, 'N', 'N', 'N');

-- command split --

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `paid` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `TaxAmount` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userfile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `brand_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `download` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `sort_id` int(11) NOT NULL,
  `hide` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `currency` enum('USD','CAD', 'GBP') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USD',
  `stock` int(11) NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `SKU` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Weight` decimal(10,2) DEFAULT NULL,
  `WeightUnits` enum('Pounds','Ounces','Grams') COLLATE utf8_unicode_ci DEFAULT NULL,
  `size_by` enum('name','number') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ShippingCost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `products_in_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`,`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userfile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  `has_child` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `product_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`,`download_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `gallery_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_name` (`url_name`),
  KEY `sort_id` (`sort_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `gallery_photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `userfile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc_one` text COLLATE utf8_unicode_ci NOT NULL,
  `desc_two` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `cat_id` (`cat_id`),
  KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- command split --

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- command split --

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang_short` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- command split --

INSERT INTO `languages` (`id`, `lang`, `lang_short`) VALUES
(1, 'english', 'en'),
(2, 'french', 'fr');

-- command split --

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hide` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL DEFAULT '0',
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `page_link` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `use_page` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `target` text COLLATE utf8_unicode_ci NOT NULL,
  `orderfield` int(11) NOT NULL,
  `expanded` tinyint(4) NOT NULL,
  `has_child` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `has_sub_child` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hide` (`hide`),
  KEY `orderfield` (`orderfield`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- command split --

INSERT INTO `menu` (`id`, `hide`, `parent_id`, `child_id`, `text`, `link`, `page_link`, `use_page`, `title`, `target`, `orderfield`, `expanded`, `has_child`, `has_sub_child`, `lang`) VALUES
(1, 'N', 0, 0, 'Home', '', '/pages/view/Home-Page', 'Y', '', '_self', 0, 0, 'N', 'N', 'en'),
(2, 'N', 0, 0, 'Example Page', '', '/pages/view/Example-Page', 'Y', '', '_self', 100, 0, 'N', 'N', 'en'),
(3, 'N', 0, 0, 'Contact', '/en/contact', '#', 'N', '', '_self', 900, 0, 'N', 'N', 'en');

-- command split --

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `container_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `side_top` int(11) NOT NULL DEFAULT '0',
  `slide_id` int(11) NOT NULL DEFAULT '0',
  `side_bottom` int(11) NOT NULL DEFAULT '0',
  `content_top` int(11) NOT NULL DEFAULT '0',
  `content_bottom` int(11) NOT NULL DEFAULT '0',
  `meta_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `hide` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `restrict_access` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `page_type` enum('normal','league', 'youtube') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `user_group` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_name` (`url_name`),
  KEY `user_id` (`user_id`),
  KEY `lang` (`lang`),
  KEY `slide_id` (`slide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- command split --

INSERT INTO `pages` (`id`, `user_id`, `name`, `url_name`, `text`, `container_name`, `lang`, `side_top`, `slide_id`, `side_bottom`, `content_top`, `content_bottom`, `meta_desc`, `meta_keywords`, `hide`, `restrict_access`,  `page_type`, `user_group`, `views` ) VALUES
(1, 0, 'Home Page', 'Home-Page', '<p>\n	Hello World :)</p>\n', '/container', 'en', 5000002, 0, 0, 5000001, 0, 'test meta', 'test keyword', 'N', 'N', 'normal', 0, 0),
(2, 0, 'Example Page', 'Example-Page', '<p>\n	&nbsp;</p>\n<p>\n	Welcome to SharpEdge CMS Example Page</p>\n', '/container', 'en', 5000002, 0, 0, 0, 5000003, '', '', 'N', 'N', 'normal', 0, 0);

-- command split --

CREATE TABLE IF NOT EXISTS `page_drafts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `container_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `side_top` int(11) NOT NULL DEFAULT '0',
  `slide_id` int(11) NOT NULL DEFAULT '0',
  `side_bottom` int(11) NOT NULL DEFAULT '0',
  `content_top` int(11) NOT NULL DEFAULT '0',
  `content_bottom` int(11) NOT NULL DEFAULT '0',
  `meta_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `hide` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `restrict_access` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `user_group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url_name` (`url_name`),
  KEY `lang` (`lang`),
  KEY `slide_id` (`slide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- command split --

CREATE TABLE IF NOT EXISTS `page_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `location_id` (`location_id`),
  KEY `rel_id` (`rel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- command split --

INSERT INTO `page_widgets` (`id`, `group_id`, `location_id`, `rel_id`) VALUES
(1, 5000002, 1, 1),
(2, 5000001, 3, 1),
(3, 5000002, 1, 2),
(4, 5000003, 4, 2);

-- command split --

CREATE TABLE IF NOT EXISTS `sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `site_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `site_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `has_panel` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userfile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc_one` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `desc_two` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sort_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `slideshow_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `images` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `slideshow_images` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`group_id` int(11) NOT NULL,
	`image_id` int(11) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `group_id` (`group_id`),
	KEY `image_id` (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
);

-- command split --

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	('1',INET_ATON('127.0.0.1'),'{USER-NAME}','{PASSWORD}','','{EMAIL}','',NULL,{NOW},{NOW},'1', '{FIRST-NAME}','{LAST-NAME}','ADMIN','0');

-- command split --

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- command split --
	
CREATE TABLE IF NOT EXISTS `profile_fields` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_posts` int(11) NOT NULL DEFAULT '0',
  `display_name` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `nickname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `website` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `signature` text COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `intrests` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `occupation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'UTC',
  `daylight_savings` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `display_signatures` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `display_avatars` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `comment_notify` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `admin_notify` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `post_notify` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`profile_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- command split --

INSERT INTO `profile_fields` (`profile_id`, `user_id`, `total_posts`, `display_name`, `nickname`, `avatar`, `website`, `signature`, `location`, `intrests`, `occupation`, `timezone`, `daylight_savings`, `display_signatures`, `display_avatars`) VALUES
(1, 1, 0, 'N', '', 'default.jpg', '', '', '', '', '', '', 'N', 'Y', 'Y');
	
-- command split --

CREATE TABLE IF NOT EXISTS `spam_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
);

-- command split --

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1,1,1),
	(2,1,2);
	
-- command split --

CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `vid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postedby` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `play_time` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `lang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `userfile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `is_segment` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `active` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  PRIMARY KEY (`video_id`),
  KEY `date` (`date`),
  KEY `url_name` (`url_name`),
  KEY `lang` (`lang`),
  KEY `is_segment` (`is_segment`),
  KEY `active` (`active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `video_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_cat` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `video_url_cat` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `video_url_cat` (`video_url_cat`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `video_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `video_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `postedby` int(11) NOT NULL,
  `active` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  PRIMARY KEY (`comment_id`),
  KEY `video_id` (`video_id`),
  KEY `active` (`active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `video_post_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `video_id` (`video_id`),
  KEY `cat_id_2` (`cat_id`),
  KEY `video_id_2` (`video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --
	
CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mode` enum('F','H','B') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'B',
  `system_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bbcode` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

INSERT INTO `widgets` (`id`, `name`, `mode`, `system_name`, `bbcode`, `lang`) VALUES
(5000001, 'News widget', 'F', 'news_module', '', 'en'),
(5000002, 'Photo widget', 'F', 'photo_module', '', 'en'),
(5000003, 'Login', 'F', 'login_widget', '', 'en'),
(5000004, 'AddThis Widget', 'F', 'addthis_widget', '', 'en'),
(5000005, 'News With Images', 'F', 'news_widget_photos', '', 'en'),
(5000006, 'News Landing', 'F', 'news_landing_widget', '', 'en'),
(5000007, 'News Slideshow', 'F', 'news_photo_widget', '', 'en'),
(5000008, 'News Landing Slideshow', 'F', 'news_photo_landing_widget', '', 'en'),
(5000009, 'Facebook Widget', 'F', 'facebook_widget', '', 'en'),
(5000010, 'Twitter Widget', 'F', 'twitter_widget', '', 'en'),
(5000011, 'Cart Widget', 'F', 'cart_widget', '', 'en'),
(5000012, 'Breadcrumb Widget', 'F', 'breadcrumb_widget', '', 'en');

-- command split --

CREATE TABLE IF NOT EXISTS `widget_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

INSERT INTO `widget_groups` (`id`, `name`) VALUES
(5000001, 'Home Page - News'),
(5000002, 'Side Widgets Example'),
(5000003, 'Content Bottom - Example'),
(5000004, 'Shopping Cart');

-- command split --

CREATE TABLE IF NOT EXISTS `widget_group_items` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gm_id`),
  KEY `widget_id` (`widget_id`),
  KEY `group_id` (`group_id`),
  KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- command split --

INSERT INTO `widget_group_items` (`gm_id`, `group_id`, `widget_id`, `sort_id`) VALUES
(1, 5000001, 5000001, 0),
(2, 5000002, 5000003, 300),
(3, 5000003, 5000004, 300),
(4, 5000004, 5000011, 0);

-- command split --

CREATE TABLE IF NOT EXISTS `widget_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- command split --

INSERT INTO `widget_locations` (`id`, `name`) VALUES
(1, 'side_top'),
(2, 'side_bottom'),
(3, 'content_top'),
(4, 'content_bottom');

-- command split --

CREATE TABLE IF NOT EXISTS `banned_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `shipping_by_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ss_customer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ss_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `CustomNotes` text COLLATE utf8_unicode_ci,
  `InternalNotes` text COLLATE utf8_unicode_ci,
  `ShippingMethod` enum('USPS','UPS','FedEx') COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaymentMethod` enum('PayPal','Credit Card','Check') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `ss_ship_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `LabelDate` datetime NOT NULL,
  `ShippingDate` datetime NOT NULL,
  `Carrier` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Service` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `TrackingNumber` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `user_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('input','text','select','radio','array','label','para') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'input',
  `list` text COLLATE utf8_unicode_ci NOT NULL,
  `is_required` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `on_register` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `sort_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sort_id` (`sort_id`),
  KEY `on_register` (`on_register`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- command split --

CREATE TABLE IF NOT EXISTS `custom_field_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;