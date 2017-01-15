<?php

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
            'Rest\V1\PersonController' => [
                0 => 'application/hal+json',
                1 => 'application/json'
            ]
        ],
        'content-type-whitelist' => [
            'Rest\V1\PersonController' => [
                0 => 'application/json',
                1 => 'application/hal+json',
            ]
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
    'service_manager' => [
        'factories' => [
            Rest\V1\Resource\PersonResource::class => Rest\Factory\V1\Resource\PersonResourceFactory::class,
        ]
    ],
    'hydrators' => [
        'factories' => [
            Rest\V1\Hydrator\PersonHydrator::class => Rest\Factory\V1\Hydrator\PersonHydratorFactory::class,
        ]
    ]
];

