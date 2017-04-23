<?php

namespace Tests\Unit;

use App\Player;
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
        $tile->setOccupant(new Player(['name' => 'Didier']), 3);

        $this->assertJsonStringEqualsJsonString(json_encode(['resource' => 2, 'occupant' => ['name' => 'Didier', 'token' => 3]]), json_encode($tile));
    }

    /** @test */
    public function it_can_have_an_occupant()
    {
        $tile = new Tile(new Resource(2));

        $this->assertEquals('none', $tile->getPlayer()->name);
        $this->assertEmpty($tile->getTokenNumber());

        $tile->setOccupant(new Player(['name' => 'Etienne']), 3);

        $this->assertEquals('Etienne', $tile->getPlayer()->name);
        $this->assertEquals(3, $tile->getTokenNumber());
    }
}
