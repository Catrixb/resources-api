<?php
/**
 * Created by catrix on 22/04/17
 */

namespace App;

use App\Exceptions\MapException;
use Illuminate\Support\Collection;

class Map
{
    private $size;
    private $tiles;

    public function __construct(int $size, Collection $tiles)
    {
        $this->size = $size;
        $this->tiles = $tiles;

        $this->checkNumberOfTilesForSize();
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getTiles(): Collection
    {
        return $this->tiles;
    }

    private function checkNumberOfTilesForSize()
    {
        if ($this->size * $this->size != $this->tiles->count()) {
            throw new MapException(
                sprintf(
                    'Invalid number of tiles. We should have %s for a map of a size of %s, %s tiles provided',
                    $this->size * $this->size,
                    $this->size,
                    $this->tiles->count()
                )
            );
        }
    }
}