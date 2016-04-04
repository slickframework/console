<?php

/**
 * This file is part of slick/console package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

/**
 * Console Command Factory
 * 
 * @package Slick\Console
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class CommandFactory
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var array
     */
    protected $psr4Data;

    /**
     * CommandFactory constructor
     * 
     * @param Application $application
     * @param array       $psr4Data
     */
    public function __construct(Application $application, array $psr4Data = [])
    {
        $this->application = $application;
        $this->psr4Data = $psr4Data;
    }

    /**
     * Load all slick commands
     */
    public function loadCommands()
    {
        $slickModules = $this->filterSlickModules();
        $classes = $this->getCommandClasses($slickModules);
        foreach ($classes as $class) {
            if (is_subclass_of($class, Command::class)) {
                $this->application->add(new $class());
            }
        }
    }

    /**
     * Retrieves all Slick modules installed from composer
     * 
     * @return array
     */
    protected function filterSlickModules()
    {
        $iterator = new \ArrayIterator($this->psr4Data);
        $modules = [];
        foreach ($iterator as $nameSpace => $path) {
            if (preg_match('/^Slick\\\[a-z_]*\\\$/i', $nameSpace)) {
                $modules[$nameSpace] = reset($path);
            }
        }
        return $modules;
    }

    /**
     * Get user defined classes in "Console\Command" name space of each module
     * 
     * @param array $modules
     * @return array
     */
    protected function getCommandClasses(array $modules)
    {
        $classes = [];
        foreach ($modules as $nameSpace => $path) {
            $classes = array_merge($classes, $this->getClasses($nameSpace, $path));
        }
        return $classes;
    }

    /**
     * Get classes that implements the Command interface
     * 
     * @param string $namespace
     * @param string $path
     * 
     * @return array
     */
    protected function getClasses($namespace, $path)
    {
        $classes = [];
        $path = "$path/Console/Command";
        if (!is_dir($path)) {
            return $classes;
        }

        $dir = new \DirectoryIterator($path);
        $classFiles = new \RegexIterator($dir, '/[a-z_]*\.php/i');
        foreach ($classFiles as $file) {
            $classes[] = str_replace('.php', '', "{$namespace}Console\\Command\\{$file}");
        }
        return $classes;
    }
}