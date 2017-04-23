<?php
namespace Tests\Unit;

use App\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /** @test */
    public function it_has_default_value_for_a_player()
    {
        $player = new Player;

        $this->assertEquals('none', $player->name);
        $this->assertEquals(0, $player->token);
    }
}
