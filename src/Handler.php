<?php
declare(strict_types=1);

namespace App;

use App\Component\Command;
use App\Controller\Navigation;
use App\Helper\Validator;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * Iteration constraint
     */
    const LIMIT_ITERATION_CASE = 100;

    /**
     * Сase range limitation
     */
    const LIMIT_RANGE_CASE = 20;

    /**
     * Handler constructor.
     */
    public function __construct()
    {
        $this->run();
    }

    /**
     * Run application
     */
    private function run()
    {
        for ($iterationCase = 0; $iterationCase < self::LIMIT_ITERATION_CASE; $iterationCase++) {
            $navigation = new Navigation();
            $this->printLn('How many cases? Enter from 0 to ' . self::LIMIT_RANGE_CASE . ':');
            $countCase = $this->getStdin();

            if (!Validator::isIntegerRande($countCase, 0, self::LIMIT_RANGE_CASE)) {
                $this->fatalError('Invalid value: ' . $countCase);
            }

            $countCase = (int)$countCase;
            if ($countCase == 0) {
                $this->stop();
            }

            for ($i = 1; $i <= $countCase; $i++) {
                $command = new Command();
                $this->printLn("Case #{$i}:");
                $case = $this->getStdin();

                if (!$command->setCase($case)) {
                    $this->fatalError($command->getError());
                }
                $navigation->run($command);
            }

            $navigation->initAverage();
            $this->printLn('');
            $this->printLn('Average x, y and distance between worst and averaged:');
            $this->printLn("{$navigation->getAverageX()} {$navigation->getAverageY()} {$navigation->getDistanceBetweenWorstAndAveraged()}");
            $this->printLn('');
        }

        $this->stop();
    }

    /**
     * Get row from stdin
     *
     * @return string
     */
    private function getStdin(): string
    {
        $handle = fopen ("php://stdin","r");
        $stdin = fgets($handle);
        fclose($handle);

        return $stdin;
    }

    /**
     * Print message
     *
     * @param string $message
     */
    private function printLn(string $message)
    {
        echo $message . "\r\n";
    }

    /**
     * Print fatal error message
     *
     * @param null|string $message
     */
    private function fatalError(?string $message)
    {
        $this->printLn("Fatal error: {$message}");
        $this->stop();
    }

    /**
     * Stop application
     */
    private function stop()
    {
        exit;
    }
}