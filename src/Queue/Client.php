<?php
namespace Devmobsters\Capo\Queue;

use Closure;

/**
 * @package Fxgp\Core\Infrastructure\Queue\QueueClient
 * @author  Frank Levering <frank.levering@devmob.com>
 */
interface Client
{
    /**
     * Open the connection with the queue
     */
    public function open();

    /**
     * Close the connection with the queue
     */
    public function close();

    /**
     * @param QueueMessage $message
     * @param string $channel
     * @return mixed
     */
    public function send(QueueMessage $message, string $channel);

    /**
     * @param Closure $callback
     * @param string $channel
     * @return mixed
     */
    public function listen(Closure $callback, string $channel);
}
