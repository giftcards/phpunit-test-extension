<?php

namespace GiftCards\TestExtension\Tests\Fixtures;

use GiftCards\TestExtension\TestCase\Extension\TestCaseAwareExtensionInterface;
use GiftCards\TestExtension\TestCase\Extension\ExtendableTestCaseInterface;

class MockTestAwareExtension implements TestCaseAwareExtensionInterface
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

    public function setTestCase(ExtendableTestCaseInterface $testCase)
    {
        return self::$mock->setTestCase($testCase);
    }
}