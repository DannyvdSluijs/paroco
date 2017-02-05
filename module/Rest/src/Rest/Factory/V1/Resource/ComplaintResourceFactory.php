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

use Rest\V1\Hydrator\ComplaintHydrator;
use Rest\V1\Resource\ComplaintResource;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComplaintResourceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ComplaintResource
     */
    public function createService(ServiceLocatorInterface $serviceLocator): ComplaintResource
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        return new ComplaintResource($entityManager, new ComplaintHydrator());
    }
}