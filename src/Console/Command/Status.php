<?php

/**
 * This file is part of slick/console package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Console\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Status
 * 
 * @package Slick\Console\Console\Command
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class Status extends Command
{

    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('status')
            ->setDescription('Check the Slick Console installation status')
        ;
    }

    /**
     * Executes the command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * 
     * @return null|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = "Slick console installed successfully!";
        $output->writeln("<info>$text</info>");
        return 0;
    }
}