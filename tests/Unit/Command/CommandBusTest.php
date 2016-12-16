<?php
namespace Unit;

use Devmobsters\Capo\Command\Command;
use Devmobsters\Capo\Command\CommandBus;
use Devmobsters\Capo\Command\CommandHandler;
use Devmobsters\Capo\Exception\CommandHandlerNotFoundException;
use Devmobsters\Capo\Queue\Client;
use Devmobsters\Capo\Queue\ShouldBeQueued;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class CommandBusTest extends TestCase
{
    private $client;

    private $container;

    private $bus;

    public function setUp()
    {
        $this->client = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_no_handler_is_found()
    {
        $this->bus = new CommandBus($this->container, $this->client, []);

        $this->expectException(CommandHandlerNotFoundException::class);

        $command = new TestCommand();

        $this->bus->dispatch($command);
    }

    /**
     * @test
     */
    public function it_dispatches_a_command()
    {
        $handlers = [TestCommand::class => ['handlers' => ['test.handler', 'test.handler.2'], 'channel' => 'default']];

        $this->bus = new CommandBus($this->container, $this->client, $handlers);

        $this->container->expects($this->at(0))
            ->method('get')
            ->with('test.handler')
            ->willReturn(new TestHandler());

        $this->container->expects($this->at(1))
            ->method('get')
            ->with('test.handler.2')
            ->willReturn(new TestHandler());

        $command = new TestCommand();

        $this->bus->dispatch($command);
    }

    /**
     * @test
     */
    public function it_dispatches_a_command_in_the_queue()
    {
        $handlers = [QueueCommand::class => ['handlers' => ['test.handler'], 'channel' => 'default']];

        $this->bus = new CommandBus($this->container, $this->client, $handlers);

        $this->client->expects($this->once())
            ->method('send');

        $command = new QueueCommand();

        $this->bus->dispatch($command);
    }

    /**
     * @test
     */
    public function it_retrieves_all_command_handlers()
    {
        $handlers = [QueueCommand::class => ['handlers' => ['test.handler'], 'channel' => 'default']];
        $this->bus = new CommandBus($this->container, $this->client, $handlers);

        $this->container->expects($this->any())
            ->method('get')
            ->willReturn('Handler');

        $handlersResult = $this->bus->getCommandHandlers(new QueueCommand());

        $this->assertEquals([
            'Handler'
        ], $handlersResult);

    }
}

class TestCommand implements Command {}

class QueueCommand implements Command, ShouldBeQueued {}

class TestHandler implements CommandHandler {

    /**
     * @param Command $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        // TODO: Implement handle() method.
    }
}