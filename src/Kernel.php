<?php declare(strict_types=1);

namespace App;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Kernel
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct()
    {
        $this->buildContainer();
    }

    protected function buildContainer()
    {
        $container = new ContainerBuilder();

        $container->setParameter('dir.root', dirname(__DIR__));

        $loader = new YamlFileLoader($container, new FileLocator($this->getConfigDir()));
        $loader->load('services.yml');

        $container->compile();
        $this->container = $container;
    }

    protected function getConfigDir()
    {
        return dirname(__DIR__). '/config';
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}