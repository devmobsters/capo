<?php
namespace Devmobsters\Capo\Container\Providers;

use Devmobsters\Capo\Container\ContainerRetriever;
use Psr\Container\ContainerInterface;
use Psr\Container\Exception\ContainerException;
use Psr\Container\Exception\NotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

/**
 * @package Devmobsters\Capo\Providers\SymfonyContainerProvider
 * @author  Frank Levering <frank.levering@devmob.com>
 */
class SymfonyContainerProvider implements ContainerInterface, ContainerRetriever
{
    /**
     * @var SymfonyContainerInterface
     */
    private $container;

    /**
     * SymfonyContainerProvider constructor.
     * @param SymfonyContainerInterface $container
     */
    public function __construct(SymfonyContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for this identifier.
     * @throws ContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundException`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id)
    {
        return $this->container->has($id);
    }

    /**
     * @return SymfonyContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
