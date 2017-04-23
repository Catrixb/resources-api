<?php
/**
 * Created by catrix on 22/04/17
 */

namespace App;

use App\Exceptions\MapException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Map extends Model
{
    private $size;
    private $tiles;

    /**
     * @param int $size
     * @param Collection $tiles
     *
     * @return static
     *
     * @throws MapException
     */
    public static function createNewMapBySizeAndTiles(int $size, Collection $tiles)
    {
        $map = new static;

        $map->size = $size;
        $map->tiles = $tiles;

        $map->checkNumberOfTilesForSize();

        return $map;
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function(Map $map) {
            $map->attributes['content'] = json_encode($map->jsonSerialize());
        });
    }

    public function jsonSerialize()
    {
        $map = [];

        for ($i = 0; $i < $this->size; ++$i) {
            for ($j = 0; $j < $this->size; ++$j) {
                $map[$i][$j] = $this->tiles->get($i * $this->size + $j);
            }
        }

        return $map;
    }
}
