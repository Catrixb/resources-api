<?php

namespace Tests\Unit\Factories;

use App\Factories\RandomResourceFactory;
use App\Resource;
use PHPUnit\Framework\TestCase;

class RandomResourceFactoryTest extends TestCase
{
    /** @test */
    public function it_generates_a_random_resource_from_the_provided_resource_collection()
    {
        $resources = collect([new Resource(2), new Resource(2), new Resource(2)]);

        $factory = new RandomResourceFactory($resources);

        for ($i = 0; $i <= 5; ++$i) {
            $this->assertContains($factory->build(), $resources);
        }
    }
}
