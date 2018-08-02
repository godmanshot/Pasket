<?php

namespace Pasket\Keepers;

class CookieManipulator {

	public function get($name) {
		if (isset($_COOKIE[$name]))
			return $_COOKIE[$name];
		else
			return json_encode([]);
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