<?php

use Pasket\Basket;
use Pasket\Security\Encryption;

require './vendor/autoload.php';

$basket = new Basket();
var_dump($basket->get());