<?php
namespace Devmobsters\Capo\Command;

interface CommandHandler
{
    /**
     * @param Command $command
     * @return mixed
     */
    public function handle(Command $command);
}
