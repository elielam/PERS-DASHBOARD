<?php

namespace App\DataFixtures;

use App\Entity\TodoCat;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Todo;

class TodoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $time = date("h:i:s");
        $date = date("j-m-Y");

        for ($k = 1 ; $k < 4; $k++) {
            for ($i = 1; $i < 6; $i++) {
                $todo = new Todo();
                $todo->setLibelle('TODO ' . $i);
                $todo->setDescription('This is the ' . $i . ' description sample !');
                $todo->setDatetime(DateTime::createFromFormat('d-m-Y H:i:s', $date . ' ' . $time));
                $todo->setState(1);
                if ($k == 1) {
                    $todo->setTodoCat($this->getReference(TodoCatFixtures::TODO_CAT1_REF));
                } elseif ($k == 2) {
                    $todo->setTodoCat($this->getReference(TodoCatFixtures::TODO_CAT2_REF));
                } else {
                    $todo->setTodoCat($this->getReference(TodoCatFixtures::TODO_CAT3_REF));
                }

                $todo->setUser($this->getReference(UserFixtures::TEST_USER_REF));

                $manager->persist($todo);
            }
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
            AccountFixtures::class,
            TodoCatFixtures::class,
        );
    }
}
