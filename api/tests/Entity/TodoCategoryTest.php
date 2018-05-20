<?php
/**
 * Created by PhpStorm.
 * User: eliel
 * Date: 19/04/2018
 * Time: 14:16
 */

namespace App\Tests\Entity;
use App\Entity\Account;
use App\Entity\OperationCategory;
use App\Entity\OperationMinus;
use App\Entity\OperationPlus;
use App\Entity\Todo;
use App\Entity\TodoCategory;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Collection;

class TodoCategoryTest extends TestCase
{

    public function testFieldsType()
    {
        $category = new TodoCategory();
        $category->setId(12);
        $category->setLibelle('test');
        $category->setTodos(new Todo());

        $this->assertInternalType("int", $category->getId(), "Category ID isn't type int");
        $this->assertInternalType("string", $category->getLibelle(), "Category libelle isn't type string");
        $this->assertEquals(new Todo(), $category->getTodos(), "Category Todo isn't type Todo");
    }

    public function testToArrayBasic()
    {
        $category = new TodoCategory();
        $category->setId(12);
        $category->setLibelle('test');
        $category->setTodos(new Todo());

        $actualCategory = $category->toArrayBasic();

        $expectedCategory = array(
            'id' => (integer)12,
            'libelle' => (string)'test',
            'todos' => (integer)1,
        );

        $this->assertEquals($expectedCategory, $actualCategory, "Array returned by get basic Todo Category dosn't match");
    }

}