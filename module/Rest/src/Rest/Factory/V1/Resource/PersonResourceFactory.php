<?php
/**
 * Simulation
 *
 * PHP Version 5.5
 *
 * @link      https://github.com/DannyvdSluijs/Simulation/
 * @copyright Copyright (c) 2016-2017
 * @license
 */

namespace Rest\Factory\V1\Resource;

use Core\Entity\Person;
use Rest\V1\Hydrator\PersonHydrator;
use Rest\V1\Resource\PersonResource;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PersonResourceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PersonResource
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        return new PersonResource($entityManager, new PersonHydrator());
    }
}