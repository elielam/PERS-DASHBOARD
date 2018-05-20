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
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Collection;

class OperationCategoryTest extends TestCase
{

    public function testFieldsType()
    {
        $category = new OperationCategory();
        $category->setId(12);
        $category->setLibelle('test');
        $category->setOperationsPlus(new OperationPlus());
        $category->setOperationsMinus(new OperationMinus());

        $this->assertInternalType("int", $category->getId(), "Category ID isn't type int");
        $this->assertInternalType("string", $category->getLibelle(), "Category libelle isn't type string");
        $this->assertEquals(new OperationPlus(), $category->getOperationsPlus(), "Category OperationPlus isn't type OperationPlus");
        $this->assertEquals(new OperationMinus(), $category->getOperationsMinus(), "Category OperationMinus isn't type OperationMinus");
    }

    public function testToArrayBasic()
    {
        $category = new OperationCategory();
        $category->setId(12);
        $category->setLibelle('test');
        $category->setOperationsPlus(new OperationPlus());
        $category->setOperationsMinus(new OperationMinus());

        $actualCategory = $category->toArrayBasic();

        $expectedCategory = array(
            'id' => (integer)12,
            'libelle' => (string)'test',
            'operationsPlus' => (integer)1,
            'operationsMinus' => (integer)1,
        );

        $this->assertEquals($expectedCategory, $actualCategory, "Array returned by get basic Operation Category dosn't match");
    }

}