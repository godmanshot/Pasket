<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Pasket\Basket;

class BasketTest extends TestCase
{

    /**
     * @test
     */
    public function basket_can_get()
    {
        $basket = container(Basket::class);
        $this->assertInternalType('array', $basket->get());
    }

    /**
     * @test
     */
    public function basket_can_add()
    {
        $data = $this->data();
        $basket = container(Basket::class);
        $basket->add($data);

        $this->assertContains($data, $basket->get());

        return $basket;
    }

    /**
     * @test
     */
    public function basket_can_delete()
    {
        $data = $this->data();
        $basket = container(Basket::class);
        $basket->add($data);
        $basket->delete($data);
        $this->assertNotContains($data, $basket->get());
    }

    /**
     * @test
     */
    public function basket_can_prepare()
    {
        $data = $this->data();
        $basket = container(Basket::class);
        $basket->add($data);

        $this->assertEquals($basket->prepare(), json_encode([$data['id'] => $data]));
    }

    /**
     * @test
     */
    public function basket_can_unprepare()
    {
        $data = $this->data();
        $basket = container(Basket::class);
        
        $this->assertEquals($basket->unprepare(json_encode([$data['id'] => $data])), [$data['id'] => $data]);
    }

    /**
     * @test
     */
    public function basket_can_save_state()
    {
        $data = $this->data();
        $basket = container(Basket::class);
        $basket->add($data);
        $basket->saveState();

        $new_basket = container(Basket::class);
        
        $this->assertEquals($new_basket->get($data['id']), $data);

    }


    public function data() {
        return ['id' => 1, 'name' => 'iPhone', 'price' => 1000];
    }

}