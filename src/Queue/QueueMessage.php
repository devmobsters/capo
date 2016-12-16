<?php
namespace Devmobsters\Capo\Queue;

/**
 * @package Fxgp\Core\Infrastructure\Queue\QueueMessage
 * @author  Frank Levering <frank.levering@devmob.com>
 */
class QueueMessage
{
    /**
     * @var mixed
     */
    private $message;

    /**
     * QueueMessage constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
