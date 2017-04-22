<?php
namespace Tests\Unit;

use App\Resource;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    /** @test */
    public function it_has_a_number_of_points()
    {
        $resource = new Resource(5);

        $this->assertEquals(5, $resource->getPoints());
    }

    /** @test */
    public function it_is_json_serializable()
    {
        $this->assertEquals(5, json_encode(new Resource(5)));
    }
}