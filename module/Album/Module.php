<?php
namespace Album;

use Album\Model\Album;
use Album\Model\AlbumImage;
use Album\Model\AlbumTrack;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AlbumTableGateway' => function (ServiceLocatorInterface $sm) {
                    /** @var Adapter $dbAdapter */
                    $dbAdapter = $sm->get('AlbumDb');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
                'AlbumImageTableGateway' => function (ServiceLocatorInterface $sm) {
                    /** @var Adapter $dbAdapter */
                    $dbAdapter = $sm->get('AlbumDb');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AlbumImage());
                    return new TableGateway('album_image', $dbAdapter, null, $resultSetPrototype);
                },
                'AlbumTrackTableGateway' => function (ServiceLocatorInterface $sm) {
                    /** @var Adapter $dbAdapter */
                    $dbAdapter = $sm->get('AlbumDb');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new AlbumTrack());
                    return new TableGateway('album_track', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
