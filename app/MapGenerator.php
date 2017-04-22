<?php
namespace App;


class MapGenerator
{
    const DEFAULT_SIZE = 10;
    const GRID_EXPANSION = 2;


    public function generate(int $numberPlayers): Map
    {
        return new Map(static::DEFAULT_SIZE + ($numberPlayers - 2) * static::GRID_EXPANSION);
    }
}