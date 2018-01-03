<?php

namespace Pasket;

use Pasket\Keepers\CookieKeeper;
use Pasket\Keepers\Keeper;

class Basket {

	/**
	 * Container for data
	 * @var array
	 */
	private $container = [];

	/**
	 * Data keeper
	 * @var [type]
	 */
	private $keeper;

	/**
	 * 
	 * @param Pasket\Keepers\Keeper|null $keeper
	 */
	public function __construct(Keeper $keeper = null) {

		$this->keeper = $keeper ? $keeper : new CookieKeeper('basket');

		$this->init();

	}

	/**
	 * Init basket
	 */
	public function init() {
		
		$data = $this->keeper->get();

		$this->container = $data ? $data : [];

	}

	/**
	 * Adds data to the container
	 * @param array $data
	 */
	public function add(array $data) {

		if(!isset($data['id']))
		{
			throw new \Exception('data must contain id');
		}

		$this->container[$data['id']] = $data;

		return $this;
	}

	
	
	/**
	 * Removes data from the container
	 * @param  array  $data
	 * @return $this
	 * @throw \OutOfRangeException
	 */
	public function delete($id) {

		if(!isset($this->container[$id]))
		{
			throw new \Exception('a key:'.$id.' does not exist');
		}

		unset($this->container[$id]);

		return $this;
	}

	/**
	 * Gets data from the container
	 * @param  boolean $id
	 * @return array
	 */
	public function get($id = false) {

		if($id === false)
		{

			return $this->container;

		} else {

			return $this->container[$id];

		}

	}

	/**
	 * Saves state|container in the keeper
	 */
	public function saveState() {

		$this->keeper->save($this->container);

	}

}