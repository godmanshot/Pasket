<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Pasket\Keepers\CookieKeeper;

class CookieKeeperTest extends TestCase
{

    /**
     * @test
     */
    public function keeper_can_save()
    {
        $keeper = container(CookieKeeper::class);
        
        $data = ['id' => 1];

        $keeper->save($data);
        
        $this->assertEquals($data, $keeper->get());
    }

    /**
     * @test
     */
    public function keeper_can_delete()
    {
        $keeper = container(CookieKeeper::class);

        $data = ['id' => 1];

        $keeper->save($data);

        $keeper->delete();
        
        $this->assertFalse(isset($keeper->get()['id']));
    }
}