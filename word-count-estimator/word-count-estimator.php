<?php
/*
Plugin Name: Word Count Estimator
Plugin URI: https://waynspace.com/
Description: 自動計算每篇文章的字數與預估閱讀時間，顯示在文章開頭。
Version: 1.1
Author: Waiting Liu
Author URI: https://waynspace.com/
License: GPL2
*/

/**
 * wce_enqueue_scripts
 * 這個函式會在每次載入「單篇文章」頁面時，自動把 JS 和 CSS 載入
 */
function wce_enqueue_scripts() {
    if (is_single()) {
        echo '<script>console.log("Plugin URL: ' . plugin_dir_url(__FILE__) . 'js/estimator.js");</script>';
        wp_enqueue_script(
            'wce-estimator',
            plugin_dir_url(__FILE__) . 'js/estimator.js',
            array(), null, true
        );
        wp_enqueue_style(
            'wce-style',
            plugin_dir_url(__FILE__) . 'css/style.css'
        );
    }
}
add_action('wp_enqueue_scripts', 'wce_enqueue_scripts');
