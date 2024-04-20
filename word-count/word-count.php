<?php
/**
 * Plugin Name: Word Count
 * Plugin URI: promasudbd.com
 * Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, saepe!
 * Version: 1.0.0
 * Author: Masud Rana
 * Author URI: promasudbd.com
 * License: GPLv2 or later
 * Text Domian: word-count
 * Domain Path: /languages/
*/


/**
 * plugin text domian loading function
 * */ 
function word_count_text_domain_load(){
    load_plugin_textdomain('word-count');
}

 add_action("plugins_loaded", "word_count_text_domain_load");

//  the content filter 
function word_count_filter_action($content){
    $words = strip_tags($content);
    $word_count = str_word_count($words);
    $label = __("Word Count Text Here:", "word-count");
    $label = apply_filters("word_count_dametext", $label);
    $tag = apply_filters("word_count_tags", "h2");
    $content .= sprintf('<%s>%s : %s</%s>', $tag, $label, $word_count, $tag);
    return $content;
}
add_filter('the_content', 'word_count_filter_action');