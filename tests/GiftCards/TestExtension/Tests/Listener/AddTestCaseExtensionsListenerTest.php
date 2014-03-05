<?php
namespace GiftCards\TestExtension\Tests\Listener;

use GiftCards\TestExtension\Listener\AddTestCaseExtensionsListener,
    GiftCards\TestExtension\Tests\Fixtures\MockExtension,
    GiftCards\TestExtension\Tests\Fixtures\MockTestAwareExtension;

use Mockery;

class AddTestCaseExtensionsListenerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var $listener AddTestCaseExtensionsListener
     */
    protected $listener;
    protected $extension1;
    protected $extension2;
    protected $extensions;

    public function setUp()
    {
        MockExtension::$mock = $this->extension1 = Mockery::mock(
            'GiftCards\TestExtension\TestCase\Extension\ExtensionInterface'
        );
        MockTestAwareExtension::$mock = $this->extension2 = Mockery::mock(
            'GiftCards\TestExtension\TestCase\Extension\TestCaseAwareExtensionInterface'
        );

        $this->extensions = array(
            get_class(new MockExtension()),
            get_class(new MockTestAwareExtension())
        );

        $this->listener = new AddTestCaseExtensionsListener($this->extensions);
    }

    public function testStartTest()
    {
        $test = Mockery::mock(
            'PHPUnit_Framework_Test, GiftCards\TestExtension\TestCase\Extension\ExtendableTestCaseInterface'
        );

        $test
            ->shouldReceive('getExtensionClasses')
            ->with($this->extensions)
            ->andReturn($this->extensions);

        $test
            ->shouldReceive('addExtension')
            ->once()
            ->with(get_class(new MockExtension()))
            ->getMock()
            ->shouldReceive('addExtension')
            ->once()
            ->with(get_class(new MockTestAwareExtension()));

        $this->extension2
            ->shouldReceive('setTestCase')
            ->once()
            ->with($test);
        $this->listener->startTest($test);
    }

    public function testStartTestWithNotInstanceOfExtendableTestCase()
    {
        $test = Mockery::mock('PHPUnit_Framework_Test');
        $this->listener->startTest($test);
    }
}
