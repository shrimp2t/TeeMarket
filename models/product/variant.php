<?php

namespace TeeMarket\Product;

use TeeMarket\Model as Model;
class Variant extends Model {

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $table = 'ts_product_variants';


	/**
	 * Columns that can be edited - IE not primary key or timestamps if being used.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug',
		'sku',
		'price',
		'price_compare_at',
		'vendor',
		'option_1',
		'option_2',
		'option_3',
		'product_type',
		'inventory_quantity',
		'position',
		'inventory_management',
		'description',
		'image',
		'images',
		'updated_at',
		'published_at',
	];

	/**
	 * Disable created_at and update_at columns, unless you have those.
	 *
	 * @var boolean
	 */
	public $timestamps = true;

	/** Everything below this is best done in an abstract class that custom tables extend */

	/**
	 * Set primary key as ID, because WordPress
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Make ID guarded -- without this ID doesn't save.
	 *
	 * @var string
	 */
	protected $guarded = [ 'id' ];

	/**
	 * Overide parent method to make sure prefixing is correct.
	 *
	 * @return string
	 */
	public function getTable() {
		// In this example, it's set, but this is better in an abstract class.
		if ( isset( $this->table ) ) {
			$prefix = $this->getConnection()->db->prefix;
			return $prefix . $this->table;
		}

		return parent::getTable();
	}
	public function product() {
		return $this->belongsTo( 'TeeMarket\Product' );
	}

}
