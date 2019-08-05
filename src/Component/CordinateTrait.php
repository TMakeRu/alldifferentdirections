<?php
declare(strict_types=1);

namespace App\Component;

/**
 * Trait CordinateTrait
 * @package App\Component
 */
trait CordinateTrait
{
    /**
     * X coordinate
     *
     * @var float
     */
    private $x = 0.0;

    /**
     * Y coordinate
     *
     * @var float
     */
    private $y = 0.0;

    /**
     * Angle turn
     *
     * @var float
     */
    private $angle = 0.0;

    /**
     * Get X coordinate
     *
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Get Y coordinate
     *
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Get angle turn
     *
     * @return float
     */
    public function getAngle(): float
    {
        return $this->angle;
    }

    /**
     * Set angle turn
     *
     * @param float $angle
     */
    public function setAngle(float $angle)
    {
        $this->angle = $angle;
        $this->deficiencyCorrectionAngle();
    }

    /**
     * Correction of flaws in the calculation of the angle
     */
    private function deficiencyCorrectionAngle()
    {
        if ($this->angle == 0) {
            $this->angle += 0.0001;
        }
    }
}
