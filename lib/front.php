<?php

class smartphoto_front {
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_assets' ) );
		add_filter( 'the_content', array( $this, 'change_content' ) );
		add_action( 'wp_footer', array( $this, 'add_script' ) );
	}
	function add_assets() {
		wp_enqueue_script( 'smartphoto-js', plugins_url( 'assets/smartphoto.min.js', __FILE__ ) );
		wp_enqueue_style( 'smartphoto-css', plugins_url( 'assets/smartphoto.min.css', __FILE__ ) );
	}
	function change_content( $content ) {
		$pattern = '/<img.*?src="(.*?)"(.*?)>/';
		$replacement = '<a href="${1}" class="js-smartPhoto"><img src="${1}"${2}/></a>';
		return preg_replace( $pattern, $replacement, $content );
	}
	function add_script() {
		$options = get_option( 'smartphoto_options' );
		?>
		<style>
		.smartphoto-img {
			max-width: none;
		}
		.smartphoto-nav li {
			background-color: #FFF;
		}
		</style>
		<script>
			document.addEventListener('DOMContentLoaded',function(){
			<?php if ( ! is_array( $options ) ) { ?>
				new smartPhoto('.js-smartPhoto');
			<?php } else { ?>
				new smartPhoto('.js-smartPhoto',{
					nav: <?php echo esc_js( $options['nav'] ); ?>,
					arrows: <?php echo esc_js( $options['arrows'] ); ?>,
					animationSpeed: <?php echo esc_js( $options['animationSpeed'] ); ?>,
					swipeOffset: <?php echo esc_js( $options['swipeOffset'] ); ?>,
					forceInterval: <?php echo esc_js( $options['forceInterval'] ); ?>,
					registance: <?php echo esc_js( $options['registance'] ); ?>,
					resizeStyle: '<?php echo esc_js( $options['resizeStyle'] ); ?>',
					verticalGravity: <?php echo esc_js( $options['verticalGravity'] ); ?>,
					useOrientationApi: <?php echo esc_js( $options['useOrientationApi'] ); ?>
				});
			<?php } ?>
			});
		</script>
		<?php
	}
}

new smartphoto_front();
