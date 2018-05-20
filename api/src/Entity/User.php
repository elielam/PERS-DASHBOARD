<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{

    /* FIELDS */
    /* ############################################################################################################### */

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=20, unique=false, nullable=false)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=20, unique=false, nullable=false)
     */
    private $lastname;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", unique=false, nullable=true)
     */
    private $birthdate;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=40, unique=true, nullable=false)
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100, unique=false, nullable=false)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="float", length=100000, unique=false, nullable=true)
     */
    private $salt;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="array", unique=false, nullable=false)
     */
    private $roles;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=40, unique=true, nullable=false)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="Account", indexBy="user", mappedBy="user", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="account", referencedColumnName="user")
     */
    private $accounts;

    /**
     * @ORM\OneToMany(targetEntity="Todo", indexBy="user", mappedBy="user", orphanRemoval=true, cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="todos", referencedColumnName="user")
     * @ORM\OrderBy({"state" = "desc"})
     */
    private $todos;

    /* CONSTRUCT */
    /* ############################################################################################################### */

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->todos = new ArrayCollection();
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
    public function getName()
    {
        return (string)$this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = (string)$name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return (string)$this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = (string)$lastname;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return (string)$this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = (string)$email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return (string)$this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = (string)$password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return (double)$this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt): void
    {
        $this->salt = (double)$salt;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return (array)$this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = (array)$roles;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return (string)$this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = (string)$username;
    }

    /**
     * @return Collection|Account[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param mixed $accounts
     */
    public function setAccounts($accounts): void
    {
        $this->accounts = $accounts;
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

    public function toArrayBasic() {
        return array(
            'id' => (integer)$this->id,
            'name' => (string)$this->name,
            'lastname' => (string)$this->lastname,
            'birtdate' => (string)$this->birthdate->format('d-m-Y H:i:s'),
            'email' => (string)$this->email,
            'roles' => (array)$this->roles,
            'username' => (string)$this->username,
            'accounts' => count($this->accounts),
            'todos' => count($this->todos),
        );
    }

    public function toArrayExtended()
    {
        $accounts = [];
        $tmp = $this->accounts;
        if ($tmp) {
            foreach ($tmp as $account) {
                $accounts[] = $account->toArrayBasic();
            }
        } else { $accounts = null; }

        return array(
            'id' => (integer)$this->id,
            'name' => (string)$this->name,
            'lastname' => (string)$this->lastname,
            'birtdate' => (string)$this->birthdate->format('d-m-Y H:i:s'),
            'email' => (string)$this->email,
            'roles' => (array)$this->roles,
            'username' => (string)$this->username,
            'accounts' => $accounts,
        );
    }

    /* METHODS */
    /* ############################################################################################################### */

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function removeAccount(Account $account)
    {
        $this->accounts->removeElement($account);
        // set the owning side to null
        $account->setUser(null);
    }
}
