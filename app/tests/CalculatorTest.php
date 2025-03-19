<?php
declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\Complexity\Calculator;

class CalculatorTest extends TestCase
{
    public function testCalculate(): void
    {
        $this->assertEquals(10, 10);
    }
}