<?php

use VasekPurchart\Doctrine\Type\DateTimeImmutable\DateImmutableType;
use VasekPurchart\Doctrine\Type\DateTimeImmutable\DateTimeImmutableType;

return [
    'doctrine' => [
        'driver' => [
            'core' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/Core/Entity'
            ],
            'orm_default' => [
                'drivers' => [
                    'Core\Entity' => 'core'
                ]
            ],
        ],
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'generate_proxies' => true,
                'proxy_dir' => 'data/doctrine/proxy',
                'naming_strategy' => 'Doctrine\ORM\Mapping\UnderscoreNamingStrategy',
                'types' => [
                    'uuid' => 'Ramsey\Uuid\Doctrine\UuidType',
                    'product' => 'Core\ValueObjects\Doctrine\ProductType',
                    'severity' => 'Core\ValueObjects\Doctrine\SeverityType',
                    'complaint-type' => 'Core\ValueObjects\Doctrine\ComplaintTypeType',
                    DateImmutableType::NAME => DateImmutableType::class,
                    DateTimeImmutableType::NAME => DateTimeImmutableType::class
                ]
            ]
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];