<?php

namespace GiftCards\TestExtension\TestCase\Extension;

abstract class AbstractExtendableTestCase extends \PHPUnit_Framework_TestCase implements ExtendableTestCaseInterface
{
    protected $testCaseExtensions = array();

    public function getExtensionClasses(array $defaultExtensions)
    {
        return $defaultExtensions;
    }

    public function addExtension(ExtensionInterface $extension)
    {
        $this->testCaseExtensions[] = $extension;

        return $this;
    }

    public function __call($method, $args)
    {
        foreach ($this->testCaseExtensions as $extension) {

            if ($extension->supportsMethod($method, $args)) {

                return $extension->executeMethod($method, $args);
            }
        }

        throw new \BadMethodCallException("Method call '$method' is not supported");
    }
}
