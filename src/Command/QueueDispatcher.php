<?php
namespace Devmobsters\Capo\Command;

/**
 * @package Fxgp\Core\Domain\Command\QueueDispatcher
 * @author  Frank Levering <frank.levering@devmob.com>
 */
interface QueueDispatcher
{
    /**
     * @param Command $command
     */
    public function dispatchToQueue(Command $command): void;
}
