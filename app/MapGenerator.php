<?php
namespace App;

use App\Factories\ResourceFactory;
use Illuminate\Support\Collection;

class MapGenerator
{
    const DEFAULT_SIZE = 10;
    const GRID_EXPANSION = 2;

    private $resourceFactory;

    public function __construct(ResourceFactory $resourceFactory)
    {
        $this->resourceFactory = $resourceFactory;
    }

    public function generate(int $numberPlayers): Map
    {
        $mapSize = static::DEFAULT_SIZE + ($numberPlayers - 2) * static::GRID_EXPANSION;

        return new Map($mapSize, $this->generateTiles($mapSize));
    }

    private function generateTiles($mapSize): Collection
    {
        $tiles = new Collection;

        for ($i = 0; $i < $mapSize * $mapSize; ++$i) {
            $tiles->push(new Tile($this->resourceFactory->build()));
        }

        return $tiles;
    }
}
