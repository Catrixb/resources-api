<?php
namespace App\Http\Controllers;

use App\MapGenerator;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameController extends Controller
{
    public function generateMap(MapGenerator $mapGenerator)
    {
        $map = $mapGenerator->generate(Player::count());
        $map->save();

        return new Response(['map' => $map, 'players' => Player::all()], 201, ['Content-Type' => 'application/json']);
    }

    public function join(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        Player::create($request->all());

        return new Response('', 201, ['Content-Type' => 'application/json']);
    }
}
