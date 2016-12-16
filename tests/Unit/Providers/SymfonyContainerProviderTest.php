<?php
namespace Unit;

use Devmobsters\Capo\Container\Providers\SymfonyContainerProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @package Unit\SymfonyContainerProviderTest
 * @author  Frank Levering <frank.levering@devmob.com>
 */
class SymfonyContainerProviderTest extends TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var SymfonyContainerProvider
     */
    private $provider;

    public function setUp()
    {
        $this->container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->provider = new SymfonyContainerProvider($this->container);
    }

    /**
     * @test
     */
    public function it_calls_get_on_the_service_container()
    {
        $class = new class{};

        $this->container->expects($this->once())
            ->method('get')
            ->with('service')
            ->willReturn($class);

        $result = $this->provider->get('service');

        $this->assertEquals($class, $result);
    }

    /**
     * @test
     */
    public function it_calls_has_on_the_service_container()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with('service')
            ->willReturn(true);

        $result = $this->provider->has('service');

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function it_returns_a_container()
    {
        $container = $this->provider->getContainer();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }
}
