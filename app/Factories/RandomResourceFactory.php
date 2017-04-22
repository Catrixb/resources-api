<?php
namespace App\Factories;

use Illuminate\Support\Collection;
use App\Resource;

class RandomResourceFactory implements ResourceFactory
{
    private $resources;

    public function __construct(Collection $resources)
    {
        $this->resources = $resources;
    }

    public function build(): Resource
    {
        return $this->resources->random();
    }
}