<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\OperationCat;
use App\Entity\OperationMinus;
use App\Entity\OperationPlus;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Collection;

class AccountFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $time = date("h:i:s");
        $date = date("j-m-Y");

        for ($j = 1; $j < 3; $j++) {
            $balance = rand(500, 10000);
            $interestedDraft = rand (1*10, 3*10) / 10;
            $overdraft = rand(0, -500);

            $account = new Account();
            $account->setLibelle('Account N°'.$j);
            $account->setSalaryDay(DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2018 00:00:00'));
            $account->setBalance($balance);
            $account->setAtFirstBalance($balance);
            $account->setInterestDraft($interestedDraft);
            $account->setOverdraft($overdraft);
            $account->setUser($this->getReference(UserFixtures::TEST_USER_REF));

            for ($k = 0; $k < 5; $k++) {
                for ($i = 1; $i < 11; $i++) {
                    $plusSum = rand(0, 100);

                    $operationPlus = new OperationPlus();
                    $operationPlus->setLibelle('Account N°'.$j.' Operation N°'.$i);
                    $operationPlus->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', '02-01-2018 00:00:00'));
                    $operationPlus->setSum($plusSum);
                    $operationPlus->setIsCredit(false);
                    $operationPlus->setAccount($account);
                    if ($k == 0) {
                        $operationPlus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT1_REF));
                    } elseif ($k == 1) {
                        $operationPlus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT2_REF));
                    } elseif ($k == 2) {
                        $operationPlus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT3_REF));
                    } elseif ($k == 3) {
                        $operationPlus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT4_REF));
                    } else {
                        $operationPlus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT5_REF));
                    }
                    $manager->persist($operationPlus);
                }
            }

            for ($k = 0; $k < 5; $k++) {
                for ($i = 1; $i < 11; $i++) {
                    $minusSum = rand(0, 100);

                    $operationMinus = new OperationMinus();
                    $operationMinus->setLibelle('Account N°' . $j . ' Operation N°' . $i);
                    $operationMinus->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', '02-01-2018 00:00:00'));
                    $operationMinus->setSum($minusSum);
                    $operationMinus->setIsDebit(false);
                    $operationMinus->setAccount($account);
                    if ($k == 0) {
                        $operationMinus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT1_REF));
                    } elseif ($k == 1) {
                        $operationMinus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT2_REF));
                    } elseif ($k == 2) {
                        $operationMinus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT3_REF));
                    } elseif ($k == 3) {
                        $operationMinus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT4_REF));
                    } else {
                        $operationMinus->setOperationCategory($this->getReference(OperationCatFixtures::OPERATION_CAT5_REF));
                    }
                    $manager->persist($operationMinus);
                }
            }

            $manager->persist($account);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return array(
          UserFixtures::class,
          OperationCatFixtures::class,
        );
    }
}
