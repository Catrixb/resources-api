<?php

namespace Tests\Unit\Factories;

use App\Factories\DummyResourceFactory;
use App\Resource;
use PHPUnit\Framework\TestCase;

class DummyResourceFactoryTest extends TestCase
{

    /** @test */
    public function it_retrieves_the_next_tile_from_the_provided_collection_as_fifo()
    {
        $resources = collect([new Resource(2), new Resource(2), new Resource(2)]);

        $factory = new DummyResourceFactory($resources);

        for ($i = 0; $i < 10; ++$i) {
            $this->assertSame($resources->get($i % 3), $factory->build());
        }
    }
}
