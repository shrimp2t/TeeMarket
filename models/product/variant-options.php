<?php

namespace TeeMarket\Product;

use TeeMarket\Model as Model;
class VariantOption extends Model {

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $table = 'ts_variant_options';


	/**
	 * Columns that can be edited - IE not primary key or timestamps if being used.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'slug',
		'name',
		'value',
	];

	public function product() {
		return $this->belongsTo( 'TeeMarket\Product' );
	}

}
