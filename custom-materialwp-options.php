<?php

/*
Plugin Name: Custom Material Design Theme Options
Plugin URI: https://github.com/RamEduard/custom-materialwp-options
Description: Custom Material Design Theme Options by Ramón Serrano
Author: Ramón Serrano
Version: 1.0
Author URI: https://github.com/RamEduard
*/

$loader = require_once 'lib/autoloader.php';

$loader->add('MaterialWPThemeOptions', __DIR__ . '/lib');

if (!defined('PLUGIN_URI'))
    define ('PLUGIN_URI', plugin_dir_url (__FILE__));

MaterialWPThemeOptions\ThemeOptions::init();

/*function wp_gear_manager_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');*/