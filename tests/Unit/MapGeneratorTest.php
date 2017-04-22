<?php

namespace Tests\Unit;

use App\Factories\DummyResourceFactory;
use App\MapGenerator;
use App\Resource;
use App\Tile;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class MapGeneratorTest extends TestCase
{
    /** @var MapGenerator */
    private $generator;
    /** @var Collection */
    private $resources;

    public function setUp()
    {
        $this->resources = collect([new Resource, new Resource, new Resource]);
        $this->generator = new MapGenerator(new DummyResourceFactory($this->resources));
    }

    /** @test */
    public function it_generates_a_map_for_a_given_number_of_players()
    {
        for ($numberPlayers = 2; $numberPlayers < 6; ++$numberPlayers) {
            $map = $this->generator->generate($numberPlayers);

            $this->assertEquals(10 + ($numberPlayers - 2) * 2, $map->getSize(), sprintf(
                'Invalid size for %s players.', $numberPlayers
            ));
        }
    }

    /** @test */
    public function the_generated_map_contains_a_given_number_of_tiles_equals_to_the_size_squared()
    {
        $tiles = $this->generator->generate(2)->getTiles();

        // For 2 players we have a 10 * 10 map
        $this->assertCount(10 * 10, array_unique($tiles->toArray()));

        foreach ($tiles as $tile) {
            $this->assertInstanceOf(Tile::class, $tile);
        }
    }

    /** @test */
    public function each_tile_contains_a_resource_randomly_generated()
    {
        $tiles = $this->generator->generate(2)->getTiles();

        $modulo = count($this->resources);

        foreach ($tiles as $index => $tile) {
            $this->assertSame($this->resources->get($index % $modulo), $tile->getResource());
        }
    }
}
