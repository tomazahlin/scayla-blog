<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture implements OrderedFixtureInterface
{
    const NUMBER_OF_BLOGS_PER_USER = 3;

    /**
     * Create 3 blog per user
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < UserFixtures::NUMBER_OF_USERS; $i++) {

            /**
             * @var User $user
             */
            $user = $this->getReference('user' . $i);

            for ($j = 0; $j < self::NUMBER_OF_BLOGS_PER_USER; $j++) {

                $blog = new Blog($user);
                $blog->setTitle('Blog title ' . $j)
                    ->setContent('Content comes here ...');
                $manager->persist($blog);
                $this->addReference('blog' . $i . '.' . $j, $blog);
            }
        }
        $manager->flush();
    }

    public function getOrder(): int
    {
        return 2;
    }
}
