<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Client;
use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository
{
    /**
     * @param Client $client
     * @return Client
     */
    public function merge(Client $client): Client
    {
        $client = $this->getEntityManager()->merge($client);
        $this->getEntityManager()->flush();

        return $client;
    }
}
