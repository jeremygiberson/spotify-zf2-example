<?php

use Album\Controller\Factory\SearchControllerFactory;
use Album\Delegator\SpotifyApiCacheFactory;
use Album\Service\AlbumServiceFactory;
use Hotdog\SpotifyExampleApi\SpotifyApi;
use Zend\Db\Adapter\AdapterAbstractServiceFactory;

return [
    'controllers' => [
        'factories' => [
            'Album\Controller\Search' => SearchControllerFactory::class
        ]
    ],
    'router' => [
        'routes' => [
            'album' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/album[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9a-zA-Z]+',
                    ],
                    'defaults' => [
                        'controller' => 'Album\Controller\Search',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'SpotifyApi' => SpotifyApi::class
        ],
        'invokables' => [
            SpotifyApi::class => SpotifyApi::class,
            'spotify-api-cache-factory' => SpotifyApiCacheFactory::class,
        ],
        'factories' => [
            'AlbumService' => AlbumServiceFactory::class
        ],
        'abstract_factories' => [
            AdapterAbstractServiceFactory::class
        ],
        'delegators' => [
            SpotifyApi::class => [
                'spotify-api-cache-factory'
            ]
        ]
    ],
    'cache_config' => [
        'adapter' => [
            'name'    => 'filesystem',
            'options' => [
                'ttl' => 3600,
                'cache_dir' => 'data/cache/'
            ],
        ],
        'plugins' => [
            // Don't throw exceptions on cache errors
            'exception_handler' => [
                'throw_exceptions' => false
            ],
        ]
    ],
    'db' => [
        'adapters' => [
            'AlbumDb' => [
                'driver' => 'Pdo_Sqlite',
                'database' => 'data/album.sqlite'
            ]
        ]
    ],
    'migrations' => [
        'album' => [
            'dir' => 'data/migration-album',
            'namespace' => 'Album\Migrations',
            'adapter' => 'AlbumDb'
        ],
    ]
];