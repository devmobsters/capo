<?php
namespace Devmobsters\Capo\Queue;

interface QueueHandler
{
    /**
     * @param QueueMessage $message
     * @return mixed
     */
    public function handle(QueueMessage $message);
}
