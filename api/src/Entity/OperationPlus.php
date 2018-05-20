<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="APP_OPERATIONS_PLUS")
 * @ORM\Entity(repositoryClass="App\Repository\OperationPlusRepository")
 */
class OperationPlus
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
     * @ORM\Column(type="string", unique=false, nullable=false)
     */
    private $libelle;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", unique=false, nullable=false)
     */
    private $datetime;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=100000, unique=false, nullable=false)
     */
    private $sum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="operationsPlus")
     * @ORM\JoinColumn(nullable=true, unique=false, referencedColumnName="id")
     */
    private $account;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean", unique=false, nullable=false)
     */
    private $isCredit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OperationCategory", inversedBy="operationsPlus")
     * @ORM\JoinColumn(nullable=true, unique=false, referencedColumnName="id")
     */
    private $operationCategory;

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
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return (double)$this->sum;
    }

    /**
     * @param mixed $sum
     */
    public function setSum($sum): void
    {
        $this->sum = (double)$sum;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account): void
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getisCredit()
    {
        return (boolean)$this->isCredit;
    }

    /**
     * @param mixed $isCredit
     */
    public function setIsCredit($isCredit): void
    {
        $this->isCredit = (boolean)$isCredit;
    }

    /**
     * @return mixed
     */
    public function getOperationCategory()
    {
        return $this->operationCategory;
    }

    /**
     * @param mixed $operationCategory
     */
    public function setOperationCategory($operationCategory): void
    {
        $this->operationCategory = $operationCategory;
    }

    /* SERIALISATION */
    /* ############################################################################################################### */

    public function toArrayBasic() {
        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'account' => (integer)$this->account->getId(),
            'category' => (integer)$this->operationCategory->getId(),
            'datetime' => (string)$this->datetime->format('d-m-Y H:i:s'),
            'sum' => (double)$this->sum,
            'isCredit' => (boolean)$this->isCredit,
        );
    }

    public function toArrayExtended() {
        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'account' => $this->account,
            'category' => $this->operationCategory,
            'datetime' => (string)$this->datetime->format('d-m-Y H:i:s'),
            'sum' => (double)$this->sum,
            'isCredit' => (boolean)$this->isCredit,
        );
    }

    /* METHODS */
    /* ############################################################################################################### */

}
