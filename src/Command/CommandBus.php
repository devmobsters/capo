<?php
namespace Devmobsters\Capo\Command;

use Devmobsters\Capo\Exception\CommandHandlerNotFoundException;
use Devmobsters\Capo\Queue\Client;
use Devmobsters\Capo\Queue\QueueMessage;
use Devmobsters\Capo\Queue\ShouldBeQueued;
use Psr\Container\ContainerInterface;

/**
 * @package Fxgp\Core\Infrastructure\Commands\CommandBus
 * @author  Frank Levering <frank.levering@devmob.com>
 */
class CommandBus implements Dispatcher, QueueDispatcher
{
    /**
     * @var array
     */
    private $handlers;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Client
     */
    private $client;

    /**
     * CommandBus constructor.
     * @param ContainerInterface $container
     * @param Client $client
     * @param array $handlers
     */
    public function __construct(ContainerInterface $container, Client $client, array $handlers)
    {
        $this->container = $container;
        $this->handlers = $handlers;
        $this->client = $client;
    }

    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void
    {
        if ($this->shouldBeQueued($command)) {
            $this->dispatchToQueue($command);
            return;
        }

        $this->dispatchNow($command);
    }

    /**
     * @param Command $command
     */
    public function dispatchNow(Command $command): void
    {
        $handlers = $this->getCommandHandlers($command);

        foreach ($handlers as $handler) {
            $handler->handle($command);
        }
    }

    /**
     * @param Command $command
     */
    public function dispatchToQueue(Command $command): void
    {
        $this->client->send(new QueueMessage(serialize($command)), $this->getChannel($command));
    }

    /**
     * @param Command $command
     * @return bool
     */
    public function hasCommandHandler(Command $command): bool
    {
        return array_key_exists(get_class($command), $this->handlers);
    }

    /**
     * @inheritdoc
     * @throws CommandHandlerNotFoundException
     */
    public function getCommandHandlers(Command $command): array
    {
        if ($this->hasCommandHandler($command)) {
            $commandHandlers = [];
            $handlers = $this->handlers[get_class($command)]['handlers'];

            foreach ($handlers as $handler) {
                array_push($commandHandlers, $this->container->get($handler));
            }

            return $commandHandlers;
        }

        throw new CommandHandlerNotFoundException("Command " . get_class($command) . " has no handlers registered");
    }

    /**
     * @param Command $command
     * @return bool
     */
    private function shouldBeQueued(Command $command): bool
    {
        return $command instanceof ShouldBeQueued;
    }

    /**
     * @param Command $command
     * @return mixed
     */
    private function getChannel(Command $command)
    {
        return $this->handlers[get_class($command)]['channel'];
    }
}
