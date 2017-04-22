<?php

namespace Tests\Unit;

use App\MapGenerator;
use App\Tile;
use PHPUnit\Framework\TestCase;

class MapGeneratorTest extends TestCase
{
    /** @test */
    public function it_generates_a_map_for_a_given_number_of_players()
    {
        $generator = new MapGenerator();

        for ($numberPlayers = 2; $numberPlayers < 6; ++$numberPlayers) {
            $map = $generator->generate($numberPlayers);

            $this->assertEquals(10 + ($numberPlayers - 2) * 2, $map->getSize(), sprintf(
                'Invalid size for %s players.', $numberPlayers
            ));
        }
    }

    /** @test */
    public function the_generated_map_contains_a_given_number_of_tiles_equals_to_the_size_squared()
    {
        $generator = new MapGenerator();

        $tiles = $generator->generate(2)->getTiles();

        $this->assertCount(100, $tiles);

        foreach ($tiles as $tile) {
            $this->assertInstanceOf(Tile::class, $tile);
        }
    }
}
