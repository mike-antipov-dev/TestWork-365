<?php
/*
Plugin Name: Add WooCommerce product from the front-end with some custom fields
Description: Adds an ability to publish a product from the front-end and adds some custom fields in admin area.
Author: Mike Antipov
Version: 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-add-custom-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-product-front.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-loop.php';

Add_Custom_Admin_Fields::init();
Add_Product_Front::init();
Show_Product_Loop::init();