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

		if($keeper)
		{

			$this->keeper = $keeper;

		} else {

			$this->keeper = new CookieKeeper('basket');

		}

		if(($this->container = $this->unprepare($this->keeper->get())) === null)
		{

			$this->container = [];

		}

	}

	/**
	 * Adds data to the container
	 * @param array $data
	 */
	public function add(array $data) {

		if(isset($data['id']))
		{

			$this->container[$data['id']] = $data;

		} else {

			$this->container[] = $data;
			
		}

		return $this;
	}

	
	
	/**
	 * Removes data from the container
	 * @param  array  $data
	 * @return $this
	 * @throw \OutOfRangeException
	 */
	public function delete($id) {

		if(isset($this->container[$id]))
		{

			unset($this->container[$id]);

		} else {

			throw new \OutOfRangeException('a key:'.$id.' does not exist');

		}

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
	 * Unprepares data for storage
	 * @param  array $data
	 * @return string
	 */
	public function unprepare($data) {

		return json_decode($data, true);

	}

	/**
	 * Prepares data for storage
	 * @param  array $data
	 * @return string
	 */
	public function prepare() {

		return json_encode($this->container);

	}

	/**
	 * Saves state|container in the keeper
	 */
	public function saveState() {
		$this->keeper->save($this->prepare());
	}

}