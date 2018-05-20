<?php
/**
 * Created by PhpStorm.
 * User: eliel
 * Date: 19/04/2018
 * Time: 14:16
 */

namespace App\Tests\Entity;
use App\Entity\Account;
use App\Entity\OperationMinus;
use App\Entity\OperationPlus;
use App\Entity\Todo;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Collection;

class UserTest extends TestCase
{

    public function testFieldsType()
    {
        $user = new User();
        $user->setId(1);
        $user->setName('Test');
        $user->setLastName('TEST');
        $user->setBirthdate(DateTime::createFromFormat('d-m-Y H:i:s', "18-01-1996 10:52:48"));
        $user->setEmail('test@test.fr');
        $user->setPassword("HASHMDP");
        $user->setSalt(12345687789746542318657465132);
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
        $user->setUsername('Test');
        $user->setAccounts(new Account());

        $this->assertInternalType("int", $user->getId(), "User ID isn't type int");
        $this->assertInternalType("string", $user->getName(), "User name isn't type string");
        $this->assertInternalType("string", $user->getLastname(), "User lastname isn't type string");
        $this->assertEquals(DateTime::createFromFormat('d-m-Y H:i:s', '18-01-1996 10:52:48'), $user->getBirthdate(), "User birthdate isn't type datetime");
        $this->assertInternalType("string", $user->getEmail(), "User email isn't type string");
        $this->assertInternalType("string", $user->getPassword(), "User password isn't type string");
        $this->assertInternalType("double", $user->getSalt(), "User salt isn't type double");
        $this->assertInternalType("array", $user->getRoles(), "User roles isn't type array");
        $this->assertInternalType("string", $user->getUsername(), "User username isn't type string");
        $this->assertEquals(new Account(), $user->getAccounts(),"User account isn't type string");
    }

    public function testToArrayBasic()
    {
        $user = new User();
        $user->setId(1);
        $user->setName('Test');
        $user->setLastName('TEST');
        $user->setBirthdate(DateTime::createFromFormat('d-m-Y H:i:s', "18-01-1996 10:52:48"));
        $user->setEmail('test@test.fr');
        $user->setRoles(array('ROLE_USER', 'ROLE_ADMIN'));
        $user->setUsername('Test');
        $user->setAccounts(array(new Account(), new Account()));
        $user->setTodos(array(new Todo(), new Todo()));

        $expectedUser = $user->toArrayBasic();

        $actualUser = array(
            'id' => (integer)1,
            'name' => (string)"Test",
            'lastname' => (string)"TEST",
            'birtdate' => (string)"18-01-1996 10:52:48",
            'email' => (string)"test@test.fr",
            'roles' => (array)array('ROLE_USER', 'ROLE_ADMIN'),
            'username' => (string)"Test",
            'accounts' => (integer)2,
            'todos' => (integer)2,
        );

        $this->assertEquals($expectedUser, $actualUser, "Array returned by get basic User dosn't match");
    }

}