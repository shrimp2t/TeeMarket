<?php

namespace TeeMarket\Product;

use TeeMarket\Model as Model;
class ProductCategory extends Model {

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $table = 'ts_product_cat_ref';

	protected $primaryKey = [ 'product_id', 'cat_id' ];

	public $incrementing = false;

}
