<?php
declare(strict_types=1);

namespace App\Tests;

use App\Component\Command;
use PHPUnit\Framework\TestCase;

/**
 * Class CommandTest
 * @package App\Tests
 */
class CommandTest extends TestCase
{
    /**
     * @dataProvider caseProvider
     * @param string $stdin
     * @param bool $isValid
     * @param null|string $errorMessage
     * @param null|array $commandList
     */
    public function testCase(string $stdin, bool $isValid, ?string $errorMessage, ?array $commandList)
    {
        $command = new Command();
        $this->assertEquals($command->setCase($stdin), $isValid);
        $this->assertEquals($command->getError(), $errorMessage);
        $this->assertEquals($command->getCommandList(), $commandList);
    }

    /**
     * @return array
     */
    public function caseProvider()
    {
        return [
            ['2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60', true, null,
                [
                    ['command' => 'walk', 'value' => '40'],
                    ['command' => 'turn', 'value' => '40.0'],
                    ['command' => 'walk', 'value' => '60']
                ]
            ],
            ['87.342 34.30 start 0 walk 10.0 fail 23', false, 'Command fail not found', [
                ['command' => 'walk', 'value' => '10.0']
            ]],
            ['87.342 34.30 start ', false, 'Incorected command line', null],
            ['87.342 34.30 start 3 walk', false, 'Incorrect sequence of commands', null],
            ['1001 34.30 start 3', false, 'Variable x must be -1000 to 1000', null],
            ['1000 -1001 start 3', false, 'Variable y must be -1000 to 1000', null],
            ['1000 -1000 start 1000.0001', false, 'Variable angle must be -1000 to 1000', null],
            ['1000 -1000 start 3' . str_repeat(" walk 4", 26), false, 'Instruction limit exceeded',
                array_pad([], 26, ['command' => 'walk', 'value' => '4'])
            ],

        ];
    }
}