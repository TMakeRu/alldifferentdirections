<?php
declare(strict_types=1);

namespace App\Helper;

/**
 * Class Validator
 * @package App\Helper
 */
class Validator
{
    /**
     * Check integer range
     *
     * @param string $check
     * @param float $from
     * @param float $to
     * @return bool
     */
    public static function isIntegerRande(string $check, float $from, float $to): bool
    {
        return $check >= $from && $check <= $to && preg_match('#\d+#', $check);
    }

    /**
     * Check command valid
     *
     * @param string $command
     * @return bool
     */
    public static function isValidCommand(string $command): bool
    {
        return preg_match('#^[-]?[\d.]+\s[-]?[\d.]+\sstart\s[-]?[\d.]+#', $command) ? true : false;
    }

    /**
     * Check float range
     *
     * @param string $check
     * @param float $from
     * @param float $to
     * @return bool
     */
    public static function isFloatRande(string $check, float $from, float $to): bool
    {
        return $check >= $from && $check <= $to && preg_match('#[-]?[\d.]+#', $check);
    }
}
