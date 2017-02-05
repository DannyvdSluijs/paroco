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

use Core\Entity\Complaint;
use Zend\Hydrator\HydratorInterface;

class ComplaintHydrator implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof Complaint) {
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Complaint');
        }

        return [
            'uuid' => $object->getUuid(),
            'date' => $object->getDate()->format('Y-m-d'),
            'registration' => $object->getRegistration()->format(\DATE_ISO8601),
            'product' => $object->getProduct(),
            'severity' => $object->getSeverity(),
            'processed' => $object->isProcessed(),
            'redeliverRequired' => $object->isRedeliverRequired(),
            'type' => $object->getType(),
            'key' => $object->getKey(),
            'address' => $object->getAddress(),
            'remark' => $object->getRemark()
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
            throw new \InvalidArgumentException('Parameter object should be a Core\Entity\Complaint');
        }

        return $object;
    }
}