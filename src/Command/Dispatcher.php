<?php
namespace Devmobsters\Capo\Command;

/**
 * @package Fxgp\Core\Domain\Command\Bus
 * @author  Frank Levering <frank.levering@devmob.com>
 */
interface Dispatcher
{
    /**
     * @param Command $command
     */
    public function dispatch(Command $command): void;

    /**
     * @param Command $command
     */
    public function dispatchNow(Command $command): void;

    /**
     * @param Command $command
     * @return bool
     */
    public function hasCommandHandler(Command $command): bool;

    /**
     * @param Command $command
     * @return array
     */
    public function getCommandHandlers(Command $command): array;
}
