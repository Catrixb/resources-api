<?php
namespace App;


class MapGenerator
{
    public function __construct()
    {
    }

    public function generate(int $numberPlayers): Map
    {
        return new Map(10);
    }
}