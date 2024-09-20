<?php

namespace Somecode\Framework\Tests;

use PHPUnit\Framework\TestCase;
use Somecode\Framework\Container\Container;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container()
    {
        $container = new Container;
        $container->add('somecode-class', SomecodeClass::class);
        $this->assertInstanceOf(SomecodeClass::class, $container->get('somecode-class'));
    }
}
