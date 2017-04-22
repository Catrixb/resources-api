<?php
/**
 * Created by catrix on 22/04/17
 */

namespace App;


class Map
{
    private $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}