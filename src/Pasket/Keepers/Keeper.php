<?php

namespace Pasket\Keepers;

abstract class Keeper {
	abstract public function get();
	abstract public function save($data);
	abstract public function delete();
}