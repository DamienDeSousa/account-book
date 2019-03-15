<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Account;
use AppBundle\Entity\User;

class AccountService
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function create($name, $amount, $overdraft, User $user)
    {
        $account = new Account();
        $account->setAmount($amount)
                ->setName($name)
                ->setOverdraft($overdraft)
                ->setUser($user);
        $user->addAccount($account);
        
        return $account;
    }

    public function save($account)
    {
        $this->entityManager->persist($account);
        $this->entityManager->flush();
    }

    public function remove(Account $account)
    {
        $user = $account->getUser();
        $user->removeAccount($account);
        $this->entityManager->remove($account);
        $this->entityManager->flush();
    }

    public function update(Account $account)
    {
        $this->entityManager->flush();
    }
}