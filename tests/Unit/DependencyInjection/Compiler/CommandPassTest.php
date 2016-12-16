<?php
//namespace Fxgp\Core\Testing\Unit\Infrastructure\DependencyInjection\Compiler;
//
//use Fxgp\Core\Infrastructure\DependencyInjection\Compiler\CommandPass;
//use PHPUnit\Framework\TestCase;
//use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Symfony\Component\DependencyInjection\Definition;
//
//class CommandPassTest extends TestCase
//{
//    private $container;
//
//    private $defintion;
//
//    private $handlers;
//
//    public function setUp()
//    {
//        $this->container = $this->getMockBuilder(ContainerBuilder::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $this->defintion = $this->getMockBuilder(Definition::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $this->handlers = [
//            'test.handler' => [
//                [
//                    'name' => 'command',
//                    'command' => 'DummyNameSpace\TestCommand',
//                ]
//            ],
//            'test.handler.2' => [
//                [
//                    'name' => 'command',
//                    'command' => 'DummyNameSpace\TestCommand',
//                ]
//            ]
//        ];
//    }
//
//    /**
//     * @test
//     */
//    public function it_should_build_an_array_of_commands()
//    {
//        $this->container->expects($this->once())
//            ->method('findTaggedServiceIds')
//            ->with('command')
//            ->willReturn($this->handlers);
//
//        $this->container->expects($this->any())
//            ->method('getDefinition')
//            ->willReturn($this->defintion);
//
//        $result = [
//            'DummyNameSpace\TestCommand' => [
//                'handlers' => [
//                    'test.handler',
//                    'test.handler.2'
//                ],
//                'channel' => 'default'
//            ]
//        ];
//
//        $this->defintion->expects($this->at(0))
//            ->method('addArgument')
//            ->with($result);
//
//        $commandPass = new CommandPass();
//
//        $commandPass->process($this->container);
//
//    }
//}
