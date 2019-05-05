<?php

namespace App\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class BaseManager
{
    protected $em;
    protected $repository;

    /**
     * @see EntityManager::getRepository()
     */
    public function getRepository($fqn): EntityRepository
    {
        return $this->em->getRepository($fqn);
    }

    /**
     * @see EntityManager::persist()
     */
    public function persist($entity): void
    {
        $this->em->persist($entity);
    }

    /**
     * @see EntityManager::flush()
     */
    public function flush(): void
    {
        $this->em->flush();
    }

    /**
     * @see EntityManager::findBy()
     */
    public function findBy(array $criteria, $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
}
