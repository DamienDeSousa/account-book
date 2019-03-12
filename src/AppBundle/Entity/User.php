<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Account", mappedBy="user")
     */
    protected $accounts;

    public function __construct()
    {
        parent::__construct();
        
        $this->accounts = new ArrayCollection();
    }

    public function addAccount($account)
    {
        $this->accounts[] = $account;
    }

    public function removeAccount($account)
    {
        $this->accounts->removeElement($account);
    }

    public function getAccounts()
    {
        return $this->accounts;
    }
}