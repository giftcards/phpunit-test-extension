<?php
namespace GiftCards\TestExtension\Tests\TestCase\Extension;

use GiftCards\TestExtension\TestCase\Extension\AbstractExtension;
use GiftCards\TestExtension\TestCase\Extension\AbstractExtendableTestCase;

use Mockery;

class AbstractExtensionTest extends AbstractExtendableTestCase
{

    protected $extension;

    public function setUp()
    {
        $this->extension = new MockExtension();
    }

    public function testSupportsMethod()
    {
        $this->assertTrue($this->extension->supportsMethod('someMethod'));
        $this->assertFalse($this->extension->supportsMethod('otherMethod'));
    }

    public function testExecuteMethod()
    {
        $this->assertEquals('executed', $this->extension->executeMethod('someMethod'));
    }

    public function testSetTestCase()
    {
        $this->assertSame($this->extension, $this->extension->setTestCase($this));
    }

    public function testMethodForwarding()
    {
        $testCase = Mockery::mock(get_class())
            ->shouldReceive('blabla')
            ->once()
            ->with('arg1')
            ->andReturn('return')
            ->getMock();

        $this->extension->setTestCase($testCase);

        $this->assertEquals('return', $this->extension->forwardingMethod());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Could not call method
     */
    public function testMethodForwardingWhereMethodNotCallable()
    {
        $this->extension->forwardingMethod();
    }
}

class MockExtension extends AbstractExtension
{

    public function someMethod()
    {
        return 'executed';
    }

    public function forwardingMethod()
    {
        return $this->attemptTestCaseMethodCall(
            'blabla',
            array(
                'arg1'
            )
        );
    }
}
