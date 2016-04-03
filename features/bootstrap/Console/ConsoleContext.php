<?php

/**
 * This file is part of slick/console package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Console;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

/**
 * Step definitions for slick/console package
 *
 * @package Console
 * @behatContext
 */
class ConsoleContext extends \AbstractContext implements
    Context, SnippetAcceptingContext
{

}