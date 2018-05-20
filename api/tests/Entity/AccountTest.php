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
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Collection;

class AccountTest extends TestCase
{

    public function testFieldsType() {
        $account = new Account();
        $account->setId(1);
        $account->setLibelle("datas type");
        $account->setSalaryDay(DateTime::createFromFormat('d-m-Y H:i:s', '02-01-2018 00:00:00'));
        $account->setBalance(1000);
        $account->setAtFirstBalance(1000);
        $account->setInterestDraft(1.93);
        $account->setOverdraft(-300);

        $this->assertInternalType("int", $account->getId(), "Account ID isn't type int");
        $this->assertInternalType("string", $account->getLibelle(), "Account Libelle isn't type string");
        $this->assertEquals(DateTime::createFromFormat('d-m-Y H:i:s', '02-01-2018 00:00:00'), $account->getSalaryDay(), "Account Datetime isn't type datetime");
        $this->assertInternalType("double", $account->getBalance(), "Account Balance isn't type double");
        $this->assertInternalType("double", $account->getAtFirstBalance(), "Account AtFirstBalance isn't type double");
        $this->assertInternalType("double", $account->getInterestDraft(), "Account InterestDraft isn't type double");
        $this->assertInternalType("double", $account->getOverdraft(), "Account Overdraft isn't type double");
    }

    public function testToArrayBasic() {
        $operationsPlus = array(new OperationPlus(), new OperationPlus());
        $operationsMinus = array(new OperationMinus(), new OperationMinus());

        $user = new User();
        $user->setId(10);
        $user->setUsername("test");

        $account = new Account();
        $account->setId(1);
        $account->setUser($user);
        $account->setLibelle("datas type");
        $account->setSalaryDay(DateTime::createFromFormat('d-m-Y H:i:s', '02-01-2018 00:00:00'));
        $account->setBalance(1000);
        $account->setAtFirstBalance(1000);
        $account->setInterestDraft(1.93);
        $account->setOverdraft(-300);
        $account->setOperationsPlus($operationsPlus);
        $account->setOperationsMinus($operationsMinus);

        $expectedAccount = $account->toArrayBasic();

        $actualAccount = array(
            'id' => 1,
            'uid' => (integer)10,
            'libelle' => (string)"datas type",
            'salaryDay' => (string)"02-01-2018 00:00:00",
            'balance' => (double)1000,
            'atFirstBalance' => (double)1000,
            'interestDraft' => (double)1.93,
            'overdraft' => (double)-300,
            'operationsPlus' => 2,
            'operationsMinus' => 2,
        );

        $this->assertEquals($expectedAccount, $actualAccount, "Array returned by get basic Account dosn't match");
    }

    public function testArrayValidateExtended() {

    }

}