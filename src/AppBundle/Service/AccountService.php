<?php
namespace AppBundle\Service;
use AppBundle\Entity\Account;
use AppBundle\Repository\AccountRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class AccountService
 * @package AppBundle\Service
 */
class AccountService
{
    /** @var EntityManager */
    private $entityManager;

    /** @var AccountRepository */
    private $accountRepository;

    /**
     * AccountService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->accountRepository = $this->entityManager->getRepository(Account::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->accountRepository->findAll();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return \AppBundle\Entity\Account[]|array
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->accountRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
}