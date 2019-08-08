<?php
namespace TeeMarket;

// Test Insert.
$product_options = [
	'Product Type' => [
		'Long Sleeve',
		'Classic T-Shirt',
		'V-Neck T-Shirt',
		'Ladies T-Shirt',
		'Ladies Flowy Tank',
		'Ladies Flowy Tank',
		'Hooded Sweatshirt',
		'Crewneck Sweatshirt',
		'Baseball',
		'Unisex Tank',
		'Tote Bag',
		'Drawstring Bag',
		'Mug',
		'Hat',
	],

	'Color' => [
		'Black',
		'Chocolate',
		'Charcoal Grey',
		'Purple',
		'Athletic Heather',
		'Ash',
		'J Navy',
		'Royal',
		'Classic Pink',
		'Burnt Orange',
		'Gold',
		'Forest Green',
		'Kelly',
		'Kiwi',
		'True Red',
		'Cyber Pink',
		'Light Blue',
	],

	'Size' => [ 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL', '6XL' ],

];

$categories = [
	'Women' => [
		'T-Shirts' => [
			'Ladies Tees',
			'Premium Fitted Ladies Tees',
			'All Over Unisex Shirts',
			'Classic Polo',
		],
		'Tank Tops' => [
			'Ladies Flowy Tanks',
			'Unisex Tanks',
			'All Over Unisex Tanks',
		],
		'Hoodies',
		'Sweatshirts',
		'Dresses',
		'Leggings',
		'Long Sleeves' => [
			'Lightweight Jacket',
			'Dress shirt',
		],
	],
	'Men' => [
		'T-Shirts' => [
			'T-Shirts',
			'Classic Tees',
			'V-Neck Shirts',
			'Premium Fitted Tees',
			'All Over Unisex Shirts',
			'Classic Polo',
		],
		'Tank Tops' => [
			'Unisex Tanks',
			'All Over Unisex Tanks',
		],
		'Hoodies',
		'Sweatshirts',
		'Long Sleeves' => [
			'Lightweight Jacket',
			'Dress shirt',
		],
	],
];


global $created_cats;
$created_cats = [];


function example_create_cat( $cats, $parent_id = 0 ) {
	global $created_cats;
	$id = 0;
	if ( ! is_array( $cats ) ) {
		$cat = Product\Category::firstOrCreate( [ 'name' => $cats ], [ 'parent_id' => $parent_id ] );
		$id = $cat->id;
		$created_cats[ $id ] = $id;
		return $id;
	} else {
		foreach ( $cats as $cat_key => $cat_name ) {
			if ( ! is_array( $cat_name ) ) {
				$id = example_create_cat( $cat_name, $parent_id );
			} else {
				$parent_id = example_create_cat( $cat_key );
				$id = example_create_cat( $cat_name, $parent_id );
			}
		}
	}

	return $id;
}

example_create_cat( $categories );
$product = new Product();
$faker = \Faker\Factory::create();
$product->name = sprintf( 'Product %s ', $faker->name );
// $product->name = 'My Product one';
$product->price = 125;
$product->save();

// Set categories for product.
foreach ( $created_cats as $cid ) {
	$product->categories()->attach( $cid );
}

// Set product options.
$attr_options = array();
foreach ( $product_options as $option_name => $option_values ) {
	$option = new Product\VariantOption();
	$option->name = $option_name;
	$option->slug = sanitize_title( $option_name );
	$option_values = array_map( 'trim', $option_values );
	$option_values = array_filter( $option_values );
	$option->value = join( ' | ', $option_values );
	$attr_options[] = $option;
}

$variants = array();
foreach ( $product_options['Product Type'] as $type ) {
	foreach ( $product_options['Color'] as $color ) {
		foreach ( $product_options['Size'] as $size ) {
			$variant = new Product\Variant();
			$uid = \uniqid( 'test-' );
			$variant->name = sprintf( '%s %s %s', $type, $color, $size );
			$variant->price = 89;

			// Set variant options.
			$variant->option_1 = $type;
			$variant->option_2 = $color;
			$variant->option_3 = $size;

			$variants[] = $variant;

		}
	}
}

if ( ! empty( $attr_options ) ) {
	$product->options()->saveMany( $attr_options );
}

if ( ! empty( $variants ) ) {
	$product->variants()->saveMany( $variants );
}




