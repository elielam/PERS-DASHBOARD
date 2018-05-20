<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoCategoryRepository")
 */
class TodoCategory
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
     * @ORM\Column(type="string", length=40, unique=false, nullable=false)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="Todo", indexBy="todoCat", mappedBy="todoCat", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="todos", referencedColumnName="todoCategory")
     * @ORM\OrderBy({"state" = "desc"})
     */
    private $todos;

    /* CONSTRUCT */
    /* ############################################################################################################### */

    public function __construct()
    {
        $this->todos = new ArrayCollection();
    }

    /* GETTERS & SETTERS */
    /* ############################################################################################################### */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTodos()
    {
        return $this->todos;
    }

    /**
     * @param mixed $todos
     */
    public function setTodos($todos): void
    {
        $this->todos = $todos;
    }

    /* SERIALISATION */
    /* ############################################################################################################### */

    public function toArrayBasic()
    {
        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'todos' => count($this->todos),
        );
    }

    public function toArrayExtended()
    {
        $todos = [];
        $tmp = $this->todos;
        if ($tmp) {
            foreach ($tmp as $todo) {
                $todos[] = $todo->toArrayBasic();
            }
        } else { $todos = null; }

        return array(
            'id' => (integer)$this->id,
            'libelle' => (string)$this->libelle,
            'todos' => array('entities' => $todos),
        );
    }

    /* METHODS */
    /* ############################################################################################################### */
}
