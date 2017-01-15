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

namespace Rest\V1\Hydrator;

use Core\Entity\Person;
use Zend\Hydrator\HydratorInterface;

class PersonHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Person) {
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Person');
        }

        return [
            'id' => $object->getId(),
            'uuid' => $object->getUuid(),
            'givenName' => $object->getGivenName(),
            'familyName' => $object->getFamilyName(),
            'dateOfBirth' => $object->getDateOfBirth()->format('Y-m-d')
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
        if (!$object instanceof Person) {
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Person');
        }

        $object->setGivenName($data['givenName'])
            ->setFamilyName($data['familyName'])
            ->setDateOfBirth(\DateTimeImmutable::createFromFormat('Y-m-d', $data['dateOfBirth']));

        return $object;
    }
}