<?php 
/**
 * Plugin Name: Dev Pro
 * Plugin URI: promasudbd.com
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, saepe!
 * Version: 1.0.0
 * Author: Masud Rana
 * Author URI: promasudbd.com
 * License: GPLv2 or later
 * Text Domian: dev-pro
 * Domain Path: /languages/
*/

class DevPro{
    public function __construct(){
        add_action("plugin_loaded", array($this, 'load_textdomain'));
    }

    public function load_textdomain(){
        wp_enqueue_scripts('dev-pro', false, plugin_dir_url(__FILE__). "/languages");
    }
}

new DevPro();