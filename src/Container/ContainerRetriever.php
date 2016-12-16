<?php
namespace Devmobsters\Capo\Container;

/**
 * Interface ContainerRetriever
 * @package Devmobsters\Capo\Container
 */
interface ContainerRetriever
{
    /**
     * @return mixed
     */
    public function getContainer();
}