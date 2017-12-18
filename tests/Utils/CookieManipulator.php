<?php

namespace Tests\Utils;

class CookieManipulator {

	private $container = [];

	public function get($name) {
		return $this->container[$name];
	}

	public function set($name, $value, $time = 3600) {
		$this->container[$name] = $value;
	}

	public function unset($name) {
		unset($this->container[$name]);
	}

	public function container() {
		return $this->container;
	}
}