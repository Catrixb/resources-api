<?php

namespace Tests\Feature;

use App\Factories\DummyResourceFactory;
use App\Factories\ResourceFactory;
use App\Map;
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
    public function it_deletes_the_game()
    {
        $map = factory(Map::class)->create();
        $players = factory(Player::class)->times(3)->create();

        $this->assertDatabaseHas('maps', $map->toArray());
        $players->each(function(Player $player) {
            $this->assertDatabaseHas('players', $player->toArray());
        });

        $response = $this->deleteJson('/game');

        $response->assertStatus(204);

        $this->assertDatabaseMissing('maps', $map->toArray());
        $players->each(function(Player $player) {
            $this->assertDatabaseMissing('players', $player->toArray());
        });
    }

    /** @test */
    public function it_generates_a_map()
    {
        $this->app[ResourceFactory::class] = new DummyResourceFactory(collect([new Resource(1)]));
        $players = factory(Player::class)->times(3)->create();

        $response = $this->postJson('/game/generate-map');

        $response->assertStatus(201);
        $response->assertJson([
            'map' => $this->generateMap(12, 12),
            'players' => $players->map(function(Player $player) {
                return $player->toArray();
            })->toArray()
        ]);

        $this->assertDatabaseHas('maps', ['content' => json_encode($this->generateMap(12, 12))]);
    }

    /** @test */
    public function a_player_can_join_the_game()
    {
        $response = $this->postJson('/game/join', ['name' => 'Jean']);

        $response->assertStatus(204);

        $this->assertDatabaseHas('players', ['name' => 'Jean']);
    }

    /** @test */
    public function a_player_must_provide_a_name_to_join_the_game()
    {
        $response = $this->postJson('/game/join');

        $response->assertStatus(422);
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
