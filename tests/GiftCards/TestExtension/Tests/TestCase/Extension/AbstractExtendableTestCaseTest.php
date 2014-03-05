<?php

namespace GiftCards\TestExtension\Tests\TestCase\Extension;

use GiftCards\TestExtension\TestCase\Extension\AbstractExtendableTestCase;
use GiftCards\TestExtension\Tests\Fixtures\MockAbstractExtendableTestCase;

use Mockery;

class AbstractExtendableTestCaseTest extends AbstractExtendableTestCase
{

    protected $testCase;

    public function setUp()
    {

        $this->testCase = new MockAbstractExtendableTestCase();
    }

    public function testGetExtensionClasses()
    {

        $extensions = array(
            'GiftCards\TestExtension\TestCase\Extension\EntityExtension',
            'GiftCards\TestExtension\TestCase\Extension\FakerExtension'
        );

        $this->assertEquals($extensions, $this->testCase->getExtensionClasses($extensions));
    }

    public function test__call()
    {

        $method = 'someMethod';
        $args = array('arg1');
        $extension = Mockery::mock('GiftCards\TestExtension\TestCase\Extension\ExtensionInterface');
        $extension
            ->shouldReceive('supportsMethod')
            ->with($method, $args)
            ->andReturn(true);
        $extension
            ->shouldReceive('executeMethod')
            ->with($method, $args)
            ->andReturn('executed');
        $this->testCase->addExtension($extension);
        $this->assertEquals('executed', $this->testCase->someMethod($args[0]));
    }

    public function test__callWithMethodNotFound()
    {

        $method = 'someMethod';
        $args = array('arg1');
        $extension = Mockery::mock('GiftCards\TestExtension\TestCase\Extension\ExtensionInterface');
        $extension
            ->shouldReceive('supportsMethod')
            ->with($method, $args)
            ->andReturn(false);
        $this->testCase->addExtension($extension);
        $this->setExpectedException('\BadMethodCallException');
        $this->testCase->someMethod($args[0]);
    }
}