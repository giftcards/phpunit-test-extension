<?php

namespace Giftcards\TestExtension\Listener;

use Giftcards\TestExtension\TestCase\Extension\ExtendableTestCaseInterface;

class AddTestCaseExtensionsListener implements \PHPUnit_Framework_TestListener
{

    protected $extensions;

    public function __construct(array $extensions = array())
    {

        $this->extensions = $extensions;
    }

    public function startTest(\PHPUnit_Framework_Test $test)
    {

        if (!$test instanceof ExtendableTestCaseInterface) {

            return;
        }

        $extensions = $test->getExtensionClasses($this->extensions);

        foreach ($extensions as $className) {

            $test->addExtension(new $className());
        }
    }

    //@codeCoverageIgnoreStart
    public function addError(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function addFailure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    public function addIncompleteTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function addSkippedTest(\PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
    }

    public function endTest(\PHPUnit_Framework_Test $test, $time)
    {
    }

    public function endTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
    }

    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
    }
    //@codeCoverageIgnoreEnd
}
