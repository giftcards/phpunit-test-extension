<?php

namespace GiftCards\TestExtension\TestCase\Extension;

abstract class AbstractExtension extends \PHPUnit_Framework_Assert implements TestCaseAwareExtensionInterface
{

    protected $testCase;

    public function supportsMethod($method, array $arguments = array())
    {

        return method_exists($this, $method);
    }

    public function executeMethod($method, array $arguments = array())
    {

        return call_user_func_array(array($this, $method), $arguments);
    }

    public function setTestCase(ExtendableTestCaseInterface $testCase)
    {
        $this->testCase = $testCase;
        return $this;
    }

    protected function attemptTestCaseMethodCall($method, array $args = array())
    {
        if (is_callable(array($this->testCase, $method))) {

            return call_user_func_array(array($this->testCase, $method), $args);
        }

        throw new \BadMethodCallException('Could not call method');
    }
}
