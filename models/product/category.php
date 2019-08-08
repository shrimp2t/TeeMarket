<?php

namespace TeeMarket\Product;

use TeeMarket\Model as Model;
class Category extends Model {

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $table = 'ts_product_categories';


	/**
	 * Columns that can be edited - IE not primary key or timestamps if being used.
	 */
	protected $fillable = [
		'name',
		'parent_id',
		'description',
	];

	/**
	 * Disable created_at and update_at columns, unless you have those.
	 */
	public $timestamps = false;

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

	public function products() {
		return $this->belongsToMany( 'TeeMarket\Product', 'wp_ts_product_cat_ref', 'cat_id', 'product_id' );
	}

}
