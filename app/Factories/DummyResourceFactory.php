<?php

namespace App\Factories;

use App\Resource;
use Illuminate\Support\Collection;

class DummyResourceFactory implements ResourceFactory
{
    private $tiles;

    private $numberTiles;

    private $index = 0;

    public function __construct(Collection $tiles)
    {
        $this->tiles = $tiles;
        $this->numberTiles = count($this->tiles);
    }

    public function build(): Resource
    {
        $tile = $this->tiles->get($this->index % $this->numberTiles);
        ++$this->index;

        return $tile;
    }
}
