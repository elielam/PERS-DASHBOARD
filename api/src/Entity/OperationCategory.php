<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="APP_OPERATION_CATEGORIES")
 * @ORM\Entity(repositoryClass="App\Repository\OperationCategoryRepository")
 */
class OperationCategory
{

    /* FIELDS */
    /* ############################################################################################################### */

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=40, unique=false, nullable=false)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="OperationPlus", indexBy="operationCategory", mappedBy="operationCategory", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="operationsPlus", referencedColumnName="id")
     */
    private $operationsPlus;

    /**
     * @ORM\OneToMany(targetEntity="OperationMinus", indexBy="operationCategory", mappedBy="operationCategory", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="operationsMinus", referencedColumnName="id")
     */
    private $operationsMinus;

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

    /* SERIALISATION */
    /* ############################################################################################################### */

    public function toArrayBasic() {
        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'operationsPlus' => count($this->operationsPlus),
            'operationsMinus' => count($this->operationsMinus),
        );
    }

    public function toArrayExtended() {
        $operationsPlus = [];
        $tmp = $this->operationsPlus;
        if ($tmp) {
            foreach ($tmp as $operations) {
                $operationsPlus[] = $operations->toArrayBasic();
            }
        } else { $operationsPlus = null; }

        $operationsMinus = [];
        $tmp = $this->operationsMinus;
        if ($tmp) {
            foreach ($tmp as $operations) {
                $operationsMinus[] = $operations->toArrayBasic();
            }
        } else { $operationsMinus = null; }

        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'operationsPlus' => $operationsPlus,
            'operationsMinus' => $operationsMinus,
        );
    }

    /* METHODS */
    /* ############################################################################################################### */

}
