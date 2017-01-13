<?php

return array(
    'router' => array(
        'routes' => array(
            'rest.v1' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/rest/v1',
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'person' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/person[/:id]',
                            'defaults' => array(
                                'controller' => 'Rest\V1\Rest\PersonController'
                            )
                        )
                    ),
                )
            )
        )
    ),
    'zf-rest' => array(
        'Rest\V1\Rest\PersonController' => array(
            'listener' => 'Rest\V1\Rest\Person\PersonResource',
            'route_name' => 'rest.v1/person',
            'route_identifier_name' => 'id',
            'collection_name' => 'items',
            'entity_http_methods' => array(
                0 => 'GET'
            ),
            'collection_http_methods' => array(
                0 => 'GET'
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Rest\V1\Rest\Person\AlarmTypeEntity',
            'collection_class' => 'Rest\V1\Person\AlarmTypeCollection',
            'service_name' => 'Person'
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Rest\V1\Rest\PersonController' => 'HalJson',
        ),
        'accept-whitelist' => array(
            'Rest\V1\Rest\PersonController' => array(
                0 => 'application/hal+json',
                1 => 'application/json'
            )
        ),
        'content-type-whitelist' => array(
            'Rest\V1\Rest\PersonController' => array(
                0 => 'application/json',
                1 => 'application/hal+json',
            )
        )
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'AlarmCenter\Entity\AlarmType' => array(
                'route_identifier_name' => 'id',
                'entity_identifier_name' => 'id',
                'route_name' => 'rest.v1/person',
                'hydrator' => 'Rest\V1\Rest\Person\AlarmTypeHydrator'
            ),
        ),
        'renderer' => array(
            'hydrators' => array(
                'AlarmCenter\Entity\AlarmType' => 'Rest\V1\Rest\Person\AlarmTypeHydrator',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Rest\V1\Rest\Person\PersonResource' => 'Rest\Factory\V1\Rest\Person\PersonResourceFactory',

        )
    ),
    'hydrators' => array(
        'factories' => array(
            'Rest\V1\Rest\AlarmStatuses\AlarmStatusHydrator' => 'Rest\Factory\V1\Rest\AlarmStatuses\AlarmStatusesHydratorFactory',
        )
    )
);

