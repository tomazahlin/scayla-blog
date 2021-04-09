<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $pwEncoder;

    public function __construct(UserPasswordEncoderInterface $pwEncoder)
    {
        $this->pwEncoder = $pwEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername('scayla' . $i);
            $user->setName('Max Mustermann');
            $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            $user->setStatus(User::STATUS_ACTIVE);
            $password = $this->pwEncoder->encodePassword($user, 'symfony' . $i);
            $user->setPassword($password);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
