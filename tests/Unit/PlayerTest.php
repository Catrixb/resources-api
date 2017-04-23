<?php
namespace Tests\Unit;

use App\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /** @test */
    public function it_returns_an_id_even_if_undefined()
    {
        $player = new Player;

        $this->assertEquals(['name' => 'none', 'token' => 0], $player->toArray());
    }
}
