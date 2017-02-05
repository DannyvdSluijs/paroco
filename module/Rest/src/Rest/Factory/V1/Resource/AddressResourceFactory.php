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

namespace Rest\Factory\V1\Resource;

use Core\Entity\Person;
use Rest\V1\Hydrator\AddressHydrator;
use Rest\V1\Hydrator\PersonHydrator;
use Rest\V1\Resource\AddressResource;
use Rest\V1\Resource\PersonResource;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AddressResourceFactory implements FactoryInterface
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

        return new AddressResource($entityManager, new AddressHydrator());
    }
}