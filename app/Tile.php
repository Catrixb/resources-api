<?php

namespace App;

class Tile
{

    public function __toString()
    {
        return spl_object_hash($this);
    }
}
