<?php

/**
 * This file is part of slick/console package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\Console\Console\Command;

use PHPUnit_Framework_TestCase as TestCase;
use Slick\Console\Console\Command\Status;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Status Command Test case
 *
 * @package Slick\Tests\Console\Console\Command
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class StatusTest extends TestCase
{

    /**
     * Executes the status command
     * @test
     */
    public function execute()
    {
        parent::setUp();
        $app = new Application();
        $app->add(new Status());

        $command = $app->find('status');
        $tester = new CommandTester($command);
        $tester->execute(['command' => $command]);
        $expected = 'Slick console installed successfully!';
        $this->assertRegExp("/$expected/", $tester->getDisplay());
    }
}
