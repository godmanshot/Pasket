# Pasket
PHP basket shopping script

## Install
```bash
composer require godmanshot/pasket=dev
```

## Usage

### Add:
```php
use Pasket\Basket;

$basket = new Basket();
$basket->add(['id' => 1, 'name' => 'iPhone', 'price' => 1000]);
$basket->saveState();
```

### Get:
single:
```php
use Pasket\Basket;

$basket = new Basket();
$basket->get(1); // id = 1
```
all:
```php
use Pasket\Basket;

$basket = new Basket();
$basket->get();
```

### Delete:
```php
use Pasket\Basket;

$basket = new Basket();
$basket->delete(1); // id = 1
$basket->saveState();
```
