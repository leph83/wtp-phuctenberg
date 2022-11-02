<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*
** REMOVE GUTENBERG STYLE FRONTEND
*/
if (!function_exists('wtp_remove_wp_block_library_css')) {
    function wtp_remove_wp_block_library_css()
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
    }
    add_action('wp_enqueue_scripts', 'wtp_remove_wp_block_library_css', 100);
}






// REMOVE GUTENBERG STYLES FROM FRONTEND
function pse_remove_core_block_styles()
{
	wp_dequeue_style('wp-block-media-text');
}
add_action('wp_enqueue_scripts', 'pse_remove_core_block_styles');

// REMOVE ALL GUTENBERG STYLES FROM BACKEND
add_action(
	'wp_default_styles',
	function ($styles) {

		/* Create an array with the two handles wp-block-library and
		 * wp-block-library-theme.
		 */
		$handles = ['wp-block-library', 'wp-block-library-theme'];

		foreach ($handles as $handle) {
			// Search and compare with the list of registered style handles:
			$style = $styles->query($handle, 'registered');
			if (!$style) {
				continue;
			}
			// Remove the style
			$styles->remove($handle);
			// Remove path and dependencies
			$styles->add($handle, false, []);
		}
	},
	PHP_INT_MAX
);
