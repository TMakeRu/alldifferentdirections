<?php
declare(strict_types=1);

namespace App\Component;

use App\Helper\Validator;

/**
 * Class Command
 * @package App\Component
 */
class Command
{
    use CordinateTrait;

    /**
     * Start range limit
     */
    const START_RANGE_LIMIT = -1000;

    /**
     * End range limit
     */
    const END_RANGE_LIMIT = 1000;

    /**
     * Limit instruction
     */
    const LIMIT_INSTRUCTION = 25;

    /**
     * Key for array $commandList
     */
    const KEY = 'command';

    /**
     * Value for array $commandList
     */
    const VALUE = 'value';

    /**
     * Command list
     *
     * @var array
     */
    private $commandList;

    /**
     * Error message
     *
     * @var null|string
     */
    private $error = null;

    /**
     * Allow command list
     *
     * @var array
     */
    private $allowCommands = ['turn', 'walk'];

    /**
     * Set case
     *
     * @param string $stdin
     * @return bool
     */
    public function setCase(string $stdin): bool
    {
        if (!Validator::isValidCommand($stdin)) {
            $this->error = 'Incorected command line';
            return false;
        }

        $commands = explode(' ', $stdin);
        $this->x = (float)array_shift($commands);
        $this->y = (float)array_shift($commands);
        if (!$this->defineCommand($commands)) {
            return false;
        }

        return $this->isValid();
    }

    /**
     * Get error message
     *
     * @return null|string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Get array command list
     *
     * @return array|null
     */
    public function getCommandList(): ?array
    {
        return $this->commandList;
    }

    /**
     * Validation x, y and angle
     *
     * @return bool
     */
    private function isValid(): bool
    {
        foreach (['x', 'y', 'angle'] as $item) {
            if (!Validator::isFloatRande((string)$this->$item, self::START_RANGE_LIMIT, self::END_RANGE_LIMIT)) {
                $this->error = 'Variable ' . $item . ' must be ' . self::START_RANGE_LIMIT . ' to ' . self::END_RANGE_LIMIT;
                return false;
            }
        }

        if (count($this->commandList) > self::LIMIT_INSTRUCTION) {
            $this->error = 'Instruction limit exceeded';
            return false;
        }

        return true;
    }

    /**
     * Define command
     *
     * @param array $commands
     * @return bool
     */
    private function defineCommand(array $commands): bool
    {
        for ($i = 0; $i < count($commands); $i += 2) {
            if (!isset($commands[$i + 1])) {
                $this->error = 'Incorrect sequence of commands';
                return false;
            }

            if ($commands[$i] == 'start') {
                $this->setAngle((float)$commands[$i + 1]);
                continue;
            }

            if (!in_array($commands[$i], $this->allowCommands)) {
                $this->error = 'Command ' . $commands[$i] . ' not found';
                return false;
            }


            $this->commandList[] = [
                'command' => $commands[$i],
                'value' => $commands[$i + 1]
            ];
        }

        return true;
    }


}