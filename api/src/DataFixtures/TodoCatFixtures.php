<?php

namespace App\DataFixtures;

use App\Entity\TodoCat;
use App\Entity\TodoCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TodoCatFixtures extends Fixture
{

    public const TODO_CAT1_REF = 'todo-cat-1';
    public const TODO_CAT2_REF = 'todo-cat-2';
    public const TODO_CAT3_REF = 'todo-cat-3';

    public function load(ObjectManager $manager)
    {
        $todoCat = new TodoCategory();
        $todoCat->setLibelle('Under 24Hours');
        $manager->persist($todoCat);

        $this->addReference(self::TODO_CAT1_REF, $todoCat);

        $todoCat = new TodoCategory();
        $todoCat->setLibelle('Next Week');
        $manager->persist($todoCat);

        $this->addReference(self::TODO_CAT2_REF, $todoCat);

        $todoCat = new TodoCategory();
        $todoCat->setLibelle('Reminder');
        $manager->persist($todoCat);

        $this->addReference(self::TODO_CAT3_REF, $todoCat);

        $manager->flush();
    }
}
