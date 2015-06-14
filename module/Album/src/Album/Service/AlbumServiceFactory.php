<?php


namespace Album\Service;


use Hotdog\SpotifyExampleApi\SpotifyApiInterface;
use Zend\Db\TableGateway\TableGateway;
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
        /** @var TableGateway $albumGateway */
        $albumGateway = $serviceLocator->get('AlbumTableGateway');
        /** @var TableGateway $albumImageGateway */
        $albumImageGateway = $serviceLocator->get('AlbumImageTableGateway');
        /** @var TableGateway $albumTrackGateway */
        $albumTrackGateway = $serviceLocator->get('AlbumTrackTableGateway');

        $service = new AlbumService();
        $service->setSpotifyApi($spotifyApi);
        $service->setAlbumGateway($albumGateway);
        $service->setAlbumImageGateway($albumImageGateway);
        $service->setAlbumTrackGateway($albumTrackGateway);
        return $service;
    }
}