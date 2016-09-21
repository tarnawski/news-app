<?php

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class AppKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        $bundles = [
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),

            new NewsBundle\NewsBundle(),
        ];

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }

    public function getCacheDir()
    {
        if (in_array($this->environment, array('dev', 'test')) && is_dir('/dev/shm')) {
            return sprintf('/dev/shm/%s/cache/%s', $this->getAppName(), $this->environment);
        }

        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        if (in_array($this->environment, array('dev', 'test')) && is_dir('/dev/shm')) {
            return sprintf('/dev/shm/%s/logs', $this->getAppName());
        }

        return dirname(__DIR__).'/var/logs';
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
        $routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
        $routes->import(__DIR__.'/config/routing.yml');
    }

    protected function getAppName()
    {
        return "news-app";
    }
}
