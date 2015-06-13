<?php


namespace Album\Delegator;


use Zend\Cache\StorageFactory;
use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SpotifyApiCacheFactory implements DelegatorFactoryInterface
{

    /**
     * A factory that creates delegates of a given service
     *
     * @param ServiceLocatorInterface $serviceLocator the service locator which requested the service
     * @param string $name the normalized service name
     * @param string $requestedName the requested service name
     * @param callable $callback the callback that is responsible for creating the service
     *
     * @return mixed
     */
    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        $realSpotifyApi   = call_user_func($callback);

        $appConfig = $serviceLocator->get('Config');
        $cacheConfig = $appConfig['cache_config'];

        $adapter = StorageFactory::factory($cacheConfig);

        return new SpotifyApiCache($realSpotifyApi, $adapter);
    }
}