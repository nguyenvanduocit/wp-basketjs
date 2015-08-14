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
add_action('init', 'wp_basket_init');
function wp_basket_init(){
	if(!is_admin()){
		add_filter( 'script_loader_tag', 'wp_basket_getLoadedScript', 10, 3 );
		add_action( 'wp_head', 'printBasketScript', 1 );
	}
}
function wp_basket_getLoadedScript($tag, $handle, $src){
	$src = sprintf('{ url: "%1$s", key: "%2$s"}', $src, $handle );
	$tag = '<script>(function (basket) {basket.require(' . $src . ');})(basket);</script>';
	return $tag;
}

function printBasketScript(){
	?>
	<script src="<?php echo plugins_url('js/basket.js', __FILE__); ?>"></script>
	<?php
}