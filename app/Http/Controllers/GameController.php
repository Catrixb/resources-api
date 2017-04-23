<?php
namespace App\Http\Controllers;

use App\MapGenerator;
use App\Player;
use Illuminate\Http\Response;

class GameController
{
    public function generateMap(MapGenerator $mapGenerator)
    {
        $map = $mapGenerator->generate(Player::count());
        $map->save();

        return new Response(['map' => $map, 'players' => Player::all()], 201, ['Content-Type' => 'application/json']);
    }
}