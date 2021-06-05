<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('wtp_phuctenberg_load_css')) {
    function wtp_phuctenberg_load_css()
    {
        $css_path = 'assets/css/';
        $css_files = array(
            'phuctenberg.css',
            'media-text.css',
        );

        // STYLES
        foreach ($css_files as $key => $css_file) {
            $css_version = filemtime(plugin_dir_path(dirname(__FILE__)) . $css_path . $css_file);
            wp_enqueue_style('wtp-phuctenberg-' . $key, plugin_dir_url(dirname(__FILE__)) . $css_path. $css_file, false, $css_version);
        }
    }
    add_action('wp_enqueue_scripts', 'wtp_phuctenberg_load_css', 99);
}
