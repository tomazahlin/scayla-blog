<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    const NUMBER_OF_USERS = 10;

    private UserPasswordEncoderInterface $pwEncoder;

    public function __construct(UserPasswordEncoderInterface $pwEncoder)
    {
        $this->pwEncoder = $pwEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NUMBER_OF_USERS; $i++) {
            $user = new User();
            $user->setUsername('scayla' . $i);
            $user->setName('Max Mustermann');
            $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $user->setStatus(User::STATUS_ACTIVE);
            $password = $this->pwEncoder->encodePassword($user, 'symfony' . $i);
            $user->setPassword($password);
            $manager->persist($user);
            $this->addReference('user' . $i, $user);
        }
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
