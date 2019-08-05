<?php
namespace App\Tests;

use App\Component\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    /**
     * @dataProvider walkProvider
     * @param float $x
     * @param float $y
     * @param float $angle
     * @param float $walk
     * @param float $resultX
     * @param float $resultY
     */
    public function testWalk(float $x, float $y, float $angle, float $walk, float $resultX, float $resultY)
    {
        $point = (new Point($x, $y, $angle))->walk($walk);
        $this->assertEquals(round($point->getX(), 4), $resultX);
        $this->assertEquals(round($point->getY(), 4), $resultY);
    }

    /**
     * @dataProvider turnProvider
     * @param float $x
     * @param float $y
     * @param float $angle
     * @param float $turn
     * @param float $resultAngle
     */
    public function testTurn(float $x, float $y, float $angle, float $turn, float $resultAngle)
    {
        $point = (new Point($x, $y, $angle))->turn($turn);
        $this->assertEquals(round($point->getAngle(), 4), $resultAngle);
    }

    /**
     * @return array
     */
    public function walkProvider()
    {
        return [
            [87.342, 34.30, 0, 10.0, 97.342, 34.3],
            [-2.6762, -75.2811, -45.0, 40, 25.6081, -103.5654],
            [2.6762, 75.2811, 45.0, -40.6532, -26.07, 46.5349],
            [2.6762, 75.2811, 360, 4, 6.6762, 75.2811]
        ];
    }

    /**
     * @return array
     */
    public function turnProvider()
    {
        return [
            [87.342, 34.30, 0, 10.0, 10.0001],
            [-2.6762, -75.2811, -45.0, 40, -5.0],
            [2.6762, 75.2811, 45.0, -40.6532, 4.3468],
            [2.6762, 75.2811, 360, 4, 4.0]
        ];
    }
}