<?php

namespace App\DataFixtures;

use App\Entity\OperationCat;
use App\Entity\OperationCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OperationCatFixtures extends Fixture
{

    public const OPERATION_CAT1_REF = 'operation-cat-1';
    public const OPERATION_CAT2_REF = 'operation-cat-2';
    public const OPERATION_CAT3_REF = 'operation-cat-3';
    public const OPERATION_CAT4_REF = 'operation-cat-4';
    public const OPERATION_CAT5_REF = 'operation-cat-5';

    public function load(ObjectManager $manager)
    {
        $operationCat = new OperationCategory();
        $operationCat->setLibelle('Alimentary');
        $manager->persist($operationCat);

        $this->addReference(self::OPERATION_CAT1_REF, $operationCat);

        $operationCat = new OperationCategory();
        $operationCat->setLibelle('Fees');
        $manager->persist($operationCat);

        $this->addReference(self::OPERATION_CAT2_REF, $operationCat);

        $operationCat = new OperationCategory();
        $operationCat->setLibelle('Hobbies');
        $manager->persist($operationCat);

        $this->addReference(self::OPERATION_CAT3_REF, $operationCat);

        $operationCat = new OperationCategory();
        $operationCat->setLibelle('Suscriptions');
        $manager->persist($operationCat);

        $this->addReference(self::OPERATION_CAT4_REF, $operationCat);

        $operationCat = new OperationCategory();
        $operationCat->setLibelle('Others');
        $manager->persist($operationCat);

        $this->addReference(self::OPERATION_CAT5_REF, $operationCat);

        $manager->flush();
    }
}
