<?php

namespace App\DataFixtures;

use App\Entity\User;
use BadMethodCallException;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $encoder;

    public const TEST_USER_REF = 'test-user';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setName('Test');
        $user->setLastName('TEST');
        $user->setBirthdate(DateTime::createFromFormat('d-m-Y H:i:s', date('d-m-Y H:i:s', mktime(0, 0, 0, 01, 01, 0001))));
        $user->setEmail('test@test.fr');
        $user->setPassword($this->encoder->encodePassword($user, 'test')); // test
        $user->setSalt(null);
        $user->setRoles('ROLE_USER');
        $user->setUsername('Test');
        $manager->persist($user);

        $this->addReference(self::TEST_USER_REF, $user);

        $manager->flush();

    }
}
