<?php
/**
 * Plugin Name: TeeMarket
 */
namespace TeeMarket;

class TeeMarket {
	public static $path;
	public static $url;
	public function __construct() {
		self::$path = plugin_dir_path( __FILE__ );
		self::$url = plugin_dir_url( __FILE__ );

		require_once self::$path . '/libs/composer/vendor/autoload.php';
		require_once self::$path . '/models/model.php';
		require_once self::$path . '/models/product/product.php';
		require_once self::$path . '/models/product/variant.php';
		require_once self::$path . '/models/product/variant-options.php';
		require_once self::$path . '/models/product/category.php';
		require_once self::$path . '/models/product/product-category.php';

		if ( isset( $_GET['dev'] ) ) {
			require_once self::$path . '/inc/example-data.php';
		}

		require_once self::$path . '/inc/router.php';

		if ( function_exists( 'WC' ) ) {
			require_once self::$path . '/inc/wc/class-cart.php';
			require_once self::$path . '/inc/wc/class-product.php';
			add_action(
				'wp',
				function() {
					WC\Cart::add_to_cart();
				}
			);
		}

	}
}

add_action(
	'plugins_loaded',
	function() {
		new TeeMarket();
	},
	999
);
