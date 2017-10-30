<?php

class Smartphoto_Front {
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_assets' ) );
	}

	function add_assets() {
		wp_enqueue_script( 'smartphoto-js', plugins_url( 'assets/smartphoto.min.js', __FILE__ ), false, true );
		wp_enqueue_script( 'wp-smartphoto', plugins_url( 'assets/wp-smartphoto.js', __FILE__ ), array( 'smartphoto-js' ), true );
		$options = get_option( 'smartphoto_options', array() );
		wp_localize_script( 'wp-smartphoto', 'wp_smartphoto', $options );
		wp_add_inline_script( 'smartphoto-js', "document.addEventListener('DOMContentLoaded',function(){ new smartPhoto('.js-smartPhoto', wp_smartphoto );});" );


		wp_enqueue_style( 'smartphoto-css', plugins_url( 'assets/smartphoto.min.css', __FILE__ ) );
		$css = '.smartphoto-img { max-width: none; } .smartphoto-nav li { background-color: #FFF; }';
		wp_add_inline_style( 'smartphoto-css', $css );

	}
}

