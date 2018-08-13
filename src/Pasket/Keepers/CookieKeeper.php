<?php

namespace Pasket\Keepers;

use Pasket\Keepers\CookieManipulator;
use Pasket\Keepers\Keeper;

class CookieKeeper extends Keeper {

	protected $name;
	
	protected $manipulator;

	public	function __construct($name, $cookie_manipulator = null) {

		$this->name = $name;

		if($cookie_manipulator)
		{

			$this->manipulator = $cookie_manipulator;

		} else {

			$this->manipulator = new CookieManipulator();

		}

	}

	public function get() {

		return $this->manipulator->get($this->name);

	}

	public function save($data) {

		if(gettype($data) == 'string')
		{

			$this->manipulator->set($this->name, $data, time()+3600);

		} else {

			throw new \InvalidArgumentException('$data variable must be a string');

		}
	}

	public function delete() {

		$this->manipulator->unset($this->name);

	}

	public function manipulator() {

		return $this->manipulator;

	}
}