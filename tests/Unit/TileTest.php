<?php

namespace Tests\Unit;

use App\Resource;
use App\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase
{
    /** @test */
    public function it_returns_its_resource()
    {
        $resource = new Resource;
        $tile = new Tile($resource);

        $this->assertSame($resource, $tile->getResource());
    }
}
