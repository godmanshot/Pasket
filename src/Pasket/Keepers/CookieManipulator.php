<?php

namespace Pasket\Keepers;

class CookieManipulator {

	public function get($name) {
		return $_COOKIE[$name];
	}

	public function set($name, $value, $time = 3600) {
		setcookie($name, $value, $time);
	}

	public function unset($name) {
		unset($_COOKIE[$name]);
	}

	public function container() {
		return $_COOKIE;
	}
}