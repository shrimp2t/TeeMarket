<?php

namespace TeeMarket\WC;

class Cart {

	public function add_to_cart( $product_id = 0, $quantity = 1, $variation_id = 0 ) {

		var_dump( WC()->cart->cart_contents );
	
		// $this->cart_contents[ $cart_item_key ] = apply_filters(
		// 	'woocommerce_add_cart_item',
		// 	array_merge(
		// 		$cart_item_data,
		// 		array(
		// 			'key'          => $cart_item_key,
		// 			'product_id'   => $product_id,
		// 			'variation_id' => $variation_id,
		// 			'variation'    => $variation,
		// 			'quantity'     => $quantity,
		// 			'data'         => $product_data,
		// 			'data_hash'    => wc_get_cart_item_data_hash( $product_data ),
		// 		)
		// 	),
		// 	$cart_item_key
		// );
	}

}

