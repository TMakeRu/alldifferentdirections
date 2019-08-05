<?php
declare(strict_types=1);

namespace App\Component;

/**
 * Class Point
 * @package App\Component
 */
class Point
{
    use CordinateTrait;

    /**
     * Point constructor.
     *
     * @param float $x
     * @param float $y
     * @param float $angle
     */
    public function __construct(float $x, float $y, float $angle)
    {
        $this->x = $x;
        $this->y = $y;
        $this->setAngle($angle);
    }

    /**
     * To walk point on $stepCount step
     *
     * @param float $stepCount
     * @return Point
     */
    public function walk(float $stepCount): Point
    {
        $this->x += $this->getOneStep() * $stepCount;
        $this->y += $this->getOneStep(false) * $stepCount;
        return $this;
    }

    /**
     * To turn point on $angle degrees
     *
     * @param float $angle
     * @return Point
     */
    public function turn(float $angle): Point
    {
        $this->angle += $angle;
        while ($this->angle > 360) {
            $this->setAngle($this->angle - 360);
        }
        return $this;
    }

    /**
     * Get how much one step
     *
     * @param bool $isX
     * @return float
     */
    private function getOneStep(bool $isX = true): float
    {
        if ($this->angle == 0) {
            return 0;
        }

        $method = $isX ? 'cos' : 'sin';
        return $method(deg2rad($this->angle));
    }
}
