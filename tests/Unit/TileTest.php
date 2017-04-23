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
        $resource = new Resource(2);
        $tile = new Tile($resource);

        $this->assertSame($resource, $tile->getResource());
    }

    /** @test */
    public function it_is_json_serializable()
    {
        $tile = new Tile(new Resource(2));

        $this->assertJson(json_encode(['resource' => 1]), json_encode($tile));
    }
}
