<?php

namespace TeeMarket;

abstract class Model extends \WeDevs\ORM\Eloquent\Model {

	/**
	 * Created slug field from a field.
	 *
	 * @var string
	 */
	protected $slug_field = false;

	/**
	 * Disable created_at and update_at columns, unless you have those.
	 */
	public $timestamps = false;

	/**
	 * Name for table without prefix.
	 *
	 * @var string
	 */
	protected $added_prefix = false;

	/**
	 * Overide parent method to make sure prefixing is correct.
	 *
	 * @return string
	 */
	public function getTable() {

		// In this example, it's set, but this is better in an abstract class.
		if ( isset( $this->table ) ) {
			if ( ! $this->added_prefix ) {
				$prefix = $this->getConnection()->db->prefix;
				$this->added_prefix  = true;
				$this->table = $prefix . $this->table;
			}

			return $this->table;
		}

		return parent::getTable();
	}

	public function save( array $options = [] ) {

		if ( $this->slug_field ) {
			$slug = sanitize_title( $this->{$this->slug_field} );
			$original = $slug;
			$count = 2;
			static::getTable();

			while ( $this->where( 'slug', $slug )->exists() ) {
				$slug = "{$original}-" . $count++;
			}
			$this->slug = $slug;

		}
		return parent::save( $options );
	}



}
