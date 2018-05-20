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
use App\Entity\TodoCategory;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Collection;

class TodoTest extends TestCase
{

    public function testFieldsType()
    {
        $todo = new Todo();
        $todo->setId(1);
        $todo->setLibelle('Test');
        $todo->setDescription('TEST');
        $todo->setTodoCat(new TodoCategory());
        $todo->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', "18-01-1996 10:52:48"));
        $todo->setState(2);


        $this->assertInternalType("int", $todo->getId(), "Todo ID isn't type int");
        $this->assertInternalType("string", $todo->getLibelle(), "Todo libelle isn't type string");
        $this->assertInternalType("string", $todo->getDescription(), "Todo description isn't type string");
        $this->assertEquals(new TodoCategory(), $todo->getTodoCat(),"Todo category isn't type todoCategory");
        $this->assertEquals(DateTime::createFromFormat('d-m-Y H:i:s', '18-01-1996 10:52:48'), $todo->getDatetime(), "Todo datetime isn't type datetime");
        $this->assertInternalType("integer", $todo->getState(), "Todo state isn't type string");
    }

    public function testToArrayBasic()
    {
        $user = new User();
        $user->setId(5);
        $category = new TodoCategory();
        $category->setId(8);

        $todo = new Todo();
        $todo->setId(1);
        $todo->setLibelle('Test');
        $todo->setDescription('TEST');
        $todo->setUser($user);
        $todo->setTodoCat($category);
        $todo->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', "18-01-1996 10:52:48"));
        $todo->setState(2);

        $actualTodo = $todo->toArrayBasic();

        $expectedTodo = array(
            'id' => (integer)1,
            'libelle' => (string)'Test',
            'description' => (string)'TEST',
            'user' => (integer)5,
            'category' => (integer)8,
            'datetime' => (string)"18-01-1996 10:52:48",
            'state' => (integer)2
        );

        $this->assertEquals($expectedTodo, $actualTodo, "Array returned by get basic User dosn't match");
    }

}