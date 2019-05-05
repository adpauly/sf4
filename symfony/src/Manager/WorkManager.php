<?php

namespace App\Manager;

use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class WorkManager extends BaseManager
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->getRepository(Work::class);
    }
}
