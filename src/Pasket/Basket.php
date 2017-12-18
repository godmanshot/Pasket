<?php

namespace Pasket;

use Pasket\Keepers\CookieKeeper;
use Pasket\Keepers\Keeper;

class Basket {

	private $container = [];
	private $keeper;

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

	public function add($data) {

		if(isset($data['id']))
		{

			$this->container[$data['id']] = $data;

		} else {

			$this->container[] = $data;
			
		}

		return $this;
	}

	public function delete($data, $deleteAll = false) {

		if(isset($data['id']))
		{

			unset($this->container[$data['id']]);

		} else {

			foreach($this->container as $indx => $elem)
			{

				if($elem == $data)
				{

					unset($elem);
					
					if(!$deleteAll)
					{

						return $this;
					}

				}

			}

		}

		return $this;
	}

	public function get($id = false) {

		if($id === false)
		{

			return $this->container;

		} else {

			return $this->container[$id];

		}

	}

	public function unprepare($data) {

		return json_decode($data, true);

	}

	public function prepare() {

		return json_encode($this->container);

	}

	public function saveState() {
		$this->keeper->save($this->prepare());
	}

}