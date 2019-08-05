<?php
namespace App\Controller;

use App\Component\Command;
use App\Component\Point;

/**
 * Class Navigation
 * @package App
 */
class Navigation
{
    /**
     * Limit precision average
     */
    const LIMIT_PRECISION_AVERAGE = 4;

    /**
     * Limit precision distance
     */
    const LIMIT_PRECISION_DISTANCE = 5;

    /**
     * @var []Point $points
     */
    private $points = [];

    /**
     * Average X coordinate
     *
     * @var float
     */
    private $averageX = 0;

    /**
     * Average Y coordinate
     *
     * @var float
     */
    private $averageY = 0;

    /**
     * Run navigation
     *
     * @param Command $command
     */
    public function run(Command $command)
    {
        $point = new Point((float)$command->getX(), (float)$command->getY(), (float)$command->getAngle());
        $commandList = $command->getCommandList();
        if (count($commandList) > 0) {
            foreach ($commandList as $item) {
                $point->{$item[Command::KEY]}($item[Command::VALUE]);
            }
        }

        $this->points[] = $point;
    }

    /**
     * Get all points
     *
     * @return array
     */
    public function getPoins(): array
    {
        return $this->points;
    }

    /**
     * Get average X coordinate
     *
     * @return float
     */
    public function getAverageX(): float
    {
        return round($this->averageX, self::LIMIT_PRECISION_AVERAGE);
    }

    /**
     * Get average Y coordinate
     *
     * @return float
     */
    public function getAverageY(): float
    {
        return round($this->averageY, self::LIMIT_PRECISION_AVERAGE);
    }

    /**
     * Initialization average X and Y
     */
    public function initAverage()
    {
        $sumX = $sumY = $count = 0;
        foreach ($this->points as $point) {
            $sumX += $point->getX();
            $sumY += $point->getY();
            $count++;
        }

        $this->averageX = $sumX / $count;
        $this->averageY = $sumY / $count;
    }

    /**
     * Get distance between worst and averaged
     *
     * @return float
     */
    public function getDistanceBetweenWorstAndAveraged(): float
    {
        $distanceBetweenWorstAndAveraged = 0;
        foreach($this->points as $point) {
            $distance = sqrt((($point->getX() - $this->averageX) ** 2) + (($point->getY() - $this->averageY) ** 2));
            if ($distance > $distanceBetweenWorstAndAveraged) {
                $distanceBetweenWorstAndAveraged = $distance;
            }
        }

        return round($distanceBetweenWorstAndAveraged, self::LIMIT_PRECISION_DISTANCE);
    }
}