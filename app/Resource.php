<?php

namespace App;

class Resource implements \JsonSerializable
{
    private $points;

    public function __construct(int $points)
    {
        $this->points = $points;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    function jsonSerialize()
    {
       return $this->points;
    }
}
