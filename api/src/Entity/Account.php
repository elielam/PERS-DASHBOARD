<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="APP_ACCOUNTS")
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{

    /* FIELDS */
    /* ############################################################################################################### */

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=40, unique=false, nullable=false)
     */
    private $libelle;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime", unique=false, nullable=true)
     */
    private $salaryDay;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=100000, unique=false, nullable=false)
     */
    private $balance;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=100000, unique=false, nullable=true)
     */
    private $atFirstBalance;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=100, unique=false, nullable=true)
     */
    private $interestDraft;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=1000, unique=false, nullable=false)
     */
    private $overdraft;

    /**
     * @ORM\OneToMany(targetEntity="OperationPlus", indexBy="account", mappedBy="account", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="operationsPlus", referencedColumnName="id")
     */
    private $operationsPlus;

    /**
     * @ORM\OneToMany(targetEntity="OperationMinus", indexBy="account", mappedBy="account", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="operationsMinus", referencedColumnName="id")
     */
    private $operationsMinus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="accounts")
     * @ORM\JoinColumn(nullable=true, unique=false, referencedColumnName="id")
     */
    private $user;

    /* CONSTRUCT */
    /* ############################################################################################################### */

    public function __construct()
    {
        $this->operationsPlus = new ArrayCollection();
        $this->operationsMinus = new ArrayCollection();
    }

    /* GETTERS & SETTERS */
    /* ############################################################################################################### */

    /**
     * @return mixed
     */
    public function getId()
    {
        return (integer)$this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = (integer)$id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return (string)$this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = (string)$libelle;
    }

    /**
     * @return mixed
     */
    public function getSalaryDay()
    {
        return $this->salaryDay;
    }

    /**
     * @param $salaryDay
     */
    public function setSalaryDay($salaryDay): void
    {
        $this->salaryDay = $salaryDay;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return (double)$this->balance;
    }

    /**
     * @param mixed $balance
     */
    public function setBalance($balance): void
    {
        $this->balance = (double)$balance;
    }

    /**
     * @return mixed
     */
    public function getAtFirstBalance()
    {
        return (double)$this->atFirstBalance;
    }

    /**
     * @param mixed $atFirstBalance
     */
    public function setAtFirstBalance($atFirstBalance): void
    {
        $this->atFirstBalance = (double)$atFirstBalance;
    }

    /**
     * @return mixed
     */
    public function getInterestDraft()
    {
        return (double)$this->interestDraft;
    }

    /**
     * @param mixed $interestDraft
     */
    public function setInterestDraft($interestDraft): void
    {
        $this->interestDraft = (double)$interestDraft;
    }

    /**
     * @return mixed
     */
    public function getOverdraft()
    {
        return (double)$this->overdraft;
    }

    /**
     * @param mixed $overdraft
     */
    public function setOverdraft($overdraft): void
    {
        $this->overdraft = (double)$overdraft;
    }

    /**
     * @return Collection|OperationPlus[]
     */
    public function getOperationsPlus()
    {
        return $this->operationsPlus;
    }

    /**
     * @param mixed $operationsPlus
     */
    public function setOperationsPlus($operationsPlus): void
    {
        $this->operationsPlus = $operationsPlus;
    }

    /**
     * @return Collection|OperationMinus[]
     */
    public function getOperationsMinus()
    {
        return $this->operationsMinus;
    }

    /**
     * @param mixed $operationsMinus
     */
    public function setOperationsMinus($operationsMinus): void
    {
        $this->operationsMinus = $operationsMinus;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /* SERIALISATION */
    /* ############################################################################################################### */

    public function toArrayBasic() {
        $id = (integer)$this->id;
        $uid = (integer)$this->user->getId();
        $libelle = (string)$this->libelle;
        if($this->salaryDay){ $salaryDay = (string)$this->salaryDay->format('d-m-Y H:i:s'); } else { $salaryDay = ""; }
        $balance = (double)$this->balance;
        if($this->atFirstBalance){ $atFirstBalance = (double)$this->atFirstBalance; } else { $atFirstBalance = 0; }
        if($this->interestDraft){ $interestDraft = (double)$this->interestDraft; } else { $interestDraft = 0; }
        $overdraft = (double)$this->overdraft;
        $operationsPlus = count($this->operationsPlus);
        $operationsMinus = count($this->operationsMinus);

        return array(
            'id' => $id,
            'uid' => $uid,
            'libelle' => $libelle,
            'salaryDay' => $salaryDay,
            'balance' => $balance,
            'atFirstBalance' => $atFirstBalance,
            'interestDraft' => $interestDraft,
            'overdraft' => $overdraft,
            'operationsPlus' => $operationsPlus,
            'operationsMinus' => $operationsMinus,
        );
    }

    public function toArrayExtended() {
        $operationsPlus = [];
        $tmp = $this->operationsPlus;
        if ($tmp) {
            foreach ($tmp as $operation) {
                $operationsPlus[] = $operation->toArrayBasic();
            }
        } else { $operationsPlus = ""; }

        $operationsMinus = [];
        $tmp = $this->operationsMinus;
        if ($tmp) {
            foreach ($tmp as $operation) {
                $operationsMinus[] = $operation->toArrayBasic();
            }
        } else { $operationsMinus = ""; }

        $id = (integer)$this->id;
        $user = $this->user->toArrayBasic();
        $libelle = (string)$this->libelle;
        $salaryDay = (string)$this->salaryDay->format('d-m-Y H:i:s');
        $balance = (double)$this->balance;
        $atFirstBalance = (double)$this->atFirstBalance;
        $interestDraft = (double)$this->interestDraft;
        $overdraft = (double)$this->overdraft;

        return array(
            'id' => $id,
            'user' => $user,
            'libelle' => $libelle,
            'salaryDay' => $salaryDay,
            'balance' => $balance,
            'atFirstBalance' => $atFirstBalance,
            'interestDraft' => $interestDraft,
            'overdraft' => $overdraft,
            'operationsPlus' => $operationsPlus,
            'operationsMinus' => $operationsMinus,
        );
    }

    /* METHODS */
    /* ############################################################################################################### */

    public function removeOperationPlus(OperationPlus $operation)
    {
        $this->operationsPlus->removeElement($operation);
        // set the owning side to null
        $operation->setAccount(null);
    }

    public function removeOperationMinus(OperationMinus $operation)
    {
        $this->operationsMinus->removeElement($operation);
        // set the owning side to null
        $operation->setAccount(null);
    }
}
