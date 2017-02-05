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

namespace Rest\Factory\V1\Hydrator;

use Rest\V1\Hydrator\ComplaintHydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ComplaintHydratorFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ComplaintHydrator
     */
    public function createService(ServiceLocatorInterface $serviceLocator): ComplaintHydrator
    {
        return new ComplaintHydrator();
    }
}