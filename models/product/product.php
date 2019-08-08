<?php

namespace TeeMarket;

class Product extends Model {

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $table = 'ts_products';

	/**
	 * Columns that can be edited - IE not primary key or timestamps if being used.
	 */
	protected $fillable = [
		'name',
		'slug',
		'price',
		'price_compare_at',
		'vendor',
		'product_type',
		'description',
		'updated_at',
		'published_at',
	];

	/**
	 * Created slug field from name.
	 *
	 * @var string
	 */
	protected $slug_field = 'name';

	/**
	 * Disable created_at and update_at columns, unless you have those.
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

	public function variants() {
		return $this->hasMany( 'TeeMarket\Product\Variant', 'product_id', 'id' );
	}

	public function categories() {
		return $this->belongsToMany( 'TeeMarket\Product\Category', 'wp_ts_product_cat_ref', 'product_id', 'cat_id' );
	}

	public function options() {
		return $this->hasMany( 'TeeMarket\Product\VariantOption', 'product_id', 'id' );
	}

}
