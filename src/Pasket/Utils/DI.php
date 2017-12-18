<?php

namespace Pasket\Utils;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class DI {
	public static $builder;

	public static function get() {

		if(!self::$builder)
		{
			self::$builder = new ContainerBuilder();
		}

		return self::$builder;
	}
}