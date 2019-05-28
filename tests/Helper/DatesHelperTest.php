<?php

namespace spresnac\Helper\tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use spresnac\Helper\DatesHelper;

/**
 * Class DatesHelperTest
 *
 * @package Tests\Helper
 */

class DatesHelperTest extends TestCase
{
    public function testCarbonFormat(): void
    {
        $date = Carbon::now();
        $result = DatesHelper::format($date);
        $date2 = Carbon::createFromFormat(Carbon::W3C, $result);
        $this->assertEquals($date->toAtomString(), $date2->toAtomString());
    }
    public function testNullFormat(): void
    {
        $date = null;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testEmptyFormat(): void
    {
        $date = '';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitStringFormat(): void
    {
        $date = 'Hello World';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitIntFormat(): void
    {
        $date = 42;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitBoolFormat(): void
    {
        $date = false;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testDateAsString(): void
    {
        $date = '27.10.2017';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '2017-10-27T00:00:00+00:00');
    }
}
