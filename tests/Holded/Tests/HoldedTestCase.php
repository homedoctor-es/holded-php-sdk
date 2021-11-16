<?php

namespace Holded\Tests;

use Dotenv\Dotenv;
use HomedoctorEs\Holded\Holded;
use PHPUnit\Framework\TestCase;

class HoldedTestCase extends TestCase
{

    /*
     * @var Holded
     */
    protected $holded;

    protected function setUp()
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../../');
        $dotenv->load();
        $this->holded = Holded::make();
    }

}