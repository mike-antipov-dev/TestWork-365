<?php
/*
Plugin Name: Add WooCommerce product from the front-end with some custom fields
Description: Just another plugin.
Author: Mike Antipov
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-add-custom-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-product-front.php';

Add_Custom_Admin_Fields::init();
Add_Product_Front::init();