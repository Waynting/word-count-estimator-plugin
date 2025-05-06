<?php
/*
Plugin Name: Word Count Estimator
Plugin URI: https://waynspace.com/
Description: 完全依照 Gutenberg 後台字數邏輯（characters_excluding_spaces／including_spaces／words）計算字數與閱讀時間，插在文章開頭。
Version: 1.3
Author: Wayn Liu
Author URI: https://waynspace.com/
License: GPL2
*/

// 載入專屬 CSS
add_action( 'wp_enqueue_scripts', 'wce_enqueue_styles' );
function wce_enqueue_styles() {
    if ( is_singular('post') && is_main_query() ) {
        wp_enqueue_style(
            'wce-style',
            plugin_dir_url( __FILE__ ) . 'css/style.css',
            array(),
            '1.3'
        );
    }
}

// 把字數與閱讀時間插到文章最前面
add_filter( 'the_content', 'wce_prepend_word_count', 5 );
function wce_prepend_word_count( $content ) {
    if ( is_singular('post') && in_the_loop() && is_main_query() ) {

        // 1. 取 raw block 內容
        $raw      = get_post_field( 'post_content', get_the_ID() );
        // 2. 解析 Gutenberg blocks
        $rendered = function_exists( 'do_blocks' )
            ? do_blocks( $raw )
            : $raw;
        // 3. 去短碼、去 HTML
        $clean    = wp_strip_all_tags( strip_shortcodes( $rendered ) );

        // 4. 依字數類型計算
        $type     = wp_get_word_count_type(); // characters_excluding_spaces / characters_including_spaces / words
        if ( 'characters_excluding_spaces' === $type ) {
            // 去掉所有空白後算長度
            $count = mb_strlen( preg_replace( '/\s+/u', '', $clean ) );
        } elseif ( 'characters_including_spaces' === $type ) {
            // 含空白一起算
            $count = mb_strlen( $clean );
        } else {
            // 預設 words，就用 str_word_count()
            $count = str_word_count( $clean );
        }

        // 5. 閱讀時間（200 字／分鐘）
        $time = ceil( $count / 200 );

        // 6. 輸出
        $html = sprintf(
            '<p class="wce-info">字數：<strong>%d</strong> 字 ｜ 預估閱讀時間：<strong>%d</strong> 分鐘</p>',
            $count,
            $time
        );

        return $html . $content;
    }

    return $content;
}
