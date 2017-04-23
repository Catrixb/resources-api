<?php

namespace App;

class Tile implements \JsonSerializable
{

    private $resource;
    private $player;
    private $tokenNumber = 0;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function setOccupant(Player $player, int $tokenNumber): self
    {
        $this->player = $player;
        $this->tokenNumber = $tokenNumber;

        return $this;
    }

    public function __toString()
    {
        return spl_object_hash($this);
    }

    public function getResource()
    {
        return $this->resource;
    }

    function jsonSerialize()
    {
        return [
            'resource' => $this->resource->jsonSerialize(),
            'occupant' => array_merge($this->getPlayer()->jsonSerialize(), ['token' => $this->tokenNumber])
        ];
    }

    public function getPlayer(): Player
    {
        return $this->player ?: new Player(['name' => 'none']);
    }

    public function getTokenNumber(): int
    {
        return $this->tokenNumber;
    }
}
