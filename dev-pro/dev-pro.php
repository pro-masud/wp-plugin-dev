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
    function __construct(){
        add_action("plugin_loaded", array($this, 'devpro_load_front_assets'));
        add_action("wp_enqueue_scripts", array($this, 'devpro_load_textdomain'));
    }

    function devpro_load_front_assets(){
        // front-end file loading here
        wp_enqueue_script('dev-pro-main', plugin_dir_url(__FILE__)."/assets/public/js/main.js", ['jquery'], '1.0.0', true);
    }
    function devpro_load_textdomain(){
        load_plugin_textdomain('dev-pro', false, plugin_dir_url(__FILE__)."/languages");
    }
}

new DevPro();