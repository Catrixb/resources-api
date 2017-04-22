<?php

namespace App\Factories;

use App\Resource;
use Illuminate\Support\Collection;

class DummyResourceFactory implements ResourceFactory
{
    private $resources;

    private $numberResources;

    private $index = 0;

    public function __construct(Collection $resources)
    {
        $this->resources = $resources;
        $this->numberResources = count($this->resources);
    }

    public function build(): Resource
    {
        $resource = $this->resources->get($this->index % $this->numberResources);
        ++$this->index;

        return $resource;
    }
}
