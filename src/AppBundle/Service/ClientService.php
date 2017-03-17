<?php
namespace AppBundle\Service;

use AppBundle\Entity\Client;
use AppBundle\Repository\ClientRepository;
use Doctrine\ORM\EntityManager;

class ClientService
{
    /** @var EntityManager */
    private $entityManager;

    /** @var ClientRepository */
    private $clientRepository;

    /**
     * ClientService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->clientRepository = $this->entityManager->getRepository(Client::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->clientRepository->findAll();
    }
}