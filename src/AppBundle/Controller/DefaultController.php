<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\Client;
use AppBundle\Entity\Skill;
use AppBundle\Filters\StatusFilter;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        // EntityManager and Repositories
        $connection = $this->getDoctrine()->getConnection('default');
        $connection2 = $this->getDoctrine()->getConnection('other');
        $entityManager = $this->getDoctrine()->getManager('default');
        $entityManager2 = $this->getDoctrine()->getManager('other');
        $accountRepository = $entityManager->getRepository(Account::class);
        $accountRepository2 = $entityManager2->getRepository(Account::class);
        $clientRepository = $entityManager->getRepository(Client::class);
        $clientRepository2 = $entityManager2->getRepository(Client::class);

        // findAll()
//        $accounts = $accountRepository->findAll();
//        $clients = $clientRepository->findAll();
//        dump($accounts, $clients);

        die;
    }

    /**
     * @Route("/events")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function eventsAction(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $client = $entityManager->getRepository(Client::class)->find(6);
        $client->setName('Test 3');
        $client->setStatus(true);

        $client = $entityManager->merge($client);
        $entityManager->flush();

        dump($client);

        die;
    }

    /**
     * @Route("/transactions")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function transactionsAction(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager('default');
        $entityManager2 = $this->getDoctrine()->getManager('other');

        $entityManager->getConnection()->beginTransaction();
        $entityManager2->getConnection()->beginTransaction();

        try {
            $account1 = $entityManager->getRepository(Account::class)->find(1, LockMode::OPTIMISTIC);
            $account2 = $entityManager2->getRepository(Account::class)->find(1, LockMode::OPTIMISTIC);

            $account1->addBalance(-1000);
            $account2->addBalance(-500);

            $entityManager->merge($account1);
            $entityManager->flush();
            $entityManager->commit();

            $entityManager2->merge($account2);
            $entityManager2->flush();
            $entityManager2->commit();

            dump($account1, $account2);
        } catch (OptimisticLockException $optimisticLockException) {
            dump(
                'OptimisticLockException',
                $optimisticLockException->getMessage(),
                $optimisticLockException->getEntity()
            );

            if ($entityManager->getConnection()->isTransactionActive()) {
                $entityManager->getConnection()->rollback();
            }

            if ($entityManager2->getConnection()->isTransactionActive()) {
                $entityManager2->getConnection()->rollback();
            }
        }

        die;
    }

    /**
     * @Route("/filters")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function filtersAction(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        /** @var StatusFilter $statusFilter */
        $statusFilter = $entityManager->getFilters()->enable('status_filter');
        $statusFilter->setStatus(StatusFilter::INACTIVE);

        $queryBuilder = $entityManager->getRepository(Client::class)
            ->createQueryBuilder('cli');
        $clients = $queryBuilder->getQuery()->getResult();
//        $client = $entityManager->getRepository(Client::class)->findAll();

        dump('filters', $clients);

        // No filters
//        $entityManager->getFilters()->disable('status_filter');
//        $clients = $queryBuilder->getQuery()->getResult();
//        dump('no filters', $clients);

        die;
    }

    /**
     * @Route("/partial-objects")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function partialObjects(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $client = $entityManager->getPartialReference(Client::class, 1);
        dump($client);

//        $entityManager->refresh($client);
//        dump($client);

        die;
    }

    /**
     * @Route("/read-only-entities")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function readOnlyEntitiesAction(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $skill = $entityManager->getRepository(Skill::class)->find(2);
        $skill->setName('Angular 2');
        $skill = $entityManager->merge($skill);
        $entityManager->flush();
        dump($skill);

//        $newSkill = new Skill();
//        $newSkill->setName('Java');
//        $newSkill = $entityManager->merge($newSkill);
//        $entityManager->flush();
//        dump($newSkill);

        die;
    }
}
