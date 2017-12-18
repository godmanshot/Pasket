<?php

require './vendor/autoload.php';

use Symfony\Component\DependencyInjection\Reference;
use Pasket\Basket;
use Pasket\Keepers\CookieKeeper;
use Pasket\Utils\DI;
use Tests\Utils\CookieManipulator;

DI::get()->register('manipulator', CookieManipulator::class);
DI::get()->register(CookieKeeper::class, CookieKeeper::class)->addArgument('basket')->addArgument(new Reference('manipulator'))->setShared(false);
DI::get()->register(Basket::class, Basket::class)->setShared(false)->addArgument(new Reference(CookieKeeper::class));

function container($name) {
	return DI::get()->get($name);
}