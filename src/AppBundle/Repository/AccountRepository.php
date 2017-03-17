<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Account;
use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
    /**
     * @param Account $account
     * @return Account
     */
    public function merge(Account $account): Account
    {
        $account = $this->getEntityManager()->merge($account);
        $this->getEntityManager()->flush();

        return $account;
    }
}
