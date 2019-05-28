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
    public function testCarbonFormat()
    {
        $date = Carbon::now();
        $result = DatesHelper::format($date);
        $date2 = Carbon::createFromFormat(Carbon::W3C, $result);
        $this->assertEquals($date->toAtomString(), $date2->toAtomString());
    }
    public function testNullFormat()
    {
        $date = null;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testEmptyFormat()
    {
        $date = '';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitStringFormat()
    {
        $date = 'Hello World';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitIntFormat()
    {
        $date = 42;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testBullshitBoolFormat()
    {
        $date = false;
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '');
    }
    public function testDateAsString()
    {
        $date = '27.10.2017';
        $result = DatesHelper::format($date);
        $this->assertEquals($result, '2017-10-27T00:00:00+02:00');
    }
}
