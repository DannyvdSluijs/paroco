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

namespace Rest\V1\Resource;

use Core\Entity\Address;
use Core\Entity\Person;
use Doctrine\ORM\EntityManager;
use Zend\Hydrator\HydratorInterface;
use ZF\Rest\AbstractResourceListener;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AddressResource extends AbstractResourceListener
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PersonResource constructor.
     * @param EntityManager $entityManager
     * @param HydratorInterface $hydrator
     */
    public function __construct(EntityManager $entityManager, HydratorInterface $hydrator)
    {
        $this->entityManager = $entityManager;
        $this->hydrator = $hydrator;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $address = new Address();
        $address = $this->hydrator->hydrate((array) $data, $address);

        $this->entityManager->persist($address);

        if ($this->getEvent()->getRouteParam('person')) {
            /** @var Person $person */
            $person = $this->entityManager->getRepository(Person::class)->findOneByUuid($this->getEvent()->getRouteParam('person'));
            $person->getAddresses()->add($address);
            $this->entityManager->persist($person);
        }

        $this->entityManager->flush();

        return $address;
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->entityManager->getRepository($this->getEntityClass())->findOneBy(array('uuid' => $id));
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $queryBuilder = $this->entityManager->getRepository($this->getEntityClass())->createQueryBuilder('p');
        return new Paginator($queryBuilder);
    }


}