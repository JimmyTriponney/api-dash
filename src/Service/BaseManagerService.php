<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class BaseManagerService
{
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
}
