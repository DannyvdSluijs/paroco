<?php
/**
 * PaRoCo
 *
 * PHP Version 7
 *
 * @link      https://github.com/DannyvdSluijs/paroco
 * @copyright Copyright (c) 2016 Danny van der Sluijs
 * @license   MIT License
 */

return [
    'router' => [
        'routes' => [
            'rest.v1' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/v1',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'person' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/person[/:person]',
                            'defaults' => [
                                'controller' => 'Rest\V1\PersonController',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'zf-rest' => [
        'Rest\V1\PersonController' => [
            'listener' => Rest\V1\Resource\PersonResource::class,
            'route_name' => 'rest.v1/person',
            'route_identifier_name' => 'person',
            'collection_name' => 'persons',
            'entity_http_methods' => ['GET'],
            'collection_http_methods' => ['GET', 'POST'],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => Core\Entity\Person::class,
            //'collection_class' => 'Rest\V1\Collection\PersonCollection',
            'service_name' => 'Person'
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Rest\V1\PersonController' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Rest\V1\PersonController' => ['application/hal+json', 'application/json']
        ],
        'content-type-whitelist' => [
            'Rest\V1\PersonController' => ['application/json', 'application/hal+json']
        ]
    ],
    'zf-content-validation' => [
        'Rest\V1\PersonController' => [
            'input_filter' => \Rest\V1\InputFilter\PersonInputFilter::class,
        ]
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Core\Entity\Person' => [
                'route_identifier_name' => 'person',
                'entity_identifier_name' => 'uuid',
                'route_name' => 'rest.v1/person',
                'hydrator' => Rest\V1\Hydrator\PersonHydrator::class
            ],
        ],
        'renderer' => [
            'hydrators' => [
                Core\Entity\Person::class => Rest\V1\Hydrator\PersonHydrator::class,
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'http' => [
                'accept_schemes' => ['basic', 'digest'],
                'realm' => 'My Web Site',
                'digest_domains' => '/',
                'nonce_timeout' => 3600,
                'htpasswd' => './data/htpasswd', // htpasswd tool generated
                'htdigest' => './data/htdigest', // @see http://www.askapache.com/online-tools/htpasswd-generator/
            ],
        ],
        'authorization' => [
            'deny_by_default' => true,
            'ZF\\OAuth2\\Controller\\Auth' => [
                'actions' => [
                    'token' => [
                        'POST'   => true,
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Rest\V1\Resource\PersonResource::class => Rest\Factory\V1\Resource\PersonResourceFactory::class,
        ]
    ],
    'hydrators' => [
        'factories' => [
            Rest\V1\Hydrator\PersonHydrator::class => Rest\Factory\V1\Hydrator\PersonHydratorFactory::class,
        ]
    ],
    'input_filters' => [
        'invokables' => [
            \Rest\V1\InputFilter\PersonInputFilter::class => \Rest\V1\InputFilter\PersonInputFilter::class
        ]
    ]
];
