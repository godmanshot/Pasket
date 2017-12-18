# Pasket

## Install
```bash
> composer require godmanshot/pasket=dev
```

## Usage

```php
use Pasket\Basket;

$basket = new Basket();
$basket->add(['id' => 1, 'name' => 'iPhone', 'price' => 1000]);
$basket->saveState();
```
