<?php

namespace SomeCode\Framework\Tests;

use PHPUnit\Framework\TestCase;
use Somecode\Framework\Session\Session;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        unset($_SESSION);
    }

    public function test_set_and_get_flash()
    {
        $session = new Session;
        $session->setFlash('success', 'Успешно!');
        $session->setFlash('error', 'Технически шоколадки...');
        $this->assertTrue($session->hasFlash('success'));
        $this->assertTrue($session->hasFlash('error'));
        $this->assertEquals(['Успешно!'], $session->getFlash('success'));
        $this->assertEquals(['Технически шоколадки...'], $session->getFlash('error'));
        $this->assertEquals([], $session->getFlash('warning'));
    }
}
