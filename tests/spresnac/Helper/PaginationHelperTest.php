<?php

namespace spresnac\Helper\tests;

use PHPUnit\Framework\TestCase;
use spresnac\Helper\PaginationHelper;

/**
 * Class PaginationHelperTest.
 */
class PaginationHelperTest extends TestCase
{
    /** @test */
    public function generate_pagination_with_array(): void
    {
        $items = ['one' => 1, 'two' => 2];
        $result = PaginationHelper::paginate_collection($items);
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('links', $result);
        $this->assertArrayHasKey('meta', $result);
        $this->assertCount(2, $result['data']);
        $this->assertCount(4, $result['links']);
        $this->assertCount(6, $result['meta']);
    }

    /** @test */
    public function generate_pagination_with_collection(): void
    {
        $items = collect(['one' => 1, 'two' => 2]);
        $result = PaginationHelper::paginate_collection($items);
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('links', $result);
        $this->assertArrayHasKey('meta', $result);
        $this->assertCount(2, $result['data']);
        $this->assertCount(4, $result['links']);
        $this->assertCount(6, $result['meta']);
    }
}
