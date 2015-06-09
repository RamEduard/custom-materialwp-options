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

MaterialWPThemeOptions\ThemeOptions::init();