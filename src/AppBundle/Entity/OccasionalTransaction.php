<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Transaction;

/**
 * OccasionalTransaction
 *
 * @ORM\Table(name="occasional_transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OccasionalTransactionRepository")
 */
class OccasionalTransaction extends Transaction
{
    public function __construct()
    {
        $this->madeAt = new \DateTime();
    }
}

