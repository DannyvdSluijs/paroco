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

namespace Rest\V1\Hydrator;

use Core\Entity\Address;
use Zend\Hydrator\HydratorInterface;

class AddressHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Address) {
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Address');
        }

        return [
            'uuid' => $object->getUuid(),
            'addressLine' => $object->getAddressLine(),
            'postalCode' => $object->getPostalCode(),
            'city' => $object->getCity(),
            'country' => $object->getCountry()
        ];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof Address) {
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Address');
        }

        $object->setAddressLine($data['addressLine'])
            ->setPostalCode($data['postalCode'])
            ->setCity($data['city'])
            ->setCountry($data['country']);

        return $object;
    }
}