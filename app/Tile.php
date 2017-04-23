<?php

namespace App;

class Tile implements \JsonSerializable
{

    private $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
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
        return ['resource' => $this->resource->jsonSerialize()];
    }
}
