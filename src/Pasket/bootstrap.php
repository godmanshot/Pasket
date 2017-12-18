<?php

use Pasket\Basket;
use Pasket\Keepers\CookieKeeper;
use Pasket\Keepers\CookieManipulator;
use Pasket\Utils\DI;
use Symfony\Component\DependencyInjection\Reference;

DI::get()->register('manipulator', CookieManipulator::class);
DI::get()->register(CookieKeeper::class, CookieKeeper::class)->addArgument('basket')->addArgument(new Reference('manipulator'));

function container($name) {
	return DI::get()->get($name);
}