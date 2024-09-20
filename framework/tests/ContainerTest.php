<?php

namespace Somecode\Framework\Tests;

use PHPUnit\Framework\TestCase;
use Somecode\Framework\Container\Container;
use Somecode\Framework\Container\Exceptions\ContainerException;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container()
    {
        $container = new Container;
        $container->add('somecode-class', SomecodeClass::class);
        $this->assertInstanceOf(SomecodeClass::class, $container->get('somecode-class'));
    }

    public function test_container_has_exception_ContainerException_iff_add_wrong_service()
    {
        $container = new Container;
        $this->expectException(ContainerException::class);
        $container->add('no-class');

    }
}
