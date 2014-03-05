<?php

namespace GiftCards\TestExtension\Tests\Fixtures;

use GiftCards\TestExtension\TestCase\Extension\ExtensionInterface;

class MockExtension implements ExtensionInterface
{
    public static $mock;

    public function supportsMethod($method, array $arguments = array())
    {
        return self::$mock->supportsMethod($method, $arguments);
    }

    public function executeMethod($method, array $arguments = array())
    {
        return self::$mock->executeMethod($method, $arguments);
    }
}