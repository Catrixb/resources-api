<?php
namespace App;

use Illuminate\Support\Collection;

class MapGenerator
{
    const DEFAULT_SIZE = 10;
    const GRID_EXPANSION = 2;

    public function generate(int $numberPlayers): Map
    {
        $mapSize = static::DEFAULT_SIZE + ($numberPlayers - 2) * static::GRID_EXPANSION;

        return new Map($mapSize, $this->generateTiles($mapSize));
    }

    private function generateTiles($mapSize): Collection
    {
        return new Collection(array_fill(0, $mapSize * $mapSize, new Tile));
    }
}
