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

class OperationMinusTest extends TestCase
{

    public function testFieldsType()
    {
        $operation = new OperationMinus();
        $operation->setId(5);
        $operation->setLibelle('test');
        $operation->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2018 00:00:00'));
        $operation->setSum(50);
        $operation->setIsDebit(false);
        $operation->setAccount(new Account());

        $this->assertInternalType("int", $operation->getId(), "Operation ID isn't type int");
        $this->assertInternalType("string", $operation->getLibelle(), "Operation libelle isn't type string");
        $this->assertEquals(DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2018 00:00:00'), $operation->getDatetime(), "Operation datetime isn't type datetime");
        $this->assertInternalType("double", $operation->getSum(), "Operation sum isn't type double");
        $this->assertInternalType("boolean", $operation->getisDebit(), "Operation isDebit isn't type boolean");
        $this->assertEquals(new Account(), $operation->getAccount(), "Operation account isn't type account");
    }

    public function testToArrayBasic()
    {
        $category = new OperationCategory();
        $category->setId(7);
        $account = new Account();
        $account->setId(21);

        $operation = new OperationMinus();
        $operation->setId(5);
        $operation->setLibelle('test');
        $operation->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2018 00:00:00'));
        $operation->setSum(50);
        $operation->setIsDebit(false);
        $operation->setAccount($account);
        $operation->setOperationCategory($category);

        $actualOperation = $operation->toArrayBasic();

        $expectedOperation = array(
            'id' => (integer)5,
            'libelle' => (string)'test',
            'account' => (integer)21,
            'category' => (integer)7,
            'datetime' => (string)'01-01-2018 00:00:00',
            'sum' => (double)50,
            'isDebit' => (boolean)false,
        );

        $this->assertEquals($expectedOperation, $actualOperation, "Array returned by get basic Operation Minus dosn't match");
    }

}