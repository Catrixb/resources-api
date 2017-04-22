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

    /**
     * @param int $size
     * @param Collection $tiles
     *
     * @throws MapException
     */
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

    /**
     * @param int $x
     * @param int $y
     *
     * @return Tile
     *
     * @throws MapException
     */
    public function getTileByCoordinates(int $x, int $y): Tile
    {
        try {
            return $this->tiles->get($this->size * ($y - 1) + $x - 1);
        } catch (\Throwable $e) {
            throw new MapException(
                "You're trying to access a non existing tile ($x, $y) for a maximum of ($this->size, $this->size)"
            );
        }
    }
}
