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

define("DP_ASSETS_DIR", plugin_dir_url(__FILE__)."/assets");
define("DP_ASSETS_PUBLIC_DIR", plugin_dir_url(__FILE__)."/assets/public");
define("DP_ASSETS_ADMIN_DIR", plugin_dir_url(__FILE__)."/assets/admin");
define("DP_VERSION", time());
class DevPro{
    function __construct(){
        add_action("plugin_loaded", array($this, 'devpro_load_textdomain'));
        add_action("wp_enqueue_scripts", array($this, 'devpro_load_front_assets'));
        add_action("admin_enqueue_scripts", array($this, 'devpro_load_backend_assets'));
        add_action("admin_menu", array($this, 'omb_add_metabox'));
    }

    function devpro_load_backend_assets(){
        wp_enqueue_style('dev-pro-admin-css', DP_ASSETS_ADMIN_DIR."/css/style.css");
    }
    function omb_add_metabox(){
        add_meta_box(
            'omb_book_info',
            __('Book Info', 'dev-pro'),
            array($this, 'omb_book_info'),
            array('post'),
        );
    }
    function omb_book_info(){
        wp_nonce_field("omb_book", 'omb_nonce_book');

        $meta_html = <<<EDO
        <div class="fields">
            <div class="lable-e">
                <label for="author" class="lable-c">Author Name</label>
                <input id="author" type="text" class="input-c">
            </div>  
            <div class="lable-e">
                <label for="author-isbn" class="lable-c">Author ISBN</label>
                <input id="author-isbn" type="text" class="input-c">
            </div> 
        </div>
        EDO;
        echo $meta_html;
    }
    function devpro_load_front_assets(){
        // front-end file loading here
        wp_enqueue_script('dev-pro-main', DP_ASSETS_PUBLIC_DIR."/js/main.js", ['jquery'], '1.0.0', true);
    }
    function devpro_load_textdomain(){
        load_plugin_textdomain('dev-pro', false, plugin_dir_url(__FILE__)."/languages");
    }
}

new DevPro();
