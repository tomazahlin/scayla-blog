<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private PasswordEncoderInterface $pwEncoder;

    public function __construct(PasswordEncoderInterface $pwEncoder)
    {
        $this->$pwEncoder = $pwEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('scayla');
        $user->setName('Max Mustermann');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setStatus(User::STATUS_ACTIVE);
        $password = $this->pwEncoder->encodePassword('symfony', 'salt');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
