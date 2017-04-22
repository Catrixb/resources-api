<?php

namespace Tests\Unit;

use App\MapGenerator;
use PHPUnit\Framework\TestCase;

class MapGeneratorTest extends TestCase
{
    /** @test */
    public function it_generate_a_map_for_a_given_number_of_players()
    {
        $generator = new MapGenerator();

        for ($numberPlayers = 2; $numberPlayers < 6; ++$numberPlayers) {
            $map = $generator->generate($numberPlayers);

            $this->assertEquals(10 + ($numberPlayers - 2) * 2, $map->getSize(), sprintf(
                'Invalid size for %s players.', $numberPlayers
            ));
        }
    }
}
