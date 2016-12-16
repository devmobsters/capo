<?php
namespace Devmobsters\Capo\Queue;

interface QueueListener
{
    /**
     * @return mixed
     */
    public function listenAll();

    /**
     * @param string $channel
     * @return mixed
     */
    public function listen(string $channel);
}
