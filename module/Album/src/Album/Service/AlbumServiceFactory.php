<?php


namespace Album\Service;


use Hotdog\SpotifyExampleApi\SpotifyApiInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AlbumServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if($serviceLocator instanceof AbstractPluginManager)
        {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }

        /** @var SpotifyApiInterface $spotifyApi */
        $spotifyApi = $serviceLocator->get('SpotifyApi');

        $service = new AlbumService();
        $service->setSpotifyApi($spotifyApi);
        return $service;
    }
}