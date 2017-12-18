<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Pasket\Keepers\CookieKeeper;

class CookieKeeperTest extends TestCase
{
    /**
     * @test
     */
    public function keeper_have_manipulator()
    {
        $keeper = container(CookieKeeper::class);

        $this->assertNotNull($keeper->manipulator());
    }

    /**
     * @test
     */
    public function keeper_can_save()
    {
        $keeper = container(CookieKeeper::class);
        
        $data = json_encode([1, 2, 3, 4, 5]);

        $keeper->save($data);

        $this->assertContains($data, $keeper->manipulator()->container());

        return $keeper;
    }

    /**
     * @test
     */
    public function keeper_can_delete()
    {
        $keeper = container(CookieKeeper::class);

        $data = json_encode([1, 2, 3, 4, 5]);

        $keeper->save($data);

        $keeper->delete();
        
        $this->assertNotContains($data, $keeper->manipulator()->container());
    }
}