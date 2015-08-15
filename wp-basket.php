<?php

/*
Plugin Name: Wp Basket
Plugin URI: http://nvduoc.senviet.org/wp_basket
Description: A plugin to use basket.js to improve js loading on your site
Version: 1.0
Author: nguyenvanduocit
Author URI: http://nvduoc.senviet.org
License: GPL2
*/
add_action('init', 'wpb_basket_init');
/**
 * Init hook.
 *
 * @since  0.9.0
 * @return void
 * @author nguyenvanduocit
 */
function wpb_basket_init(){
	if(!is_admin()){
		add_filter( 'script_loader_tag', 'wpb_replace_script_tag', 10, 3 );
		add_action( 'wp_head', 'wpb_print_basket_script', 1 );
	}
}

/**
 * Replace from <script> tag to basket.require
 *
 * @since  0.9.0
 * @see
 *
 * @param $tag
 * @param $handle
 * @param $src
 *
 * @return string
 * @author nguyenvanduocit
 */
function wpb_replace_script_tag($tag, $handle, $src){
	$src = sprintf('{ url: "%1$s", key: "%2$s"}', $src, $handle );
	$tag = '<script>(function (basket) {basket.require(' . $src . ');})(basket);</script>';
	return $tag;
}

/**
 * Print basket script to head.
 *
 * @since  0.9.0
 * @see
 * @return void
 * @author nguyenvanduocit
 */
function wpb_print_basket_script(){
	?>
	<script src="<?php echo plugins_url('js/basket.js', __FILE__); ?>"></script>
	<?php
}