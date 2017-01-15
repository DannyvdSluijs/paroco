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

namespace Rest\V1\Resource;

use Core\Entity\Person;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Hydrator\HydratorInterface;
use ZF\Rest\AbstractResourceListener;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PersonResource extends AbstractResourceListener
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
        $person = new Person();
        $person = $this->hydrator->hydrate((array) $data, $person);

        $this->entityManager->persist($person);
        $this->entityManager->flush();

        return $person;
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