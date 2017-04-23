<?php

namespace Tests\Feature;

use App\Factories\DummyResourceFactory;
use App\Factories\ResourceFactory;
use App\Player;
use App\Resource;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GameControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    public function it_generates_a_map()
    {
        $this->app[ResourceFactory::class] = new DummyResourceFactory(collect([new Resource(1)]));
        $players = factory(Player::class)->times(3)->create();

        $response = $this->post('/game/generate-map', [], ['Content-Type' => 'application/json']);

        $response->assertStatus(201);
        $response->assertJson([
            'map' => $this->generateMap(12, 12),
            'players' => $players->map(function(Player $player) {
                return $player->toArray();
            })->toArray()
        ]);

        $this->assertDatabaseHas('maps', ['content' => json_encode($this->generateMap(12, 12))]);
    }

    private function generateMap(int $x, int $y)
    {
        $map = [];

        for ($i = 0; $i < $x; ++$i) {
            for ($j = 0; $j < $y; ++$j) {
                $map[$i][$j] = ['resource' => 1, 'occupant' => ['name' => 'none', 'token' => 0]];
            }
        }

        return $map;
    }
}
